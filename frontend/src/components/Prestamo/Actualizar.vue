<script lang="ts">
import axios from 'axios';

export default {
  data() {
    return {
      prestamo: {
        // Inicializa aquí todas las propiedades del objeto prestamo que deseas actualizar
      },
      socio: {
        nombre_apellido: '',
        telefono: '',
        direccion: ''
      }
    };
  },
  created() {
    this.buscar();
  },
  methods: {
    async actualizarPrestamo() {
      try {
        const res = await axios.put(`http://192.168.20.10/apiv1/prestamo/${this.$route.params.id}`, this.prestamo);
        console.log(res.data); // Manejar la respuesta según sea necesario
        this.$router.push('/socios');
      } catch (error) {
        console.error('Error al actualizar el préstamo:', error);
      }
    },
    async buscar() {
      try {
        const res = await axios.get(`http://192.168.20.10/apiv1/prestamo/${this.$route.params.id}`);
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
    <div v-if="socio.activo === 1">
      <input v-model="socio.nombre_apellido" type="text" label="Nombre y Apellido" placeholder="Apellido y Nombre">
      <input v-model="socio.telefono" type="text" label="Teléfono" placeholder="Teléfono">
      <input v-model="socio.direccion" type="text" label="Dirección" placeholder="Dirección">
    </div>
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

