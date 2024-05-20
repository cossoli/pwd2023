<template>
    <div>
      <form @submit.prevent="manejarEnvio">
        <input v-model="busqueda" type="text" placeholder="Buscar libro" @input="obtenerLibros" />
        <div class="error" v-if="busqueda && !librosFiltrados.length">
          <h1>Libro no encontrado</h1>
        </div>
        <div class="success" v-else>
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
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(libro, index) in librosFiltrados" :key="index">
                <td>{{ libro.id }}</td>
                <td>{{ libro.titulo }}</td>
                <td>{{ libro.anio }}</td>
                <td>{{ libro.estado }}</td>
                <td>{{ libro.categoria }}</td>
                <td>{{ libro.editorial }}</td>
                <td>{{ libro.genero }}</td>
                <td>{{ libro.autor }}</td>
                <td>{{ libro.paginas }}</td>
                <td>
                  <button type="button" @click="seleccionarLibro(libro)">Seleccionar</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
  
        <div v-if="detallesLibroSeleccionado">
          <h2>Detalles del Libro Seleccionado</h2>
          <p><strong>ID:</strong> {{ detallesLibroSeleccionado.id }}</p>
          <p><strong>Título:</strong> {{ detallesLibroSeleccionado.titulo }}</p>
          <p><strong>Año:</strong> {{ detallesLibroSeleccionado.anio }}</p>
          <p><strong>Estado:</strong> {{ detallesLibroSeleccionado.estado }}</p>
          <p><strong>Categoría:</strong> {{ detallesLibroSeleccionado.categoria }}</p>
          <p><strong>Editorial:</strong> {{ detallesLibroSeleccionado.editorial }}</p>
          <p><strong>Género:</strong> {{ detallesLibroSeleccionado.genero }}</p>
          <p><strong>Cant. Páginas:</strong> {{ detallesLibroSeleccionado.paginas }}</p>
          <button type="submit">Prestar Libro</button>
        </div>
      </form>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, watch, computed } from 'vue';
  import axios from 'axios';
  import type { Ref } from 'vue';
  
  interface Libro {
    id: number;
    titulo: string;
    anio: number;
    estado: string;
    categoria: string;
    editorial: string;
    genero: string;
    autor: string;
    paginas: number;
  }
  
  let busqueda = ref('');
  let libros: Ref<Array<Libro>> = ref([]);
  let librosFiltrados: Ref<Array<Libro>> = ref([]);
  let libroSeleccionado: Ref<number | null> = ref(null);
  
  const obtenerLibros = async () => {
    if (busqueda.value.trim() === '') {
      librosFiltrados.value = [];
      return;
    }
  
    try {
      const respuesta = await axios.get(`http://192.168.20.10/apiv1/libros?busqueda=${busqueda.value}`);
      libros.value = respuesta.data;
      librosFiltrados.value = libros.value;
    } catch (error) {
      console.error('Error al obtener libros:', error);
    }
  };
  
  watch(busqueda, obtenerLibros);
  
  const seleccionarLibro = (libro: Libro) => {
    libroSeleccionado.value = libro.id;
  };
  
  const manejarEnvio = async () => {
    if (libroSeleccionado.value) {
      try {
        await axios.post('http://192.168.20.10/apiv1/libros', {
          libroId: libroSeleccionado.value
        });
        alert(`Libro con ID ${libroSeleccionado.value} ha sido prestado`);
        libroSeleccionado.value = null;
        busqueda.value = '';
        librosFiltrados.value = [];
      } catch (error) {
        console.error('Error al prestar el libro:', error);
        alert('Error al prestar el libro.');
      }
    } else {
      alert('Por favor, selecciona un libro');
    }
  };
  
  const detallesLibroSeleccionado = computed(() => {
    return libros.value.find(libro => libro.id === libroSeleccionado.value) || null;
  });
  </script>
  
  <style scoped>
  .success,
  .error {
    width: 90%;
    height: 50%;
    padding: 1.5em;
    margin: 0 auto;
  }
  thead {
    text-transform: uppercase;
    text-align: center;
    background-color: beige;
    color: grey;
  }
  tbody > tr > td {
    padding: 1em 2em;
  }
  tbody > tr > td:nth-child(3) {
    text-align: center;
  }
  </style>
  