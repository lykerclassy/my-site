import { Router } from 'express';
import { createTenant, getTenantById, getTenantBySlug } from '../controllers/tenantController';

const router = Router();

router.post('/', createTenant);
router.get('/:id', getTenantById);
router.get('/by-slug/:slug', getTenantBySlug);

export default router;