import { createRouter, createWebHistory } from 'vue-router';
import userRoutes from '@/routes/users';

const routes = [
    ...userRoutes,
];

const router = createRouter({
	scrollBehavior() {
		return { top: 0 };
	},
	history: createWebHistory(),
	routes
});

export default router;