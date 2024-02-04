<template>
    <h1> Listado de libros</h1>
   
    <RouterLink class ="crear" to="/libro/crear">
       <img src="../..assets/editar.svg" alt="" />Crear libros
    </RouterLink> 
    
    <table>
       <thead>
          <tr>
             <td>id</td>
             <td>titulo</td>
             <td>anio</td>
             <td>estado</td>
             <td>id_categoria</td>
             <td>id_editorial</td>
             <td>id_genero</td>
             <td>cant_paginas</td>
             <td>Acciones</td> <!-- Agregar columna para acciones -->
          </tr>
       </thead>
       <tbody>
          <tr v-for="libro in items" :key="libro.id">
             <td>{{ libro.id }}</td>
             <td>{{ libro.titulo }}</td>
             <td>{{ libro.anio }}</td>
             <td>{{ libro.estado }}</td>
             <td>{{ libro.id_categoria }}</td>
             <td>{{ libro.id_editorial }}</td>
             <td>{{ libro.id_genero }}</td>
             <td>{{ libro.cant_paginas }}</td>
             <td>
                <!-- Botón Editar -->
                <button @click="editarLibro(libro.id)" class="btn-editar">Editar</button>
                <!-- Botón Eliminar -->
                <button @click="eliminarLibro(libro.id)" class="btn-eliminar">Eliminar</button>
             </td>  
          </tr>      
       </tbody>
    </table>
 </template>
   
 <script lang="ts">
 import axios from 'axios';
 import Boton from '../Boton.vue';
 
 export default {
    components :{Boton},
    data() {
       return {
          items: []
       };
    },
    created() {
       this.Listar();
    }, 
    methods:{
       async Listar(){
          const res = await axios.get('http://192.168.20.10/apiv1/libros');
          this.items = res.data;
       },
       editarLibro(id) {
          this.$router.push(`/libros/Actualizar/${id}`);
       },
       eliminarLibro(id) {
          // Lógica para eliminar el libro con el ID proporcionado
       }
    }
 }
 </script>
 
 <style scoped>
 table {
    background:#fff ;
    border-radius: 10px;
    inset: 10px 50px 10px;
    box-shadow: 5px 5px 50px rgb(4,96,0.2);
    width: 100%;
    color:black;
    margin: 20px;
    padding: 15px;
 }
 thead {
    
 }
 .btn-editar {
    background-color: #3498db; /* Color azul */
    color: #fff; /* Texto blanco */
    margin-right: 5px; /* Espacio entre botones */
 }
 .btn-eliminar {
    background-color: #e74c3c; /* Color rojo */
    color: #fff; /* Texto blanco */
 }
 </style>
 