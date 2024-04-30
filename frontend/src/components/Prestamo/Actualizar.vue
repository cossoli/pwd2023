<script lang="ts">
import axios from 'axios';

export default {
  data() {
    return {
      prestamo: {
        id:'',
        fecha_desde:'',
        fecha_hasta:'',
      },
         
    };
  },
  created() {
    this.buscar();
  },
  methods: {
    async actualizarPrestamo() {
      try {
        const res = await axios.put(`http://192.168.20.10/apiv1/prestamos/${this.prestamo.id}`, this.prestamo);
        console.log(res.data); // Manejar la respuesta según sea necesario
        this.$router.push('/prestamo');
      } catch (error) {
        console.error('Error al actualizar el préstamo:', error);
      }
    },
    async buscar() {
      try {
        const res = await axios.get(`http://192.168.20.10/apiv1/prestamos/${this.$route.params.id}`);
        this.prestamo = res.data;
        console.log(this.prestamo);
      } catch (error) {
        console.error('Error al buscar el préstamo:', error);
      }
    }
  }
}
</script>

<template>
  <div>
    <h2>Actualizar préstamo</h2>
    
      <input v-model="prestamo.fecha_desde" type="text" label="fecha desde" placeholder="fecha desde">
      <input v-model="prestamo.fecha_hasta" type="text" label="fecha hasta" placeholder="fecha hasta">
    
    <button @click="actualizarPrestamo">Actualizar Préstamo</button>
  </div>
</template>

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

