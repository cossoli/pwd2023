<template>
  <div class="devolver-libro">
    <h1>Devolver Libro</h1>
    <div v-if="libro">
      <p>Libro a devolver: <strong>{{ libro.titulo }}</strong></p>
      <form @submit.prevent="manejarDevolucion">
        <button type="submit" class="btn-confirmar">Confirmar Devolución</button>
      </form>
    </div>
    <div v-else>
      <p>Cargando información del libro...</p>
    </div>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      libro: null,
      socio: null
    };
  },
  created() {
    this.obtenerDatos();
  },
  methods: {
    async obtenerDatos() {
      const libroId = this.$route.params.libroId; 
      const socioId = this.$route.params.socioId; 
      try {
        await this.buscarLibro(libroId);
        await this.buscarSocio(socioId);
      } catch (error) {
        console.error('Error al obtener la información del libro o del socio:', error);
        alert('Error al obtener la información del libro o del socio. Por favor, inténtelo de nuevo.');
      }
    },
    async buscarLibro(libroId) {
      try {
        const resLibro = await axios.get(`http://192.168.20.10/apiv1/libros/${libroId}`);
        this.libro = resLibro.data;
        console.log('Libro obtenido:', this.libro); 
      } catch (error) {
        console.error('Error al obtener el libro:', error);
        alert('Error al obtener la información del libro. Por favor, inténtelo de nuevo.');
      }
    },
    async buscarSocio(socioId) {
      try {
        const resSocio = await axios.get(`http://192.168.20.10/apiv1/socios/${socioId}`);
        this.socio = resSocio.data;
        console.log('Socio obtenido:', this.socio); 
      } catch (error) {
        console.error('Error al obtener el socio:', error);
        alert('Error al obtener la información del socio. Por favor, inténtelo de nuevo.');
      }
    },
    async manejarDevolucion() {
      if (!this.libro) {
        alert('No se ha seleccionado ningún libro para devolver.');
        return;
      }

      const prestamoId = this.$route.params.prestamoId; 
      console.log('Préstamo ID:', prestamoId); 

      try {
        // Verificar si el libro está prestado
        if (this.libro.estado === 'Activo') {
          alert('El libro seleccionado no está prestado, por lo tanto, no se puede devolver.');
          return;
        }

        // Actualizar el estado del libro a 'Activo'
        const libroUpdateRes = await axios.put(`http://192.168.20.10/apiv1/libros/actualizar/${this.libro.id}`, { 
          id: this.libro.id,
          socio: this.socio.id,
          estado: 'Activo'
        });
        console.log('Respuesta de la actualización del libro:', libroUpdateRes.data); 

        
        this.$router.push('/prestamos');
      } catch (error) {
        console.error('Error al devolver el libro:', error);
        alert('Ocurrió un error al intentar devolver el libro. Por favor, inténtelo de nuevo.');
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


