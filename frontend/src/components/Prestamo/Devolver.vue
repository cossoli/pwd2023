<template>
    <div class="contenedor">
      <form @submit.prevent="manejarEnvio" class="formulario">
        <div class="busqueda-libro">
          <input v-model="busqueda" type="text" placeholder="Buscar libro por nombre" @input="debouncedObtenerLibros" />
          <ul v-if="librosFiltrados.length" class="sugerencias">
            <li v-for="(libro, index) in librosFiltrados" :key="index" @click="seleccionarLibro(libro)">
              {{ libro.titulo }}
            </li>
          </ul>
          <p v-if="librosFiltrados.length === 0 && busqueda.length > 0">No hay libros disponibles para prestar.</p>
        </div>
  
        <div v-if="detallesLibroSeleccionado" class="detalles-libro">
          <h2>Detalles del Libro Seleccionado</h2>
          <p><strong>ID:</strong> {{ detallesLibroSeleccionado.id }}</p>
          <p><strong>Nombre del Libro:</strong> {{ detallesLibroSeleccionado.titulo }}</p>
  
          <select v-model="prestamo.socio" required>
            <option disabled value="">Seleccione un socio</option>
            <option v-for="socio in socios" :key="socio.id" :value="socio">
              {{ socio.nombre_apellido }}
            </option>
          </select>
  
          <input v-model="prestamo.fecha_desde" type="date" placeholder="Fecha Desde" required />
          <input v-model="prestamo.fecha_hasta" type="date" placeholder="Fecha Hasta" required />
  
          <button type="submit" class="btn-prestar">Prestar Libro</button>
        </div>
      </form>
  
      <form @submit.prevent="manejarDevolucion" class="formulario" v-if="mostrarDevolucion">
        <div class="busqueda-libro">
          <input v-model="busquedaDevolucion" type="text" placeholder="Buscar libro por nombre" @input="debouncedObtenerLibrosPrestados" />
          <ul v-if="librosPrestadosFiltrados.length" class="sugerencias">
            <li v-for="(libro, index) in librosPrestadosFiltrados" :key="index" @click="seleccionarLibroDevolucion(libro)">
              {{ libro.titulo }} - {{ libro.autor }}
            </li>
          </ul>
          <p v-if="librosPrestadosFiltrados.length === 0 && busquedaDevolucion.length > 0">No hay libros prestados con ese nombre.</p>
        </div>
  
        <div v-if="detallesLibroSeleccionadoDevolucion" class="detalles-libro">
          <h2>Detalles del Libro Seleccionado para Devolución</h2>
          <p><strong>ID:</strong> {{ detallesLibroSeleccionadoDevolucion.id }}</p>
          <p><strong>Nombre del Libro:</strong> {{ detallesLibroSeleccionadoDevolucion.titulo }}</p>
          <p><strong>Autor:</strong> {{ detallesLibroSeleccionadoDevolucion.autor }}</p>
  
          <p><strong>Fecha de Préstamo:</strong> {{ detallesLibroSeleccionadoDevolucion.fecha_desde }}</p>
          <p><strong>Fecha de Devolución:</strong> {{ detallesLibroSeleccionadoDevolucion.fecha_hasta }}</p>
  
          <button type="submit" class="btn-devolver">Devolver Libro</button>
        </div>
      </form>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, watch, computed, onMounted } from 'vue';
  import axios from 'axios';
  
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
  
  interface Socio {
    id: number;
    nombre_apellido: string;
  }
  
  interface Prestamo {
    libro: Libro | null;
    socio: Socio | null;
    fecha_desde: string;
    fecha_hasta: string;
    fecha_dev: string;
  }
  
  let busqueda = ref('');
  let libros = ref<Array<Libro>>([]);
  let librosFiltrados = ref<Array<Libro>>([]);
  let socios = ref<Array<Socio>>([]);
  let libroSeleccionado = ref<Libro | null>(null);
  
  let busquedaDevolucion = ref('');
  let librosPrestados = ref<Array<Libro>>([]);
  let librosPrestadosFiltrados = ref<Array<Libro>>([]);
  let libroSeleccionadoDevolucion = ref<Libro | null>(null);
  
  let prestamo = ref<Prestamo>({
    libro: null,
    socio: null,
    fecha_desde: '',
    fecha_hasta: '',
    fecha_dev: '',
  });
  
  let mostrarDevolucion = ref(false);
  
  const obtenerLibros = async () => {
    if (busqueda.value.trim() === '') {
      librosFiltrados.value = [];
      return;
    }
  
    try {
      const respuesta = await axios.get(`http://192.168.20.10/apiv1/libros?busqueda=${busqueda.value}`);
      libros.value = respuesta.data;
      librosFiltrados.value = libros.value.filter(libro => libro.estado !== 'prestado');
    } catch (error) {
      console.error('Error al obtener libros:', error);
    }
  };
  
  const obtenerLibrosPrestados = async () => {
    if (busquedaDevolucion.value.trim() === '') {
      librosPrestadosFiltrados.value = [];
      return;
    }
  
    try {
      const respuesta = await axios.get(`http://192.168.20.10/apiv1/libros?busqueda=${busquedaDevolucion.value}&estado=prestado`);
      librosPrestados.value = respuesta.data;
      librosPrestadosFiltrados.value = librosPrestados.value;
    } catch (error) {
      console.error('Error al obtener libros prestados:', error);
    }
  };
  
  const obtenerSocios = async () => {
    try {
      const respuesta = await axios.get('http://192.168.20.10/apiv1/socios');
      socios.value = respuesta.data;
    } catch (error) {
      console.error('Error al obtener socios:', error);
    }
  };
  
  let debounceTimerLibros: ReturnType<typeof setTimeout>;
  const debouncedObtenerLibros = () => {
    clearTimeout(debounceTimerLibros);
    debounceTimerLibros = setTimeout(obtenerLibros, 300);
  };
  
  let debounceTimerLibrosPrestados: ReturnType<typeof setTimeout>;
  const debouncedObtenerLibrosPrestados = () => {
    clearTimeout(debounceTimerLibrosPrestados);
    debounceTimerLibrosPrestados = setTimeout(obtenerLibrosPrestados, 300);
  };
  
  watch(busqueda, debouncedObtenerLibros);
  watch(busquedaDevolucion, debouncedObtenerLibrosPrestados);
  onMounted(obtenerSocios);
  
  const seleccionarLibro = (libro: Libro) => {
    libroSeleccionado.value = libro;
    busqueda.value = libro.titulo;
    librosFiltrados.value = [];
    prestamo.value.libro = libro;
  };
  
  const seleccionarLibroDevolucion = (libro: Libro) => {
    libroSeleccionadoDevolucion.value = libro;
    busquedaDevolucion.value = libro.titulo;
    librosPrestadosFiltrados.value = [];
  };
  
  const manejarEnvio = async () => {
    if (libroSeleccionado.value && prestamo.value.socio) {
      try {
        const data = {
          libro: prestamo.value.libro.id,
          socio: prestamo.value.socio.id,
          fecha_desde: prestamo.value.fecha_desde,
          fecha_hasta: prestamo.value.fecha_hasta,
          fecha_dev: prestamo.value.fecha_dev,
        };
        await axios.post('http://192.168.20.10/apiv1/prestamos/nuevo', data);
        libroSeleccionado.value = null;
        busqueda.value = '';
        prestamo.value = { libro: null, socio: null, fecha_desde: '', fecha_hasta: '', fecha_dev: '' };
      } catch (error) {
        console.error('Error al prestar el libro:', error);
      }
    } else {
      alert('Por favor, selecciona un libro y un socio.');
    }
  };
  
  const manejarDevolucion = async () => {
    if (libroSeleccionadoDevolucion.value) {
      try {
        const data = {
          libro: libroSeleccionadoDevolucion.value.id,
          estado: 'activo'
        };
        await axios.put(`http://192.168.20.10/apiv1/libros/${data.libro}`, data);
        libroSeleccionadoDevolucion.value = null;
        busquedaDevolucion.value = '';
        librosPrestadosFiltrados.value = [];
        mostrarDevolucion.value = false;
        // Aquí puedes redirigir o actualizar la vista de préstamos
      } catch (error) {
        console.error('Error al devolver el libro:', error);
      }
    } else {
      alert('Por favor, selecciona un libro para devolver.');
  