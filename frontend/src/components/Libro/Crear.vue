
<template>
    <h2>Crear nuevo libro</h2>
  
    <input v-model="libro.estado" type="text" label="Estado" placeholder="Estado">
    <input v-model="libro.titulo" type="text" label="Título" placeholder="Título">
    <input v-model="libro.anio" type="date" label="Año" placeholder="Año">
    <input v-model="libro.id_categoria" type="number" label="Categoría" placeholder="ID Categoría">
    <input v-model="libro.id_editorial" type="number" label="Editorial" placeholder="ID Editorial">
    <input v-model="libro.id_genero" type="number" label="Género" placeholder="ID Género">
    <input v-model="libro.cant_paginas" type="number" label="Cantidad de páginas" placeholder="Cantidad de páginas">
  
    <button @click="crearLibro">Guardar</button>
  </template>
  
  <script lang="ts">
  import axios from 'axios';
  
  export default {
    data() {
      return {
        libro: {
          id: "",
          anio: "",
          estado: "",
          titulo: "",
          id_categoria: "",
          id_editorial: "",
          id_genero: "",
          cant_paginas: ""
        }
      }
    },
    methods: {
      async crearLibro() {
        console.log(this.libro);
        try {
          const res = await axios.post('http://192.168.20.10/apiv1/libros/nuevo', this.libro);
          console.log(res.data); // Manejar la respuesta según sea necesario
          // Aquí podrías redirigir a otra página o realizar otra acción después de crear el libro
        } catch (error) {
          console.error(error);
          // Manejar errores de la solicitud HTTP
        }
      }
    }
  }
  </script>
  
  <style>
  input {
    width: 50%;
    font-size: 1.2em;
    display: flex;
    align-content: center;
    padding: 10px;
    margin: 15px;
  }
  </style>
  


