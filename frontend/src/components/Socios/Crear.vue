
<template>
    <h2>Crear nuevo socio</h2>
    <input v-model="Socio.nombre_apellido" type="text" label="Nombre y Apellido" placeholder="Nombre y Apellido">
    <input v-model="Socio.telefono" type="text" label="Telefono" placeholder="Telefono">
    <input v-model="Socio.direccion" type="text" label="Direccion" placeholder="Direccion">
    <button @click="crearSocios">GUARDAR</button>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        Socio: {
          id: "",
          fecha_alta: new Date().toISOString().substring(0, 10),
          nombre_apellido: "",
          direccion: "",
          telefono: 258648525,
          activo: 1,
        }
      }
    },
    methods: {
      async crearSocios() {
        console.log(this.Socio);
        try {
          const res = await axios.post('http://192.168.20.10/apiv1/socios/nuevo', this.Socio);
          console.log(res.data); // Manejar la respuesta según sea necesario
          this.$router.push('/socios'); // Usar $router en lugar de $route
        } catch (error) {
          console.error(error);
          // Manejar errores de la solicitud HTTP
        }
      }
    }
  }
  </script>
  
  <style scoped>
  input {
    width: 50%;
    font-size: 1.2em;
    display: flex;
    align-content: center;
    padding: 10px;
    margin: 15px;
  }
  </style>
  


