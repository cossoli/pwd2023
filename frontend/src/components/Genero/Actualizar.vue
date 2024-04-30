<script lang="ts">
import axios from 'axios';

export default {
  data() {
    return {
      genero: {
        id : '',
        descripcion: '',
        activo: 1
      }
    };
  },
  created() {
    this.buscar();
  },
  methods: {
    async ActualizarGenero() {
      try {
        const res = await axios.put(`http://192.168.20.10/apiv1/generos/${this.genero.id}`, this.genero);
       console.log(res.data);
  
      } catch (error) {
        console.error(error);
      }
    },
    async buscar() {
      try {
        const res = await axios.get(`http://192.168.20.10/apiv1/generos/${this.$route.params.id}`);
        this.genero = res.data;
        console.log(this.genero);
      } catch (error) {
        console.error(error);
        
      }
    }
  }
};
</script>

<template>
  <h2>Actualizar género</h2>
    <input v-model="genero.descripcion" type="text" label="Descripción" placeholder="Descripción">
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





