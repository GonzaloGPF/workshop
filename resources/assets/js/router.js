import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes/routes';
import checkAuth from './middleware/check-auth';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes
});

// Global Middleware
router.beforeEach(checkAuth);

export default router;