<script lang="ts">
import axios from 'axios';

export default {
  data() {
    return {
      genero: {
        descripcion: '',
        activo: 1 // Puedes inicializar otros campos según sea necesario
      }
    };
  },
  created() {
    this.buscar();
  },
  methods: {
    async ActualizarGenero() {
      try {
        const res = await axios.put(`http://192.168.20.10/apiv1/genero/${this.$route.params.id}`, this.genero);
        console.log(res.data);

        // Redirigir a la página de detalle del género actualizado u otra acción necesaria
      } catch (error) {
        console.error(error);
        // Manejar errores adecuadamente, por ejemplo, mostrar un mensaje al usuario
      }
    },
    async buscar() {
      try {
        const res = await axios.get(`http://192.168.20.10/apiv1/genero/${this.$route.params.id}`);
        this.genero = res.data;
        console.log(this.genero);
      } catch (error) {
        console.error(error);
        // Manejar errores adecuadamente, por ejemplo, redirigir a una página de error
      }
    }
  }
};
</script>

<template>
  <h2>Actualizar género</h2>
  <div v-if="genero.activo === 1">
    <input v-model="genero.descripcion" type="text" label="Descripción" placeholder="Descripción">
  </div>
  <button @click="ActualizarGenero">Actualizar</button>
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





