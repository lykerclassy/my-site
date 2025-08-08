import { Request, Response, NextFunction } from 'express';
import jwt from 'jsonwebtoken';
import { config } from '../config';

interface JwtClaims {
  sub: string;
  tenantId: string;
  role: string;
  iat?: number;
  exp?: number;
}

export function optionalAuth(req: Request, _res: Response, next: NextFunction) {
  const authHeader = req.header('authorization') || '';
  const token = authHeader.startsWith('Bearer ') ? authHeader.slice(7) : undefined;
  if (!token) return next();
  try {
    const decoded = jwt.verify(token, config.jwtSecret) as JwtClaims;
    req.user = { userId: decoded.sub, tenantId: decoded.tenantId, role: decoded.role };
  } catch {
    // ignore invalid token for optional auth
  }
  next();
}

export function requireAuth(req: Request, res: Response, next: NextFunction) {
  const authHeader = req.header('authorization') || '';
  const token = authHeader.startsWith('Bearer ') ? authHeader.slice(7) : undefined;
  if (!token) return res.status(401).json({ error: 'missing bearer token' });
  try {
    const decoded = jwt.verify(token, config.jwtSecret) as JwtClaims;
    req.user = { userId: decoded.sub, tenantId: decoded.tenantId, role: decoded.role };
    next();
  } catch {
    return res.status(401).json({ error: 'invalid or expired token' });
  }
}