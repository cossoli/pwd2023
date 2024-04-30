<script lang="ts">
import axios from 'axios';

export default {
  data() {
    return {
      categorias: {
        id: '',
        descripcion: '',
        activo :'',

      }
    };
  },
  created() {
    this.buscar();
  },
  methods: {
    async ActualizarCategoria() {
      try {
        const res = await axios.put(`http://192.168.20.10/apiv1/categorias/${this.categorias.id}`, this.categoria);
        console.log(res.data);
        this.$router.push('/Categoria');
      } catch (error) {
        console.error(error);
       
      }
    },
    async buscar() {
      try {
        const res = await axios.get(`http://192.168.20.10/apiv1/categorias/${this.$route.params.id}`);
        this.categorias = res.data;
        console.log(this.categorias);
      } catch (error) {
        console.error(error);
       
      }
    }
  }
};
</script>

<template>
  <div>
    <h2>Actualizar Categoría</h2>
    <input v-model="categorias.descripcion" type="text" label="Nombre" placeholder="Nombre">
    <button @click="ActualizarCategoria">Actualizar</button>
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
