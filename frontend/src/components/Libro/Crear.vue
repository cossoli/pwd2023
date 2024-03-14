<template>
  <div class="form-container">
    <h2>Crear nuevo libro</h2>

    <div class="form-group">
      <label for="titulo">Título</label>
      <input v-model="libro.titulo" type="text" id="titulo" placeholder="Título del libro">
    </div>

    <div class="form-group">
      <label for="estado">Estado</label>
      <input v-model="libro.estado" type="text" id="estado" placeholder="Estado del libro">
    </div>

    <div class="form-group">
      <label for="anio">Año</label>
      <input v-model="libro.anio" type="date" id="anio">
    </div>

    <div class="form-group">
      <label for="id_categoria">Categoría</label>
      <select v-model="libro.categoria" id="id_categoria">
        <option value="">Seleccionar Categoría</option>
        <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">{{ categoria.descripcion }}</option>
      </select>
    </div>

    <div class="form-group">
      <label for="id_editorial">Editorial</label>
      <select v-model="libro.editorial" id="id_editorial">
        <option value="">Seleccionar Editorial</option>
        <option v-for="editorial in editoriales" :key="editorial.id" :value="editorial.id">{{ editorial.nombre }}</option>
      </select>
    </div>

    <div class="form-group">
      <label for="id_genero">Género</label>
      <select v-model="libro.genero" id="id_genero">
        <option value="">Seleccionar Género</option>
        <option v-for="genero in generos" :key="genero.id" :value="genero.id">{{ genero.descripcion }}</option>
      </select>
    </div>

    <div class="form-group">
      <label for="cant_paginas">Cantidad de Páginas</label>
      <input v-model="libro.cant_paginas" type="number" id="cant_paginas">
    </div>

    <div class="form-group">
      <label for="autor">Autor</label>
      <select v-model="libro.autor" id="autor">
        <option value="">Seleccionar Autor</option>
        <option v-for="nombreAutor in nombresAutores" :key="nombreAutor">{{ nombreAutor }}</option>
      </select>
    </div>

    <button @click="crearLibro" :disabled="cargando" class="guardar-btn">{{ cargando ? 'Cargando...' : 'Guardar' }}</button>
    <p v-if="mensajeError" class="error-message">{{ mensajeError }}</p>
  </div>
</template>

<script lang="ts">
import axios from 'axios';

export default {
  data() {
    return {
      libro: {
        titulo: "",
        estado: "",
        anio: "",
        categoria: "",
        editorial: "",
        genero: "",
        cant_paginas: "",
        autor: ""
      },
      categorias: [],
      editoriales: [],
      generos: [],
      nombresAutores: [],
      cargando: false,
      mensajeError: ""
    }
  },
  created() {
    this.obtenerCategorias();
    this.obtenerEditoriales();
    this.obtenerGeneros();
    this.obtenerNombresAutores();
  },
  methods: {
    async obtenerCategorias() {
      try {
        const res = await axios.get('http://192.168.20.10/apiv1/categorias');
        this.categorias = res.data;
      } catch (error) {
        console.error(error);
      }
    },
    async obtenerEditoriales() {
      try {
        const res = await axios.get('http://192.168.20.10/apiv1/editoriales');
        this.editoriales = res.data;
      } catch (error) {
        console.error(error);
      }
    },
    async obtenerGeneros() {
      try {
        const res = await axios.get('http://192.168.20.10/apiv1/generos');
        this.generos = res.data;
      } catch (error) {
        console.error(error);
      }
    },
    async obtenerNombresAutores() {
      try {
        const res = await axios.get('http://192.168.20.10/apiv1/autores');
        this.nombresAutores = res.data.map(autor => autor.nombre_apellido);
      } catch (error) {
        console.error(error);
      }
    },
    async crearLibro() {
      this.cargando = true;
      try {
        const res = await axios.post('http://192.168.20.10/apiv1/libros/nuevo', this.libro);
        console.log(res.data); // Manejar la respuesta según sea necesario
        this.mensajeError = ""; // Limpiar mensaje de error si existe
        // Reiniciar formulario
        this.libro = {
          titulo: "",
          estado: "",
          anio: "",
          id_categoria: "",
          id_editorial: "",
          id_genero: "",
          cant_paginas: "",
          autor: ""
        };
      } catch (error) {
        console.error(error);
        this.mensajeError = "Error al crear el libro"; // Mostrar mensaje de error
      } finally {
        this.cargando = false;
      }
    }
  }
}
</script>

<style scoped>
.form-container {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  font-weight: bold;
}

input[type="text"],
select,
input[type="number"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  box-sizing: border-box;
}

button {
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
}

.error-message {
  color: #ff0000;
  font-size: 14px;
}
</style>



