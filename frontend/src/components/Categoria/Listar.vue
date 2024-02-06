<template>
    <h1> Listado de Categorías</h1>
   
    <RouterLink class="crear" to="/categoria/crear">
       <img src="../..assets/editar.svg" alt="" />Crear Categoría
    </RouterLink> 
    
    <table>
       <thead>
          <tr>
             <td>ID</td>
             <td>Nombre</td>
             <td>Acciones</td>
          </tr>
       </thead>
       <tbody>
          <tr v-for="categoria in items" :key="categoria.id">
             <td>{{ categoria.id }}</td>
             <td>{{ categoria.descripcion }}</td>
             <td>
                <!-- Botón Editar -->
                <button @click="editarCategoria(categoria.id)" class="btn-editar">Editar</button>
                <!-- Botón Eliminar -->
                <button @click="eliminarCategoriaConfirmacion(categoria)" class="btn-eliminar">Eliminar</button>
             </td>  
          </tr>      
       </tbody>
    </table>
 </template>
   
 <script lang="ts">
 import axios from 'axios';
 import Boton from '../Boton.vue';
 
 export default {
    components: { Boton },
    data() {
       return {
          items: []
       };
    },
    created() {
       this.listarCategorias();
    }, 
    methods: {
       async listarCategorias() {
          try {
             const res = await axios.get('http://192.168.20.10/apiv1/categorias');
             this.items = res.data;
          } catch (error) {
             console.error(error);
          }
       },
       editarCategoria(categoria) {
          this.$router.push(`/Categoria/Actualizar/${categoria.id}`);
       },
       async eliminarCategoriaConfirmacion(categoria) {
          if (confirm(`¿Estás seguro de eliminar la categoría ${categoria.descripcion}?`)) {
             await this.eliminarCategoria(categoria.id);
          }
       },
       async eliminarCategoria(id) {
          try {
             const res = await axios.delete(`http://192.168.20.10/apiv1/categorias/${id}`);
             console.log(res.data);
             // Eliminar la categoría del array items
             this.items = this.items.filter(item => item.id !== id);
          } catch (error) {
             console.error(error);
          }
       }
    }
 }
 </script>
 
 <style scoped>
 table {
    background: #fff;
    border-radius: 10px;
    inset: 10px 50px 10px;
    box-shadow: 5px 5px 50px rgb(4, 96, 0.2);
    width: 100%;
    color: black;
    margin: 20px;
    padding: 15px;
 }
 thead {
    background-color: #f2f2f2;
 }
 .btn-editar {
    background-color: #3498db; /* Azul */
    color: #fff;
 }
 .btn-eliminar {
    background-color: #e74c3c; /* Rojo */
    color: #fff;
 }
 .crear {
    background-color: #27ae60; /* Verde */
    color: #fff;
    padding: 8px 12px;
    border-radius: 5px;
    text-decoration: none;
 }
 </style>
 