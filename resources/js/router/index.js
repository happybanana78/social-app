import { createWebHistory, createRouter } from "vue-router";
import HomePage from "../views/HomePage.vue";
import SignupPage from "../views/SignupPage.vue";
import LoginPage from "../views/LoginPage.vue";
import CommentsPage from "../views/CommentsPage.vue";
import NotFoundPage from "../views/404Page.vue";

const routes = [
    // Main routes
    {
        path: "/",
        name: "HomePage",
        component: HomePage,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: "/signup",
        name: "SignupPage",
        component: SignupPage,
    },
    {
        path: "/login",
        name: "LoginPage",
        component: LoginPage,
        meta: {
            hideForAuth: true
        }
    },
    // Comments page
    {
        path: "/comments/:id",
        name: "CommentsPage",
        component: CommentsPage,
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