<template>
  <div>
    <h2>Actualizar Autor</h2>
      
      <input v-model="autores.nombre_apellido" type="text" label="Nombre y Apellido" placeholder="Apellido y Nombre">
    </div>
    <button @click="actualizarAutor">Actualizar</button>
  
</template>

<script lang="ts">
import axios from 'axios';

export default {
  data() {
    return {
      autores: {
        id:'',
        nombre_apellido: '',
      
      }
    };
  },
  created() {
    this.buscarAutor();
  },
  methods: {
    async actualizarAutor() {
      try {
        const res = await axios.put(`http://192.168.20.10/apiv1/autores/${this.autores.id}`, this.autores);
        console.log(res.data);
        alert(' Autor actualizado correctamente');
        this.$router.push('/Autor');
      } catch (error) {
        console.error(error);
        
      }
    },
    async buscarAutor() {
      try {
        const res = await axios.get(`http://192.168.20.10/apiv1/autores/${this.$route.params.id}`);
        this.autores = res.data;
        console.log(this.autores);
      } catch (error) {
        console.error(error);
      
      }
    }
  }
};
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

