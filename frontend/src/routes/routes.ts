

import { createRouter, createWebHashHistory } from "vue-router";
import Home from '../components/Home.vue';
import AcercaDe from '../components/AcercaDe.vue';
import Listar from '../components/Socios/Listar.vue';

const router = createRouter ({
    history: createWebHashHistory(import.meta.env.BASE_URL),
    routes:[
        {
           path:'/',
           name: 'Home',
           component: Home 
        },

        {
            path:'/AcerdaDe',
            name: 'AcercaDe',
            component: AcercaDe
     },
     {
        path:'/Socios',
        name: 'Socios',
        component: Listar

 }]
     
})
export default router;
