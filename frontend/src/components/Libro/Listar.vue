<template>
  <div>
    <h1>Listado de libros</h1>

    <router-link class="crear" to="/libro/crear">
      <img src="../..assets/editar.svg" alt="" />Crear libros
    </router-link>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Año</th>
          <th>Estado</th>
          <th>Categoría</th>
          <th>Editorial</th>
          <th>Género</th>
          <th>Autor</th>
          <th>Cant. Páginas</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="libro in items" :key="libro.id">
          <td>{{ libro.id }}</td>
          <td>{{ libro.titulo }}</td>
          <td>{{ libro.anio }}</td>
          <td>{{ libro.estado }}</td>
          <td>{{ libro.categoria.descripcion }}</td>
          <td>{{ libro.editorial.nombre }}</td>
          <td>{{ libro.genero.descripcion }}</td>
          <td>
            <span v-for="(autor, index) in libro.autores" :key="index">
              {{ autor.nombre_apellido }}
              <span v-if="index !== libro.autores.length - 1">, </span>
            </span>
          </td>
          <td>{{ libro.cant_paginas }}</td>
          <td>
            <button @click="editarLibro(libro.id)" class="btn-editar">Editar</button>
            <button @click="eliminarLibroConfirmacion(libro)" class="btn-eliminar">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';
import Boton from '../Boton.vue';

export default {
  components: { Boton },
  data() {
    return {
      items: [],
    };
  },
  created() {
    this.listarLibros();
  },
  methods: {
    async listarLibros() {
      try {
        const res = await axios.get('http://192.168.20.10/apiv1/libros');
        this.items = res.data;

        
      } catch (error) {
        console.error(error);
      }
    },
    editarLibro(libro) {
      this.$router.push(`/libro/Actualizar`);
    },
    async eliminarLibroConfirmacion(libro) {
      if (confirm(`¿Estás seguro de que quieres eliminar el libro "${libro.titulo}"?`)) {
        await this.eliminarLibro(libro.id);
      }
    },
    async eliminarLibro(id) {
      try {
        await axios.delete(`http://192.168.20.10/apiv1/libros/${id}`);
        this.listarLibros();
      } catch (error) {
        console.error('Error al eliminar el libro:', error);
      }
    },
  }
};
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}

.btn-editar {
  background-color: #3498db; /* Azul */
  color: #fff;
  margin-right: 5px;
}

.btn-eliminar {
  background-color: #e74c3c; /* Rojo */
  color: #fff;
}
</style>
