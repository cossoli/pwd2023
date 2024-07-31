<template>
  <div class="devolver-libro">
    <h1>Devolver Libro</h1>
    <form @submit.prevent="manejarDevolucion">
      <div class="form-group">
        <label for="fecha-dev">Fecha de Devolución:</label>
        <input type="date" id="fecha-dev" v-model="fecha_dev" required>
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
      fecha_dev: null
    };
  },
  methods: {
    async manejarDevolucion() {
      const prestamoId = this.$route.params.id; // Obtener el ID del préstamo desde la ruta

      console.log('Prestamo ID:', prestamoId); // Para depuración

      if (!prestamoId) {
        alert('No se ha proporcionado un ID de préstamo.');
        return;
      }

      if (!this.fecha_dev) {
        alert('Por favor, ingrese la fecha de devolución.');
        return;
      }

      try {
        // Actualizar la fecha de devolución del préstamo
        const prestamoUpdateRes = await axios.put(`http://192.168.20.10/apiv1/prestamos/actualizar/${prestamoId}`, { 
          fecha_dev: this.fecha_dev
        });
        console.log('Respuesta de la actualización del préstamo:', prestamoUpdateRes.data); 

        this.$router.push('/prestamos');
      } catch (error) {
        console.error('Error al actualizar la fecha de devolución del préstamo:', error);
        alert('Ocurrió un error al intentar actualizar la fecha de devolución del préstamo. Por favor, inténtelo de nuevo.');
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