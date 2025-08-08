import { Router } from 'express';
import tenantRoutes from './tenantRoutes';
import authRoutes from './authRoutes';
import postRoutes from './postRoutes';

const router = Router();

router.use('/tenants', tenantRoutes);
router.use('/auth', authRoutes);
router.use('/posts', postRoutes);

export default router;