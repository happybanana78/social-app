import './bootstrap';

import {createApp} from 'vue'
import router from "./router"

import App from './App.vue'

// let status = false

// function loggedIn() {
//     if (localStorage.getItem('token')) {
//       status = true
//     }
//     return status
// }

// router.beforeEach((to, from, next) => {
//     if (to.matched.some(record => record.meta.requiresAuth)) {
//       if (!loggedIn()) {
//         next({ name: 'LoginPage' })
//       } else {
//         next()
//       }
//     } else if (to.matched.some(record => record.meta.guest)) {
//         if (loggedIn()) {
//             next({ name: 'HomePage'})
//         } else {
//             next()
//         }
//     }
//   })

createApp(App).use(router).mount("#app")