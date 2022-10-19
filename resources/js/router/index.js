import { createWebHistory, createRouter } from "vue-router";
import HomePage from "../views/HomePage.vue";
import SignupPage from "../views/SignupPage.vue";
import LoginPage from "../views/LoginPage.vue";
import CommentsPage from "../views/CommentsPage.vue";
import ProfilePage from "../views/ProfilePage.vue";
import NotFoundPage from "../views/404Page.vue";

const routes = [
    // Home
    {
        path: "/",
        name: "HomePage",
        component: HomePage,
        meta: {
            requiresAuth: true
        }
    },
    // Register account
    {
        path: "/signup",
        name: "SignupPage",
        component: SignupPage,
        meta: {
            hideForAuth: true
        }
    },
    // Login
    {
        path: "/login",
        name: "LoginPage",
        component: LoginPage,
        meta: {
            hideForAuth: true
        }
    },
    // Profile
    {
        path: "/profile/:username",
        name: "ProfilePage",
        component: ProfilePage,
        meta: {
            requiresAuth: true
        }
    },
    // Comments page
    {
        path: "/comments/:id",
        name: "CommentsPage",
        component: CommentsPage,
        meta: {
            requiresAuth: true
        }
    },
    // 404 Page not found
    {
        path: "/:catchAll(.*)",
        name: "NotFoundPage",
        component: NotFoundPage,
    },
];


const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;