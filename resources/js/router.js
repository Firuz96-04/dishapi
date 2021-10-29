import {createRouter, createWebHistory} from "vue-router"
import Step from "./components/Step";
export default createRouter({
    history:createWebHistory(),
    routes: [
        {
            name: 'ingredient',
            path: '/ingredient',
            alias:'/',
            component: () => import('./components/Ingredients.vue')
        },
        {
            name: 'category',
            path: '/category',
            component: () => import('./components/Category.vue')
        },
        {
            name: 'product',
            path: '/product',
            component: () => import('./components/Recipes.vue')
        },

    ]
})
