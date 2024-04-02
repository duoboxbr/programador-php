import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'cursos',
    component: () => import('../views/Cursos.vue')
  },
  {
    path: '/alunos',
    name: 'alunos',
    component: () => import('../views/Alunos.vue')
  },
  {
    path: '/matriculas',
    name: 'matriculas',
    component: () => import('../views/Matriculas.vue')
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
