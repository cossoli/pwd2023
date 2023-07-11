import { createRouter ,createWebHashHistory } from "vue-router";
import Home from '../components/Home.vue';
import 

const router = createRouter ({
    history: createWebHashHistory(import.meta.env.BASE_URL),
    routes:[
        {
           path:'/',
           name: 'Home',
           component:Home 
    }]
})
export default router;
