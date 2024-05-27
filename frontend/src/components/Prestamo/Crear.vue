<template>
  <div>
    <form @submit.prevent="manejarEnvio">
      <input v-model="busqueda" type="text" placeholder="Buscar libro por nombre" @input="debouncedObtenerLibros" />
      <ul v-if="busqueda && librosFiltrados.length" class="suggestions">
        <li v-for="(libro, index) in librosFiltrados" :key="index" @click="seleccionarLibro(libro)">
          {{ libro.titulo }}
        </li>
      </ul>
      <div class="error" v-if="busqueda && !librosFiltrados.length">
        <h1>Libro no encontrado</h1>
      </div>
      
      <div v-if="detallesLibroSeleccionado">
        <h2>Detalles del Libro Seleccionado</h2>
        <p><strong>ID:</strong> {{ detallesLibroSeleccionado.id }}</p>
        <p><strong>Nombre del Libro:</strong> {{ detallesLibroSeleccionado.titulo }}</p>
        
        <input v-model="busquedaSocio" type="text" placeholder="Buscar socio por nombre" @input="debouncedObtenerSocios" />
        <ul v-if="busquedaSocio && sociosFiltrados.length" class="suggestions">
          <li v-for="(socio, index) in sociosFiltrados" :key="index" @click="seleccionarSocio(socio)">
            {{ socio.nombre }}
          </li>
        </ul>
        
        <input v-model="prestamo.id_socio" type="number" placeholder="ID Socio" required min="1" readonly />
        <input v-model="prestamo.fecha_desde" type="date" placeholder="Fecha Desde" required />
        <input v-model="prestamo.fecha_hasta" type="date" placeholder="Fecha Hasta" required />
        
        <button type="submit" class="btn-prestar">Prestar Libro</button>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref, watch, computed } from 'vue';
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

}

interface Prestamo {
  id_socio: number;
  fecha_desde: string;
  fecha_hasta: string;
}

let busqueda = ref('');
let busquedaSocio = ref('');
let libros = ref<Array<Libro>>([]);
let librosFiltrados = ref<Array<Libro>>([]);
let socios = ref<Array<Socio>>([]);
let sociosFiltrados = ref<Array<Socio>>([]);
let libroSeleccionado = ref<number | null>(null);

let prestamo = ref<Prestamo>({
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

const obtenerSocios = async () => {
  if (busquedaSocio.value.trim() === '') {
    sociosFiltrados.value = [];
    return;
  }

  try {
    const respuesta = await axios.get(`http://192.168.20.10/apiv1/socios?busqueda=${busquedaSocio.value}`);
    socios.value = respuesta.data;
    sociosFiltrados.value = socios.value;
  } catch (error) {
    console.error('Error al obtener socios:', error);
  }
};

// Implementación manual de debounce
let debounceTimerLibros: ReturnType<typeof setTimeout>;
const debouncedObtenerLibros = () => {
  clearTimeout(debounceTimerLibros);
  debounceTimerLibros = setTimeout(obtenerLibros, 300);
};

let debounceTimerSocios: ReturnType<typeof setTimeout>;
const debouncedObtenerSocios = () => {
  clearTimeout(debounceTimerSocios);
  debounceTimerSocios = setTimeout(obtenerSocios, 300);
};

watch(busqueda, debouncedObtenerLibros);
watch(busquedaSocio, debouncedObtenerSocios);

const seleccionarLibro = (libro: Libro) => {
  libroSeleccionado.value = libro.id;
  busqueda.value = libro.titulo;
  librosFiltrados.value = [];
};

const seleccionarSocio = (socio: Socio) => {
  prestamo.value.id_socio = socio.id;
  sociosFiltrados.value = [];
};

const manejarEnvio = async () => {
  if (libroSeleccionado.value && prestamo.value.id_socio) {
    try {
      await axios.post('http://192.168.20.10/apiv1/prestamos', {
        id_libro: libroSeleccionado.value,
        id_socio: prestamo.value.id_socio,
        fecha_desde: prestamo.value.fecha_desde,
        fecha_hasta: prestamo.value.fecha_hasta
      });
      libroSeleccionado.value = null;
      busqueda.value = '';
      busquedaSocio.value = '';
      prestamo.value = { id_socio: 0, fecha_desde: '', fecha_hasta: '' };
    } catch (error) {
      console.error('Error al prestar el libro:', error);
    }
  } else {
    alert('Por favor, selecciona un libro y un socio.');
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
  padding: 1.5em;
  margin: 0 auto;
  text-align: center;
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
.suggestions {
  list-style: none;
  margin: 0;
  padding: 0;
  border: 1px solid #ccc;
  max-height: 150px;
  overflow-y: auto;
}
.suggestions li {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
}
.suggestions li:hover {
  background-color: #f0f0f0;
}
.btn-prestar {
  background-color: green;
  color: white;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
}
.btn-prestar:hover {
  background-color: darkgreen;
}
@media (max-width: 600px) {
  table {
    width: 100%;
    font-size: 0.9em;
  }
  input {
    width: 100%;
    margin-bottom: 1em;
  }
}
</style>



