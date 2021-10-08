import { createRouter, createWebHistory } from 'vue-router'
import Secret from './pages/Secret.vue'
import Hash from './pages/Hash.vue'

export default createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      component: Secret,
    },
    {
        path: '/hash',
        component: Hash,
    }
  ]
})