<template>
  <div class="container">
    <h2>Crear nuevo autor</h2>

    <input v-model="Autor.nombre_apellido" type="text" placeholder="Nombre y Apellido" />
    <button @click="crearAutor">Guardar</button>

    <p v-if="mensaje">{{ mensaje }}</p>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import axios from 'axios';

export default defineComponent({
  data() {
    return {
      Autor: {
        id: '',
        nombre_apellido: '',
      },
      mensaje: ''
    };
  },
  methods: {
    async crearAutor() {
      try {
   
        if (!this.Autor.nombre_apellido.trim()) {
          this.mensaje = 'Por favor ingresa un nombre y apellido válidos para el autor.';
          return;
        }

    
        const res = await axios.post('http://192.168.20.10/apiv1/autores/nuevo', this.Autor);
        console.log(res.data);

        this.$router.push('/autor');
      } catch (error) {
        console.error(error);
   
      }
    }
  }
});
</script>

<style>
.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-color: #f8f8f8;
}

h2 {
  margin-bottom: 20px;
  font-size: 2em;
  color: #333;
  text-align: center;
}

input {
  width: 50%;
  font-size: 1.2em;
  padding: 10px;
  margin: 15px 0;
  border: 1px solid #ccc;
  border-radius: 5px;
  display: block;
}

button {
  font-size: 1.2em;
  padding: 10px 20px;
  cursor: pointer;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 5px;
  margin-top: 10px;
}

button:hover {
  background-color: #218838;
}

p {
  font-size: 1em;
  color: red;
  margin-top: 20px;
}
</style>

  



