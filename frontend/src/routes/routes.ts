

import { createRouter, createWebHistory } from 'vue-router';
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
import CrearLibro from '../components/Libro/Crear.vue'
import ActualizarLibro from '../components/Libro/Actualizar.vue';
import ListarPrestamo from '../components/Prestamo/Listar.vue';
import CrearPrestamo from '../components/Prestamo/Crear.vue';
import ActualizarPrestamo from '../components/Prestamo/Actualizar.vue';

const router = createRouter({
   history: createWebHistory(import.meta.env.BASE_URL),
   routes: [
      {
         path: '/Home',
         name: 'Home',
         component: Home,
      },
    

         {
         path: '/Socios',
         name: 'Socios',
         component: ListarSocios,
      },
      {
         path: '/Socios/crear',
         name: 'Crear',
         component: CrearSocios,

      },
      {
         path: '/Socios/actualizar/:id',
         name: 'Actualizar',
         component: ActualizarSocios,

      },
      {
         path: '/Autor',
         name: 'Autor',
         component: ListarAutores,
      },
      {
         path: '/Autor/crear',
         name: 'CrearAutores',
         component: CrearAutores,

      },
      {
         path: '/Autor/actualizar',
         name: 'ActualizarAutores',
         component: ActualizarAutores,
      },
      {
         path: '/Genero',
         name: 'Genero',
         component: ListarGenero,

      },

      {
         path:'/Genero/crear',
         name: 'CrearGenero',
         component: CrearGenero,

      },
      {
         path:'/Genero/actualizar',
         name: 'ActualizarGenero',
         component: ActualizarGenero,

      },
      {
         path: '/Libro',
         name: 'Libro',
         component: ListarLibro,

      },
      {
         path: '/Libro/crear',
         name: 'Libro',
         component: CrearLibro,

      },

{
         path: '/Libro/actualizar',
         name: 'Libro',
         component: ActualizarLibro,

      },



      {
         path: '/Editorial',
         name: 'Editorial',
         component: ListarEditorial,

      },
      {
         path: '/Editorial/crear',
         name: 'CrearEditorial',
         component: CrearEditorial,

      },

      {
         path: '/Editorial/actualizar',
         name: 'ActualizarEditorial',
         component: ActualizarEditorial,

      },


      {
         path: '/Categoria',
         name: 'Categoria',
         component: ListarCategoria,

      }, 


      {
         path: '/Categoria/crear',
         name: 'CrearCategoria',
         component: CrearCategoria,

      },

      {
         path: '/Categoria/actualizar',
         name: 'ActualizarCategoria',
         component: ActualizarCategoria,

      },
     


      {
         path: '/Prestamo',
         name: 'Prestamo',
         component: ListarPrestamo,

      } ,
      {
         path: '/Prestamo/crear',
         name: 'Prestamo',
         component: CrearPrestamo,

      } ,
      {
         path: '/Prestamo/actualizar',
         name: 'Prestamo',
         component: ActualizarPrestamo,

      } ,







   ]

})
export default router;
