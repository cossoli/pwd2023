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
      <button type="submit" class="btn-confirmar">Confirmar Devolución</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      libros: [],
      libroSeleccionado: null,
    };
  },
  created() {
    this.obtenerLibros();
  },
  methods: {
    async obtenerLibros() {
      try {
        const res = await axios.get('http://192.168.20.10/apiv1/libros');
        this.libros = res.data;
      } catch (error) {
        console.error('Error al obtener los libros:', error);
      }
    },
    async manejarDevolucion() {
      if (!this.libroSeleccionado) {
        alert('Por favor, seleccione un libro para devolver.');
        return;
      }

      const prestamoId = this.$route.params.id;
      try {
        // Actualizar el estado del libro
        await axios.put(`http://192.168.20.10/apiv1/libros/${this.libroSeleccionado.id}`, { estado: 'activo' });

        // Actualizar el estado del préstamo
        await axios.put(`http://192.168.20.10/apiv1/prestamos/${prestamoId}`, {
          estado: 'devuelto',
          fecha_dev: new Date().toISOString().slice(0, 10)
        });

        this.$router.push('/prestamos');
      } catch (error) {
        console.error('Error al devolver el libro:', error);
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
</style>
