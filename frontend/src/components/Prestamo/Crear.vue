<template>
  <div>
    <form @submit.prevent="manejarEnvio">
      <input v-model="busqueda" type="text" placeholder="Buscar libro por nombre" @input="obtenerLibros" />
      <div class="error" v-if="busqueda && !librosFiltrados.length">
        <h1>Libro no encontrado</h1>
      </div>
      <div class="success" v-else>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Título</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(libro, index) in librosFiltrados" :key="index">
              <td>{{ libro.id }}</td>
              <td>{{ libro.titulo }}</td>
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
        <p><strong>Nombre del Libro:</strong> {{ detallesLibroSeleccionado.titulo }}</p>
        
        <input v-model="prestamo.id_socio" type="number" placeholder="ID Socio" />
        <input v-model="prestamo.fecha_desde" type="date" placeholder="Fecha Desde" />
        <input v-model="prestamo.fecha_hasta" type="date" placeholder="Fecha Hasta" />
        
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

interface Prestamo {
  id_socio: number;
  fecha_desde: string;
  fecha_hasta: string;
}

let busqueda = ref('');
let libros: Ref<Array<Libro>> = ref([]);
let librosFiltrados: Ref<Array<Libro>> = ref([]);
let libroSeleccionado: Ref<number | null> = ref(null);

let prestamo: Ref<Prestamo> = ref({
  id_socio: 0,
  fecha_desde: '',
  fecha_hasta: ''
});

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
      await axios.post('http://192.168.20.10/apiv1/prestamos', {
        id_libro: libroSeleccionado.value,
        id_socio: prestamo.value.id_socio,
        fecha_desde: prestamo.value.fecha_desde,
        fecha_hasta: prestamo.value.fecha_hasta
      });
      alert(`Libro con ID ${libroSeleccionado.value} ha sido prestado`);
      libroSeleccionado.value = null;
      busqueda.value = '';
      librosFiltrados.value = [];
      prestamo.value = { id_socio: 0, fecha_desde: '', fecha_hasta: '' };
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


