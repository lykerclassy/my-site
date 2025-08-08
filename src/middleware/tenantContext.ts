import { Request, Response, NextFunction } from 'express';

export function tenantContext(req: Request, res: Response, next: NextFunction) {
  const headerTenant = (req.header('x-tenant-id') || req.header('X-Tenant-Id') || '').trim();
  const tokenTenant = req.user?.tenantId;
  const tenantId = headerTenant || tokenTenant;

  if (tenantId) {
    req.tenantId = tenantId;
  }

  next();
}