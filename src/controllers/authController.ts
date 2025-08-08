import { Request, Response } from 'express';
import { prisma } from '../lib/prisma';
import { loginSchema, registerSchema } from '../utils/validators';
import bcrypt from 'bcryptjs';
import jwt from 'jsonwebtoken';
import { config } from '../config';

export async function register(req: Request, res: Response) {
  const parse = registerSchema.safeParse(req.body);
  if (!parse.success) return res.status(400).json({ error: parse.error.flatten() });
  const { tenantId, name, email, password } = parse.data;

  const tenant = await prisma.tenant.findUnique({ where: { id: tenantId } });
  if (!tenant) return res.status(404).json({ error: 'tenant not found' });

  const passwordHash = await bcrypt.hash(password, 10);
  try {
    const user = await prisma.user.create({
      data: { tenantId, name, email: email.toLowerCase(), password: passwordHash },
    });
    return res.status(201).json({ id: user.id, tenantId: user.tenantId, name: user.name, email: user.email });
  } catch (err: any) {
    if (err.code === 'P2002') return res.status(409).json({ error: 'email already in use for this tenant' });
    return res.status(500).json({ error: 'failed to register user' });
  }
}

export async function login(req: Request, res: Response) {
  const parse = loginSchema.safeParse(req.body);
  if (!parse.success) return res.status(400).json({ error: parse.error.flatten() });
  const { tenantId, email, password } = parse.data;

  const user = await prisma.user.findFirst({ where: { tenantId, email: email.toLowerCase() } });
  if (!user) return res.status(401).json({ error: 'invalid credentials' });

  const ok = await bcrypt.compare(password, user.password);
  if (!ok) return res.status(401).json({ error: 'invalid credentials' });

  const token = jwt.sign(
    { sub: user.id, tenantId: user.tenantId, role: user.role },
    config.jwtSecret,
    { expiresIn: '7d' }
  );

  return res.json({ token });
}