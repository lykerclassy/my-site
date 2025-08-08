import { z } from 'zod';

export const kenyaPhoneRegex = /^(?:\+254|0)(?:7\d{8}|1\d{8})$/;

export const tenantCreateSchema = z.object({
  name: z.string().min(2).max(100),
  slug: z
    .string()
    .min(3)
    .max(50)
    .regex(/^[a-z0-9-]+$/, 'slug must be lowercase letters, numbers, or hyphens'),
  contactPhone: z.string().regex(kenyaPhoneRegex, 'invalid Kenyan phone number'),
  county: z.string().optional(),
  town: z.string().optional(),
});

export const registerSchema = z.object({
  tenantId: z.string().cuid(),
  name: z.string().min(2).max(100),
  email: z.string().email(),
  password: z.string().min(8).max(100),
});

export const loginSchema = z.object({
  tenantId: z.string().cuid(),
  email: z.string().email(),
  password: z.string().min(8).max(100),
});

export const postCreateSchema = z.object({
  title: z.string().min(3).max(140),
  content: z.string().min(1).max(10_000),
  priceKES: z.number().int().positive().optional(),
  images: z.array(z.string().url()).max(10).optional(),
  tags: z.array(z.string().min(1).max(30)).max(20).optional(),
  category: z.string().max(60).optional(),
  visibility: z.enum(['PUBLIC', 'PRIVATE']).optional(),
  status: z.enum(['DRAFT', 'PUBLISHED', 'ARCHIVED']).optional(),
  location: z.string().max(120).optional(),
  contactPhone: z.string().regex(kenyaPhoneRegex).optional(),
  publishedAt: z.coerce.date().optional(),
});

export const postUpdateSchema = postCreateSchema.partial();

export const paginationQuerySchema = z.object({
  page: z.coerce.number().int().min(1).default(1),
  pageSize: z.coerce.number().int().min(1).max(100).default(20),
  search: z.string().optional(),
  tags: z.string().optional(), // comma-separated
  category: z.string().optional(),
  status: z.enum(['DRAFT', 'PUBLISHED', 'ARCHIVED']).optional(),
  visibility: z.enum(['PUBLIC', 'PRIVATE']).optional(),
});