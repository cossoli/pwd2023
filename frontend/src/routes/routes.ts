

import { createRouter, createWebHashHistory } from "vue-router";
import Home from '../components/Home.vue';
import AcercaDe from '../components/AcercaDe.vue';
import ListarSocios from '../components/Socios/Listar.vue';
import ListarAutores from '../components/Autor/Listar.vue';
import ListarGenero from '../components/Genero/Listar.vue';
import ListarEditorial from '../components/Editorial/Listar.vue';
import ListarCategoria from '../components/Categoria/Listar.vue';
import ListarLibro from '../components/Libro/Listar.vue';
import ListarPrestmao from '../components/Prestamo/Listar.vue';

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
           component: ListarSocios

        },
        {
            path:'/Autor',
            name: 'Autor',
            component: ListarAutores
 
         },
         {
            path:'/Genero',
            name: 'Genero',
            component: ListarGenero
 
         },
         {
            path:'/Editorial',
            name: 'Editorial',
            component: ListarEditorial
 
         },
         {
            path:'/Libro',
            name: 'Libro',
            component: ListarLibro
 
         },

 {
            path:'/Categoria',
            name: 'Categoria',
            component: ListarCategoria
 
         },
         {
            path:'/Prestamo',
            name: 'Prestamo',
            component: ListarPrestmao
 
         }






]
     
})
export default router;
