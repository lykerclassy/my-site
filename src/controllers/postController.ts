import { Request, Response } from 'express';
import { prisma } from '../lib/prisma';
import { getPagination } from '../utils/pagination';
import { paginationQuerySchema, postCreateSchema, postUpdateSchema } from '../utils/validators';

export async function listPosts(req: Request, res: Response) {
  const tenantId = req.tenantId || (req.query.tenant as string);
  if (!tenantId) return res.status(400).json({ error: 'tenant id required via X-Tenant-Id header or tenant query param' });

  const parsed = paginationQuerySchema.safeParse(req.query);
  if (!parsed.success) return res.status(400).json({ error: parsed.error.flatten() });
  const { page, pageSize, search, tags, category, status, visibility } = parsed.data;
  const { skip, take } = getPagination(page, pageSize);

  const tagArray = tags ? tags.split(',').map((t) => t.trim()).filter(Boolean) : undefined;

  const where: any = { tenantId };
  if (category) where.category = category;
  if (status) where.status = status;
  if (visibility) where.visibility = visibility;
  if (tagArray && tagArray.length) where.tags = { hasSome: tagArray };
  if (search) {
    where.OR = [
      { title: { contains: search, mode: 'insensitive' } },
      { content: { contains: search, mode: 'insensitive' } },
      { category: { contains: search, mode: 'insensitive' } },
      { tags: { has: search } },
    ];
  }

  // If unauthenticated, only allow public published posts
  if (!req.user || req.user.tenantId !== tenantId) {
    where.status = 'PUBLISHED';
    where.visibility = 'PUBLIC';
  }

  const [items, total] = await Promise.all([
    prisma.post.findMany({ where, skip, take, orderBy: [{ publishedAt: 'desc' }, { createdAt: 'desc' }] }),
    prisma.post.count({ where }),
  ]);

  return res.json({ page, pageSize, total, items });
}

export async function getPostById(req: Request, res: Response) {
  const tenantId = req.tenantId || (req.query.tenant as string);
  if (!tenantId) return res.status(400).json({ error: 'tenant id required via X-Tenant-Id header or tenant query param' });

  const { id } = req.params;
  const post = await prisma.post.findFirst({ where: { id, tenantId } });
  if (!post) return res.status(404).json({ error: 'post not found' });

  if ((!req.user || req.user.tenantId !== tenantId) && (post.status !== 'PUBLISHED' || post.visibility !== 'PUBLIC')) {
    return res.status(403).json({ error: 'not allowed' });
  }

  return res.json(post);
}

export async function createPost(req: Request, res: Response) {
  const tenantId = req.user?.tenantId;
  if (!tenantId) return res.status(400).json({ error: 'missing tenant context' });

  const parse = postCreateSchema.safeParse(req.body);
  if (!parse.success) return res.status(400).json({ error: parse.error.flatten() });
  const data = parse.data;

  const created = await prisma.post.create({
    data: {
      tenantId,
      title: data.title,
      content: data.content,
      priceKES: data.priceKES,
      imagesJson: data.images ? JSON.stringify(data.images) : undefined,
      tags: data.tags || [],
      category: data.category,
      visibility: data.visibility || 'PUBLIC',
      status: data.status || 'DRAFT',
      location: data.location,
      contactPhone: data.contactPhone,
      publishedAt: data.publishedAt,
    },
  });
  return res.status(201).json(created);
}

export async function updatePost(req: Request, res: Response) {
  const tenantId = req.user?.tenantId;
  if (!tenantId) return res.status(400).json({ error: 'missing tenant context' });
  const { id } = req.params;

  const existing = await prisma.post.findFirst({ where: { id, tenantId } });
  if (!existing) return res.status(404).json({ error: 'post not found' });

  const parse = postUpdateSchema.safeParse(req.body);
  if (!parse.success) return res.status(400).json({ error: parse.error.flatten() });
  const data = parse.data;

  const updated = await prisma.post.update({
    where: { id },
    data: {
      title: data.title,
      content: data.content,
      priceKES: data.priceKES,
      imagesJson: data.images ? JSON.stringify(data.images) : undefined,
      tags: data.tags,
      category: data.category,
      visibility: data.visibility,
      status: data.status,
      location: data.location,
      contactPhone: data.contactPhone,
      publishedAt: data.publishedAt,
    },
  });
  return res.json(updated);
}

export async function deletePost(req: Request, res: Response) {
  const tenantId = req.user?.tenantId;
  if (!tenantId) return res.status(400).json({ error: 'missing tenant context' });
  const { id } = req.params;

  const existing = await prisma.post.findFirst({ where: { id, tenantId } });
  if (!existing) return res.status(404).json({ error: 'post not found' });

  await prisma.post.delete({ where: { id } });
  return res.status(204).send();
}