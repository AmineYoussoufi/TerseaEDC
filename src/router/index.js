import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import(/* webpackChunkName: "about" */ '../pages/Home.vue')
  },
  {
    path: '/administrateurs',
    name: 'Administrateurs',
    component: () => import(/* webpackChunkName: "about" */ '../pages/admin/administrateurs.vue')
  },
  {
    path: '/societes',
    name: 'Societes',
    component: () => import(/* webpackChunkName: "about" */ '../pages/admin/societes.vue')
  },
  {
    path: '/employes',
    name: 'Employes',
    component: () => import(/* webpackChunkName: "about" */ '../pages/admin/employes.vue')
  },
  {
    path: '/historique',
    name: 'Historique',
    component: () => import(/* webpackChunkName: "about" */ '../pages/admin/historique.vue')
  },
  {
    path: '/invitation',
    name: 'Invitation',
    component: () => import(/* webpackChunkName: "about" */ '../pages/Invitation.vue')
  },
  {
    path: '/ma-societe',
    name: 'MaSociete',
    component: () => import(/* webpackChunkName: "about" */ '../pages/Societe.vue')
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import(/* webpackChunkName: "about" */ '../pages/Login.vue')
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
