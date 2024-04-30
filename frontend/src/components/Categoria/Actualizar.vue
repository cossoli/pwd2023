<script lang="ts">
import axios from 'axios';

export default {
  data() {
    return {
      categoria: {
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
    async ActualizarCategoria(categoria) {
      try {
        const res = await axios.put(`http://192.168.20.10/apiv1/categorias/${this.$route.params.id}`, categoria);
        console.log(res.data);
        this.$router.push('/Categoria');
      } catch (error) {
        console.error(error);
        // Manejar errores adecuadamente, por ejemplo, mostrar un mensaje al usuario
      }
    },
    async buscar() {
      try {
        const res = await axios.get(`http://192.168.20.10/apiv1/categorias/${this.$route.params.id}`);
        this.categoria = res.data;
        console.log(this.categoria);
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
    <h2>Actualizar Categoría</h2>
    <input v-model="categoria.descripcion" type="text" label="Nombre" placeholder="Nombre">
    <button @click="ActualizarCategoria(categoria)">Actualizar</button>
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
