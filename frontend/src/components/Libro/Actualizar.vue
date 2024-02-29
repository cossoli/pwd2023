<template>
  <div>
    <h2>Actualizar libro</h2>
    <div v-if="Libros.activo == 1">
      <div class="form-group">
        <label for="estado">Estado</label>
        <input v-model="Libros.estado" type="text" id="estado" placeholder="Estado">
      </div>
      <div class="form-group">
        <label for="titulo">Título</label>
        <input v-model="Libros.titulo" type="text" id="titulo" placeholder="Título">
      </div>
      <div class="form-group">
        <label for="anio">Año</label>
        <input v-model="Libros.anio" type="date" id="anio">
      </div>
      <div class="form-group">
        <label for="id_categoria">Categoría</label>
        <input v-model="Libros.id_categoria" type="number" id="id_categoria" placeholder="ID Categoría">
      </div>
      <div class="form-group">
        <label for="id_editorial">Editorial</label>
        <input v-model="Libros.id_editorial" type="number" id="id_editorial" placeholder="ID Editorial">
      </div>
      <div class="form-group">
        <label for="id_genero">Género</label>
        <input v-model="Libros.id_genero" type="number" id="id_genero" placeholder="ID Género">
      </div>
      <div class="form-group">
        <label for="cant_paginas">Cantidad de Páginas</label>
        <input v-model="Libros.cant_paginas" type="number" id="cant_paginas" placeholder="Cantidad de Páginas">
      </div>
      <div class="form-group">
        <label for="autores">Autores</label>
        <input v-model="autores" type="text" id="autores" placeholder="Autores">
      </div>
    </div>
    <button @click="ActualizarLibro" :disabled="cargando" class="guardar-btn">{{ cargando ? 'Cargando...' : 'Actualizar' }}</button>
    <p v-if="mensajeError" class="error-message">{{ mensajeError }}</p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      Libros: {
        estado: "",
        titulo: "",
        anio: "",
        id_categoria: "",
        id_editorial: "",
        id_genero: "",
        cant_paginas: "",
        autores: ""
      },
      cargando: false,
      mensajeError: ""
    };
  },
  created() {
    this.buscarLibro();
  },
  methods: {
    async buscarLibro() {
      try {
        const res = await axios.get(`http://192.168.20.10/apiv1/libros/${this.$route.params.id}`);
        this.Libros = res.data;
      } catch (error) {
        console.error("Error al obtener el libro:", error);
      }
    },
    async ActualizarLibro() {
      this.cargando = true;
      try {
        const res = await axios.put(`http://192.168.20.10/apiv1/libros/${this.$route.params.id}`, this.Libros);
        console.log(res.data);
        this.mensajeError = ""; // Limpiar mensaje de error si existe
        this.$router.push('/libro');
      } catch (error) {
        console.error("Error al actualizar el libro:", error);
        this.mensajeError = "Error al actualizar el libro"; // Mostrar mensaje de error
      } finally {
        this.cargando = false;
      }
    }
  }
};
</script>
<style scope>
input {
    width: 50%;
    font-size: 1.2em;
    display: flex;
    align-content: center;
    padding: 10px;
    margin: 15px;
}
</style>



