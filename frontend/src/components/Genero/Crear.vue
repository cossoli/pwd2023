<template>
    <div>
      <h2>Crear nuevo género</h2>
  
      <input v-model="genero.descripcion" type="text" label="Descripción" placeholder="Descripción">
      <button @click="crearGenero">Guardar</button>
  
      <p v-if="mensaje">{{ mensaje }}</p>
    </div>
  </template>
  
  <script lang="ts">
  import axios from 'axios';
  
  export default {
    data() {
      return {
        genero: {
          id: "",
          descripcion: "",
          activo: 1
        },
        mensaje: "" // Mensaje de retroalimentación para el usuario
      };
    },
    methods: {
      async crearGenero() {
        try {
          // Validar que la descripción no esté vacía
          if (!this.genero.descripcion.trim()) {
            this.mensaje = "Por favor ingresa una descripción válida para el género.";
            return;
          }
  
          const res = await axios.post('http://192.168.20.10/apiv1/generos/nuevo', this.genero);
          console.log(res.data); // Manejar la respuesta según sea necesario
  
          // Limpiar el formulario y mostrar mensaje de éxito
          this.genero.descripcion = "";
          this.mensaje = "Género creado exitosamente.";
        } catch (error) {
          console.error(error);
          this.mensaje = "Ocurrió un error al crear el género. Por favor intenta nuevamente.";
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
  


