<template>
    <div>
      <h2>Crear nueva categoría</h2>
  
      <input v-model="categoria.descripcion" type="text" label="Descripción" placeholder="Descripción">
      <button @click="crearCategoria">Guardar</button>
  
      <p v-if="mensaje">{{ mensaje }}</p>
    </div>
  </template>
  
  <script lang="ts">
  import axios from 'axios';
  
  export default {
    data() {
      return {
        categoria: {
          id: "",
          descripcion: "",
          activo: 1
        },
        mensaje: "" // Mensaje de retroalimentación para el usuario
      };
    },
    methods: {
      async crearCategoria() {
        try {
          // Validar que la descripción no esté vacía
          if (!this.categoria.descripcion.trim()) {
            this.mensaje = "Por favor ingresa una descripción válida para la categoría.";
            return;
          }
  
          const res = await axios.post('http://192.168.20.10/apiv1/categorias/nuevo', this.categoria);
          console.log(res.data); // Manejar la respuesta según sea necesario
  
          // Limpiar el formulario y mostrar mensaje de éxito
          this.categoria.descripcion = "";
          this.mensaje = "Categoría creada exitosamente.";
        } catch (error) {
          console.error(error);
          this.mensaje = "Ocurrió un error al crear la categoría. Por favor intenta nuevamente.";
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
  

