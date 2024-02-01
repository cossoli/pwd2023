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
          id: 4,
          nombre_apellido: "",
        },
        mensaje: "" // Mensaje de retroalimentación para el usuario
      };
    },
    methods: {
      async crearAutor() {
        try {
          // Validar que el nombre y apellido no estén vacíos
          if (!this.Autor.nombre_apellido.trim()) {
            this.mensaje = "Por favor ingresa un nombre y apellido válidos para el autor.";
            return;
          }
  
          const res = await axios.post('http://192.168.20.10/apiv1/autores/nuevo', this.Autor);
          console.log(res.data); // Manejar la respuesta según sea necesario
  
          // Limpiar el formulario y mostrar mensaje de éxito
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
  



