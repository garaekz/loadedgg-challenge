import { createRouter, createWebHistory } from 'vue-router';
import userRoutes from '@/routes/users';

const routes = [
    ...userRoutes,
	{
		path: '/:pathMatch(.*)*',
		name: 'not-found',
		component: () => import('@/views/NotFound.vue')
	}
];

const router = createRouter({
	scrollBehavior() {
		return { top: 0 };
	},
	history: createWebHistory(),
	routes
});

export default router;