import ProductsPage from '@/views/ProductsPage.vue'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: ProductsPage,
    },
    {
      path: '/inventory',
      name: 'inventory',
      component: () => import('../views/InventoryPage.vue'),
    },
    {
      path: '/shop',
      name: 'shop',
      component: () => import('../views/InventoryPage.vue'),
    },
  ],
})

export default router
