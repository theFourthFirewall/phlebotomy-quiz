import { createRouter, createWebHistory } from 'vue-router'
import WelcomeView from '../views/WelcomeView.vue'
import QuizView from '../views/QuizView.vue'
import CompletionView from '../views/CompletionView.vue'

const routes = [
  {
    path: '/',
    name: 'Welcome',
    component: WelcomeView
  },
  {
    path: '/quiz',
    name: 'Quiz',
    component: QuizView
  },
  {
    path: '/completion',
    name: 'Completion',
    component: CompletionView
  }
]

const router = createRouter({
  history: createWebHistory('/'),
  routes
})

export default router