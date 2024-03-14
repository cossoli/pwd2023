<template>
    <h2>Crear nuevo préstamo</h2>
  
    <input v-model="prestamo.id" type="number" label="ID" placeholder="ID">
    <input v-model="prestamo.socio" type="number" label="ID Socio" placeholder="ID Socio">
    <input v-model="prestamo.libro" type="number" label="ID Libro" placeholder="ID Libro">
    <input v-model="prestamo.fecha_desde" type="date" label="Fecha desde">
    <input v-model="prestamo.fecha_hasta" type="date" label="Fecha hasta">
    <input v-model="prestamo.fecha_dev" type="date" label="Fecha devolución">
  
    <button @click="crearPrestamo">Guardar</button>
  </template>
  
  <script lang="ts">
  import axios from 'axios';
  
  export default {
    data() {
      return {
        prestamo: {
          id: "",
          socio: "",
          libro: "",
          fecha_desde: new Date().toISOString().substring(0, 10),
          fecha_hasta: new Date().toISOString().substring(0, 10),
          fecha_dev: new Date().toISOString().substring(0, 10)
        },
        socio: [],
        libro: [],
        cargando: false,
        mensajeError: ""
      }
    },
    created() {
        this.crearPrestamo;
    },

    methods: {
      async crearPrestamo() {
        console.log(this.prestamo);
        try {
          const res = await axios.post('http://192.168.20.10/apiv1/prestamos/nuevo', this.prestamo);
          console.log(res.data); // Manejar la respuesta según sea necesario
          // Aquí podrías redirigir a otra página o realizar otra acción después de crear el préstamo
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
  



