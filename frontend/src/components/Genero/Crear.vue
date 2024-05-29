<template>
  <div class="container">
    <h2>Crear nuevo género</h2>
    <input v-model="genero.descripcion" type="text" placeholder="Descripción" />
    <button @click="crearGenero">Guardar</button>
    <p v-if="mensaje">{{ mensaje }}</p>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import axios from 'axios';

export default defineComponent({
  data() {
    return {
      genero: {
        descripcion: "",
        activo: 1
      },
      mensaje: ""
    };
  },
  methods: {
    async crearGenero() {
      try {
        // Validar que la descripción no esté vacía
        if (!this.genero.descripcion.trim()) {
          this.mensaje = "Por favor ingresa una descripción válida para el género.";
          return;
        }

        const res = await axios.post('http://192.168.20.10/apiv1/generos/nuevo', this.genero);
        console.log(res.data);

        // Limpiar el formulario y mostrar mensaje de éxito
        this.genero.descripcion = "";
        this.mensaje = "Género creado exitosamente.";
      } catch (error) {
        console.error(error);
        this.mensaje = "Ocurrió un error al crear el género. Por favor intenta nuevamente.";
      }
    }
  }
});
</script>

<style scoped>
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


