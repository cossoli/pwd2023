

import { createRouter, createWebHistory } from "vue-router";
import Home from '../components/Home.vue';
import ListarSocios from '../components/Socios/Listar.vue';
import CrearSocios from '../components/Socios/Crear.vue';
import ActualizarSocios from '../components/Socios/Actualizar.vue';
import ListarAutores from '../components/Autor/Listar.vue';
import CrearAutores from '../components/Autor/Crear.vue';
import ActualizarAutores from '../components/Autor/Actualizar.vue';
import ListarGenero from '../components/Genero/Listar.vue';
import CrearGenero from '../components/Genero/Crear.vue';
import ActualizarGenero from '../components/Genero/Actualizar.vue';
import ListarEditorial from '../components/Editorial/Listar.vue';
import CrearEditorial from '../components/Editorial/Crear.vue';
import ActualizarEditorial from '../components/Editorial/Actualizar.vue';
import ListarCategoria from '../components/Categoria/Listar.vue';
import CrearCategoria from '../components/Categoria/Crear.vue';
import ActualizarCategoria from '../components/Categoria/Actualizar.vue';
import ListarLibro from '../components/Libro/Listar.vue';
import ListarPrestamo from '../components/Prestamo/Listar.vue';



const router = createRouter({
   history: createWebHistory(import.meta.env.BASE_URL),
   routes: [
      {
         path: '/',
         name: 'Home',
         component: Home
      },

         {
         path: '/Socios',
         name: 'Socios',
         component: ListarSocios

      },
      {
         path: '/Socios/crear',
         name: 'CrearSocios',
         component: CrearSocios

      },

      {
         path: '/Socios/actualizar',
         name: 'ActualizarSocios',
         component: ActualizarSocios

      },

      {
         path: '/Autor',
         name: 'Autor',
         component: ListarAutores

      },
      {
         path: '/Autor/crear',
         name: 'CrearAutores',
         component: CrearAutores

      },
      {
         path: '/Autor/actualizar',
         name: 'ActualizarAutores',
         component: ActualizarAutores

      },
      {
         path: '/Genero',
         name: 'ListarGenero',
         component: ListarGenero

      },
      {
         path:'/Genero/crear',
         name: 'CrearGenero',
         component: CrearGenero

      },
      {
         path:'/Genero/actualizar',
         name: 'ActualizarGenero',
         component: ActualizarGenero

      },
      {
         path: '/Editorial',
         name: 'ListarEditorial',
         component: ListarEditorial

      },
      {
         path: '/Editorial/crear',
         name: 'CrearEditorial',
         component: CrearEditorial

      },

      {
         path: '/Editorial/actualizar',
         name: 'ActualizarEditorial',
         component: ActualizarEditorial

      },


      {
         path: '/Libro',
         name: 'ListarLibro',
         component: ListarLibro

      },

      {
         path: '/Categoria/crear',
         name: 'CrearCategoria',
         component: CrearCategoria

      },

      {
         path: '/Categoria/actualizar',
         name: 'ActualizarCategoria',
         component: ActualizarCategoria

      },
      {
         path: '/Categoria',
         name: 'ListarCategoria',
         component: ListarCategoria

      }, 



      {
         path: '/Prestamo',
         name: 'listarPrestamo',
         component: ListarPrestamo

      }






   ]

})
export default router;
