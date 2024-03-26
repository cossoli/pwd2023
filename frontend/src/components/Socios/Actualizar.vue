<script lang="ts">
import axios from 'axios';

export default {
  data() {
    return {
      Socio: {
        id: '',
        nombre_apellido: '',
        telefono: '',
        direccion: '',
        activo: 1 // Puedes inicializar otros campos según sea necesario
      }
    };
  },
  created() {
    this.buscar();
  },
  methods: {
    async ActualizarSocio() {
      try {
        const res = await axios.put(`http://192.168.20.10/apiv1/socios/${this.Socio.id}`, this.Socio);
        console.log(res.data);
        // Redirigir a la página de detalle del socio actualizado o mostrar un mensaje de éxito
        alert('Socio actualizado correctamente');
        this.$router.push('/socios');
      } catch (error) {
        console.error(error);
        // Manejar errores adecuadamente, por ejemplo, mostrar un mensaje de error al usuario
        alert('Error al actualizar el socio');
      }
    },
    async buscar() {
      try {
        const res = await axios.get(`http://192.168.20.10/apiv1/socios/${this.$route.params.id}`);
        this.Socio = res.data;
        console.log(this.Socio);
      } catch (error) {
        console.error(error);
        // Manejar errores adecuadamente, por ejemplo, redirigir a una página de error
        alert('Error al obtener los datos del socio');
      }
    }
  }
};
</script>

<template>
  <h2>Actualizar socio</h2>
  <div v-if="Socio.activo === 1">
    <input v-model="Socio.nombre_apellido" type="text" label="Nombre y apellido" placeholder="Apellido y nombre">
    <input v-model="Socio.telefono" type="number" label="Teléfono" placeholder="Teléfono">
    <input v-model="Socio.direccion" type="string" label="Dirección" placeholder="Dirección">
  </div>
  <button @click="ActualizarSocio">Actualizar</button>
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




