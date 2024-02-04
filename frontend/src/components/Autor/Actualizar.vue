<script lang="ts">
import axios from 'axios';

export default {
  data() {
    return {
      autor: {
        nombre_apellido: '',
        activo: 1
      }
    };
  },
  created() {
    this.buscarAutor();
  },
  methods: {
    async actualizarAutor() {
      try {
        const res = await axios.put(`http://192.168.20.10/apiv1/autor/${this.$route.params.id}`, this.autor);
        console.log(res.data);
        // Redirigir a la página de autor o realizar otra acción después de actualizar
        this.$router.push('/autor');
      } catch (error) {
        console.error(error);
        // Manejar errores adecuadamente, por ejemplo, mostrar un mensaje al usuario
      }
    },
    async buscarAutor() {
      try {
        const res = await axios.get(`http://192.168.20.10/apiv1/autor/${this.$route.params.id}`);
        this.autor = res.data;
        console.log(this.autor);
      } catch (error) {
        console.error(error);
        // Manejar errores adecuadamente, por ejemplo, redirigir a una página de error
      }
    }
  }
};
</script>

<template>
  <div>
    <h2>Actualizar Autor</h2>
    <div v-if="autor.activo === 1">
      <input v-model="autor.nombre_apellido" type="text" label="Nombre y Apellido" placeholder="Apellido y Nombre">
    </div>
    <button @click="actualizarAutor">Actualizar</button>
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


