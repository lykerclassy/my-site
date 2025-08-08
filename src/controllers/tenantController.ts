import { Request, Response } from 'express';
import { prisma } from '../lib/prisma';
import { tenantCreateSchema } from '../utils/validators';

export async function createTenant(req: Request, res: Response) {
  const parse = tenantCreateSchema.safeParse(req.body);
  if (!parse.success) return res.status(400).json({ error: parse.error.flatten() });

  const data = parse.data;
  try {
    const tenant = await prisma.tenant.create({ data });
    return res.status(201).json(tenant);
  } catch (err: any) {
    if (err.code === 'P2002') {
      return res.status(409).json({ error: 'slug already in use' });
    }
    return res.status(500).json({ error: 'failed to create tenant' });
  }
}

export async function getTenantById(req: Request, res: Response) {
  const { id } = req.params;
  const tenant = await prisma.tenant.findUnique({ where: { id } });
  if (!tenant) return res.status(404).json({ error: 'tenant not found' });
  return res.json(tenant);
}

export async function getTenantBySlug(req: Request, res: Response) {
  const { slug } = req.params;
  const tenant = await prisma.tenant.findUnique({ where: { slug } });
  if (!tenant) return res.status(404).json({ error: 'tenant not found' });
  return res.json(tenant);
}