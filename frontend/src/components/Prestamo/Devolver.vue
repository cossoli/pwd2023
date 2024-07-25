<template>
  <div class="devolver-libro">
    <h1>Devolver Libro</h1>
    <form @submit.prevent="manejarDevolucion">
      <div class="form-group">
        <label for="libro">Libro:</label>
        <select id="libro" v-model="libroSeleccionado">
          <option v-for="libro in libros" :key="libro.id" :value="libro">{{ libro.titulo }}</option>
        </select>
      </div>
      <button type="submit" class="btn-confirmar" :disabled="cargando">Confirmar Devolución</button>
    </form>
    <p v-if="cargando">Procesando...</p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      libros: [],
      libroSeleccionado: null,
      cargando: false,
    };
  },
  created() {
    this.obtenerLibros();
  },
  methods: {
    async obtenerLibros() {
      this.cargando = true;
      try {
        const res = await axios.get('http://192.168.20.10/apiv1/libros');
        this.libros = res.data;
        console.log('Libros obtenidos:', this.libros); // Depuración
      } catch (error) {
        console.error('Error al obtener los libros:', error);
        alert('Error al obtener la lista de libros.');
      } finally {
        this.cargando = false;
      }
    },
    async manejarDevolucion() {
      if (!this.libroSeleccionado) {
        alert('Por favor, seleccione un libro para devolver.');
        return;
      }

      this.cargando = true;

      const prestamoId = this.$route.params.id;
      console.log('Préstamo ID:', prestamoId); 
      console.log('Libro Seleccionado:', this.libroSeleccionado); 

      try {
        const libroRes = await axios.get(`http://192.168.20.10/apiv1/libros/${this.libroSeleccionado.id}`);
        const libroActual = libroRes.data;
        console.log('Estado actual del libro:', libroActual.estado); 

        if (libroActual.estado === 'Activo') {
          alert('El libro seleccionado no está prestado, por lo tanto, no se puede devolver.');
          this.cargando = false;
          return;
        }

        const dataToUpdate = { estado: 'Activo' };
        console.log('Datos para actualizar el libro:', dataToUpdate);

        const libroUpdateRes = await axios.put(`http://192.168.20.10/apiv1/libros/${this.libroSeleccionado.id}`, dataToUpdate);
        console.log('Respuesta de la actualización del libro:', libroUpdateRes.data); 

        this.$router.push('/prestamos');
      } catch (error) {
        console.error('Error al devolver el libro:', error);
        if (error.response) {
          console.error('Datos del error:', error.response.data);
          console.error('Estado del error:', error.response.status);
          console.error('Cabeceras del error:', error.response.headers);
          alert(`Error: ${error.response.data.message || 'Ocurrió un error al intentar devolver el libro.'}`);
        } else if (error.request) {
          console.error('Solicitud realizada pero no hubo respuesta:', error.request);
          alert('No se recibió respuesta del servidor. Por favor, inténtelo de nuevo.');
        } else {
          console.error('Error al configurar la solicitud:', error.message);
          alert('Error al configurar la solicitud. Por favor, inténtelo de nuevo.');
        }
      } finally {
        this.cargando = false;
      }
    }
  }
}
</script>

<style scoped>
.devolver-libro {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
  background-color: #f9f9f9;
}

.devolver-libro h1 {
  text-align: center;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.form-group select {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.btn-confirmar {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #66cc99;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

.btn-confirmar:hover {
  background-color: #57b386;
}

.btn-confirmar:disabled {
  background-color: #cccccc;
  cursor: not-allowed;
}
</style>
