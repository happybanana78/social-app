import './bootstrap';

import {createApp} from 'vue'
import router from "./router"

import App from './App.vue'

let status = false

function loggedIn() {
    if (localStorage.getItem('token')) {
      status = true
    }
    return status
}

// Prevent unlogged users to go to the home page
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      if (!loggedIn()) {
        next({ name: 'LoginPage' })
      } else {
        next()
      }
    } else {
      next()
    }
  })

  // Prevent logged in users to log in again
  router.beforeEach((to, from, next) => {    
    if (to.matched.some(record => record.meta.hideForAuth)) {
        if (loggedIn()) {
          next({ name: 'HomePage' })
        } else {
          next()
        }
      } else {
        next()
      }
  })

createApp(App).use(router).mount("#app")