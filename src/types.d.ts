import 'express';

declare module 'express-serve-static-core' {
  interface Request {
    user?: { userId: string; tenantId: string; role: string };
    tenantId?: string;
  }
}