<template>
  <div class="container">
    <form @submit.prevent="manejarEnvio" class="formulario">
      <div class="busqueda-libro">
        <input v-model="busqueda" type="text" placeholder="Buscar libro por nombre" @input="debouncedObtenerLibros" />
        <ul v-if="librosFiltrados.length" class="suggestions">
          <li v-for="(libro, index) in librosFiltrados" :key="index" @click="seleccionarLibro(libro)">
            {{ libro.titulo }}
          </li>
        </ul>
      </div>

      <div v-if="detallesLibroSeleccionado" class="detalles-libro">
        <h2>Detalles del Libro Seleccionado</h2>
        <p><strong>ID:</strong> {{ detallesLibroSeleccionado.id }}</p>
        <p><strong>Nombre del Libro:</strong> {{ detallesLibroSeleccionado.titulo }}</p>

        <select v-model="prestamo.socio" required>
          <option disabled value="">Seleccione un socio</option>
          <option v-for="socio in socios" :key="socio.id" :value="socio.id">
            {{ socio.nombre_apellido }}
          </option>
        </select>

        <input v-model="prestamo.fecha_desde" type="date" placeholder="Fecha Desde" required />
        <input v-model="prestamo.fecha_hasta" type="date" placeholder="Fecha Hasta" required />

        <button type="submit" class="btn-prestar">Prestar Libro</button>
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
  libro: number;
  socio: number;
  fecha_desde: string;
  fecha_hasta: string;
  fecha_dev?: string; 
  estado: string;
}

let busqueda = ref('');
let libros = ref<Array<Libro>>([]);
let librosFiltrados = ref<Array<Libro>>([]);
let socios = ref<Array<Socio>>([]);
let libroSeleccionado = ref<number | null>(null);

let prestamo = ref<Prestamo>({
  libro: 0,
  socio: 0,
  fecha_desde: '',
  fecha_hasta: '',
  fecha_dev: '',
  estado:'',
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
  try {
    const respuesta = await axios.get('http://192.168.20.10/apiv1/socios');
    socios.value = respuesta.data;
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

watch(busqueda, debouncedObtenerLibros);
onMounted(obtenerSocios);

const seleccionarLibro = (libro: Libro) => {
  libroSeleccionado.value = libro.id;
  busqueda.value = libro.titulo;
  librosFiltrados.value = [];
  prestamo.value.libro = libro.id;
};

const manejarEnvio = async () => {
  if (libroSeleccionado.value && prestamo.value.socio) {
    try {
      const data = {
        libro: prestamo.value.libro,
        socio: prestamo.value.socio,
        fecha_desde: prestamo.value.fecha_desde,
        fecha_hasta: prestamo.value.fecha_hasta,
        fecha_dev: prestamo.value.fecha_dev,
        estado: prestamo.value.estado
      };
      await axios.post('http://192.168.20.10/apiv1/prestamos/nuevo', data);
      libroSeleccionado.value = null;
      busqueda.value = '';
      prestamo.value = { libro: 0, socio: 0, fecha_desde: '', fecha_hasta: '', fecha_dev: '',
        estado:''  };
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
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #f4f4f9;
  padding: 1em;
}

.formulario {
  background-color: white;
  padding: 1em;
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 350px;
  display: flex;
  flex-direction: column;
  gap: 1em;
}

.formulario .busqueda-libro {
  position: relative;
}

.formulario input,
.formulario select {
  padding: 0.5em;
  border: 1px solid #ccc;
  border-radius: 5px;
  width: 100%;
}

.formulario .btn-prestar {
  background-color: green;
  color: white;
  border: none;
  padding: 0.5em;
  border-radius: 5px;
  cursor: pointer;
  text-transform: uppercase;
}

.formulario .btn-prestar:hover {
  background-color: darkgreen;
}

.suggestions {
  list-style: none;
  margin: 0;
  padding: 0;
  border: 1px solid #ccc;
  max-height: 150px;
  overflow-y: auto;
  background-color: white;
  width: 100%;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  position: absolute;
  z-index: 1;
}

.suggestions li {
  padding: 10px;
  cursor: pointer;
}

.suggestions li:hover {
  background-color: #f0f0f0;
}

.detalles-libro {
  text-align: left;
}

.error {
  width: 100%;
  text-align: center;
  color: red;
  font-weight: bold;
}

@media (max-width: 600px) {
  .formulario {
    width: 100%;
    padding: 1em;
  }

  .formulario input,
  .formulario select {
    padding: 0.4em;
  }

  .formulario .btn-prestar {
    padding: 0.4em;
  }
}
</style>



