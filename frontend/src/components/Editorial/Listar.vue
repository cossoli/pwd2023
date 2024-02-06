<template>
    <h1>Listado de Editorial</h1>
   
    <router-link class="crear" to="/editorial/crear">
       <img src="../..assets/editar.svg" alt="" />Crear Editorial
    </router-link> 
    
    <table>
       <thead>
          <tr>
             <td>ID</td>
             <td>Nombre</td>
             <td>Acciones</td>
          </tr>
       </thead>
       <tbody>
          <tr v-for="editorial in items" :key="editorial.id">
             <td>{{ editorial.id }}</td>
             <td>{{ editorial.nombre }}</td>
             <td>
                <button @click="editarEditorial(editorial.id)" class="btn-editar">Editar</button>
                <button @click="eliminarEditorialConfirmacion(editorial.id)" class="btn-eliminar">Eliminar</button>
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
       this.listarEditoriales();
    }, 
    methods: {
       async listarEditoriales() {
          try {
             const res = await axios.get('http://192.168.20.10/apiv1/editoriales');
             this.items = res.data;
          } catch (error) {
             console.error(error);
          }
       },
       editarEditorial(id) {
          this.$router.push(`/Editorial/Actualizar/${id}`);
       },

       async eliminarEditorialConfirmacion(editorial) {
      if (confirm(`¿Estás seguro de que quieres eliminar la editorial ${editorial.id}?`)) {
        await this.eliminarEditorial(editorial);
      }
    },
       async eliminarEditorial(id) {
          try {
             const res = await axios.delete(`http://192.168.20.10/apiv1/editoriales/${id}`);
             console.log(res.data);
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
 