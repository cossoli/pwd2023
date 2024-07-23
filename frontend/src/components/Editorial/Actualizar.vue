
<script lang="ts">
import axios from 'axios';

export default {
  data() {
    return {
      editorial: {
        id: '',
        nombre: ''
      }
    };
  },
  created() {
    this.buscar();
  },
  methods: {
    async ActualizarEditorial() {
      try {
        const res = await axios.put(`http://192.168.20.10/apiv1/editoriales/${this.editorial.id}`, this.editorial);
        console.log(res.data);
        this.$router.push('/editorial');
      } catch (error) {
        console.error(error);
        
      }
    },
    async buscar() {
      try {
        const res = await axios.get(`http://192.168.20.10/apiv1/editoriales/${this.$route.params.id}`);
        this.editorial = res.data;
        console.log(this.editorial);
      } catch (error) {
        console.error(error);
       
      }
    }
  }
};
</script>

<template>
  <div>
    <h2>Actualizar Editorial</h2>
      <input v-model="editorial.nombre" type="text" label="Nombre" placeholder="Nombre">
    <button @click="ActualizarEditorial">Actualizar</button>
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
