<template>
    <div>
      <h2>Crear nuevo autor</h2>
  
      <input v-model="Autor.nombre_apellido" type="text" label="Nombre y Apellido" placeholder="Nombre y Apellido">
      <button @click="crearAutor">Guardar</button>
  
      <p v-if="mensaje">{{ mensaje }}</p>
    </div>
  </template>
  
  <script lang="ts">
  import axios from 'axios';
  
  export default {
    data() {
      return {
        Autor: {
          id: " ",
          nombre_apellido: "",
        },
        mensaje: "" 
      };
    },
    methods: {
      async crearAutor() {
        try {
         
          if (!this.Autor.nombre_apellido.trim()) {
            this.mensaje = "Por favor ingresa un nombre y apellido válidos para el autor.";
            return;
          }
  
          const res = await axios.post('http://192.168.20.10/apiv1/autores/nuevo', this.Autor);
          console.log(res.data); 
  
          this.Autor.nombre_apellido = "";
          this.mensaje = "Autor creado exitosamente.";
        } catch (error) {
          console.error(error);
          this.mensaje = "Ocurrió un error al crear el autor. Por favor intenta nuevamente.";
        }
      }
    }
  };
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
  



