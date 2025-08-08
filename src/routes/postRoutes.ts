import { Router } from 'express';
import { optionalAuth, requireAuth } from '../middleware/auth';
import { tenantContext } from '../middleware/tenantContext';
import { createPost, deletePost, getPostById, listPosts, updatePost } from '../controllers/postController';

const router = Router();

router.get('/', optionalAuth, tenantContext, listPosts);
router.get('/:id', optionalAuth, tenantContext, getPostById);
router.post('/', requireAuth, tenantContext, createPost);
router.put('/:id', requireAuth, tenantContext, updatePost);
router.delete('/:id', requireAuth, tenantContext, deletePost);

export default router;