<template>
  <div>
    <h2>Actualizar libro</h2>
    <div class="form-group">
      <label for="titulo">Título</label>
      <select v-model="libro.id" id="titulo">
        <option v-for="libroItem in libros" :key="libroItem.id" :value="libroItem.id">{{ libroItem.titulo }}</option>
      </select>
    </div>
    <div class="form-group">
      <label for="anio">Año</label>
      <input v-model="libro.anio" type="date" id="anio">
    </div>
    <div class="form-group">
      <label for="id_categoria">Categoría</label>
      <select v-model="libro.id_categoria" id="id_categoria">
        <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">{{ categoria.descripcion }}</option>
      </select>
    </div>
    <div class="form-group">
      <label for="id_editorial">Editorial</label>
      <select v-model="libro.id_editorial" id="id_editorial">
        <option v-for="editorial in editoriales" :key="editorial.id" :value="editorial.id">{{ editorial.nombre }}</option>
      </select>
    </div>
    <div class="form-group">
      <label for="id_genero">Género</label>
      <select v-model="libro.id_genero" id="id_genero">
        <option v-for="genero in generos" :key="genero.id" :value="genero.id">{{ genero.descripcion }}</option>
      </select>
    </div>
    <div class="form-group">
      <label for="cant_paginas">Cantidad de Páginas</label>
      <input v-model="libro.cant_paginas" type="number" id="cant_paginas" placeholder="Cantidad de Páginas">
    </div>
    <div class="form-group">
      <label for="autores">Autores</label>
      <select v-model="libro.autor_id" id="autores">
        <option v-for="autor in autores" :key="autor.id" :value="autor.id">{{ autor.nombre_apellido }}</option>
      </select>
    </div>
  
    <button @click="actualizarLibro" :disabled="cargando" class="guardar-btn">{{ cargando ? 'Cargando...' : 'Actualizar' }}</button>
    <p v-if="mensajeError" class="error-message">{{ mensajeError }}</p>
  </div>
</template>

<script lang="ts">
import axios from 'axios';
import { ref, onMounted } from 'vue';

export default {
  setup() {
    const libro = ref({
      id: '',
      titulo: '',
      anio: '',
      id_categoria: '',
      id_editorial: '',
      id_genero: '',
      cant_paginas: '',
      autor_id: ''
    });

    const libros = ref([]);
    const categorias = ref([]);
    const autores = ref([]);
    const editoriales = ref([]);
    const generos = ref([]);

    const cargando = ref(false);
    const mensajeError = ref("");

    const buscarLibro = async () => {
      try {
        const resLibro = await axios.get(`http://192.168.20.10/apiv1/libros/${libro.value.id}`);
        libro.value = resLibro.data;
      } catch (error) {
        console.error("Error al obtener el libro:", error);
      }
    };

    const obtenerDatos = async () => {
      try {
        const resLibros = await axios.get('http://192.168.20.10/apiv1/libros');
        libros.value = resLibros.data;

        const resCategorias = await axios.get('http://192.168.20.10/apiv1/categorias');
        categorias.value = resCategorias.data;

        const resAutores = await axios.get('http://192.168.20.10/apiv1/autores');
        autores.value = resAutores.data;

        const resEditoriales = await axios.get('http://192.168.20.10/apiv1/editoriales');
        editoriales.value = resEditoriales.data;

        const resGeneros = await axios.get('http://192.168.20.10/apiv1/generos');
        generos.value = resGeneros.data;

      } catch (error) {
        console.error('Error al obtener datos:', error);
      }
    };

    const actualizarLibro = async () => {
      cargando.value = true;
      try {
        const res = await axios.put(`http://192.168.20.10/apiv1/libros/${libro.value.id}`, libro.value);
        console.log(res.data);
        mensajeError.value = ""; // Limpiar mensaje de error si existe
        this.$router.push('/libro');
      } catch (error) {
        console.error("Error al actualizar el libro:", error);
        mensajeError.value = "Error al actualizar el libro"; // Mostrar mensaje de error
      } finally {
        cargando.value = false;
      }
    };

    onMounted(() => {
      buscarLibro();
      obtenerDatos();
    });

    return {
      libro,
      libros,
      categorias,
      autores,
      editoriales,
      generos,
      actualizarLibro,
      cargando,
      mensajeError
    };
  }
};
</script>

<style scoped>
input,
select {
  width: 50%;
  font-size: 1.2em;
  display: block;
  margin: 15px 0;
  padding: 10px;
}
.guardar-btn {
  font-size: 1.2em;
  padding: 10px 20px;
  margin-top: 20px;
}
.error-message {
  color: red;
  font-size: 1.2em;
  margin-top: 10px;
}
</style>


