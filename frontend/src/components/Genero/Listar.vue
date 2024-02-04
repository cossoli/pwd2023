<template>
    <div>
      <h1>Listado de Géneros</h1>
      <router-link to="/genero/crear" class="crear btn">
        <img src="../../assets/editar.svg" alt="">Crear Género
      </router-link>
  
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="genero in items" :key="genero.id">
            <td>{{ genero.id }}</td>
            <td>{{ genero.descripcion }}</td>
            <td>
              <button @click="editarGenero(genero)" class="editar btn">Editar</button>
              <button @click="eliminarGeneroConfirmacion(genero)" class="eliminar btn">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script lang="ts">
  import axios from 'axios';
  
  export default {
    data() {
      return {
        items: []
      };
    },
    created() {
      this.listarGeneros();
    },
    methods: {
      async listarGeneros() {
        try {
          const response = await axios.get('http://192.168.20.10/apiv1/generos');
          this.items = response.data;
        } catch (error) {
          console.error(error);
        }
      },
      async eliminarGeneroConfirmacion(genero) {
        if (confirm(`¿Estás seguro de que quieres eliminar el género "${genero.descripcion}"?`)) {
          await this.eliminarGenero(genero);
        }
      },
      async eliminarGenero(genero) {
        try {
          const response = await axios.delete(`http://192.168.20.10/apiv1/generos/${genero.id}`);
          this.items = this.items.filter(item => item.id !== genero.id);
          console.log(response.data); // Mostrar mensaje de éxito si es necesario
        } catch (error) {
          console.error(error);
          // Mostrar mensaje de error si es necesario
        }
      },
      editarGenero(genero) {
        this.$router.push(`/genero/Actualizar/${genero.id}`);
      }
    }
  };
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
  
  table th {
    background-color: #f2f2f2;
  }
  
  .btn {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  .crear {
    background-color: #4caf50;
    color: white;
  }
  
  .editar {
    background-color: #2196f3;
    color: white;
  }
  
  .eliminar {
    background-color: #f44336;
    color: white;
  }
  </style>
  