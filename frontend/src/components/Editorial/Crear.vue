<template>
    <div>
      <h2>Crear nueva editorial</h2>
  
      <input v-model="editoriales.nombre" type="text" label="Nombre" placeholder="Nombre">
      <button @click="crearEditorial">Guardar</button>
  
      <p v-if="mensaje">{{ mensaje }}</p>
    </div>
  </template>
  
  <script lang="ts">
  import axios from 'axios';
  
  export default {
    data() {
      return {
        editoriales: {
          id: "",
          nombre: "",
          activo: 1
        },
        mensaje: "" // Mensaje de retroalimentación para el usuario
      };
    },
    methods: {
      async crearEditorial() {
        try {
          // Validar que el nombre no esté vacío
          if (!this.editoriales.nombre.trim()) {
            this.mensaje = "Por favor ingresa un nombre válido para la editorial.";
            return;
          }
  
          const res = await axios.post('http://192.168.20.10/apiv1/editoriales/nuevo', this.editoriales);
          console.log(res.data); // Manejar la respuesta según sea necesario
  
          // Limpiar el formulario y mostrar mensaje de éxito
          this.editoriales.nombre = "";
          this.mensaje = "Editorial creada exitosamente.";
        } catch (error) {
          console.error(error);
          this.mensaje = "Ocurrió un error al crear la editorial. Por favor intenta nuevamente.";
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
  


