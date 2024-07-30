<template>
  <div>
    <h2>Buscar Préstamos por Fecha de Devolución</h2>
    <div>
      <label for="fechaDevolucion">Fecha de Devolución:</label>
      <input v-model="fecha_dev" type="date" id="fechaDevolucion" required>
      <button @click="buscarPrestamosPorFecha">Buscar</button>
    </div>
    <div v-if="prestamos.length">
      <h3>Resultados de la Búsqueda</h3>
      <ul>
        <li v-for="prestamo in prestamos" :key="prestamo.id" @click="seleccionarPrestamo(prestamo.id)">
          ID: {{ prestamo.id }}, Estado: {{ prestamo.estado }}, Fecha de Devolución: {{ prestamo.fecha_dev }}
        </li>
      </ul>
    </div>
    <div v-if="selectedPrestamo">
      <h3>Actualizar Estado del Préstamo</h3>
      <p><strong>ID del Préstamo:</strong> {{ selectedPrestamo.id }}</p>
      <form @submit.prevent="actualizarEstadoPrestamo">
        <div>
          <label for="estado">Nuevo Estado:</label>
          <input v-model="nuevoEstado" type="text" id="estado" placeholder="Nuevo Estado" required>
        </div>
        <div>
          <label for="nuevaFechaDevolucion">Nueva Fecha de Devolución:</label>
          <input v-model="nuevaFechaDevolucion" type="date" id="nuevaFechaDevolucion" required>
        </div>
        <button type="submit">Actualizar Estado y Fecha</button>
      </form>
    </div>
  </div>
</template>

<script lang="ts">
import axios from 'axios';
import { defineComponent } from 'vue';

export default defineComponent({
  data() {
    return {
      prestamos: [] as Array<{ id: string, estado: string, fecha_dev: null }>,
      selectedPrestamo: null as { id: string, estado: string, fecha_dev: null } | null,
      fecha_dev: null,
      nuevoEstado: '',
      nuevaFechaDevolucion: null
    };
  },
  methods: {
    async buscarPrestamosPorFecha() {
      try {
        const res = await axios.get(`http://192.168.20.10/apiv1/prestamos/${this.fecha_dev}`);
        this.prestamos = res.data;
        console.log('Préstamos:', this.prestamos);
      } catch (error) {
        console.error(error);
        alert('Error al obtener préstamos por fecha de devolución');
      }
    },
    seleccionarPrestamo(prestamoId: string) {
      this.selectedPrestamo = this.prestamos.find(prestamo => prestamo.id === prestamoId) || null;
      if (this.selectedPrestamo) {
        this.nuevoEstado = this.selectedPrestamo.estado;
        this.nuevaFechaDevolucion = this.selectedPrestamo.fecha_dev;
      }
    },
    async actualizarEstadoPrestamo() {
      if (!this.selectedPrestamo) {
        alert('Seleccione un préstamo para actualizar');
        return;
      }
      try {
        const res = await axios.put(`http://192.168.20.10/apiv1/prestamos/${this.selectedPrestamo.id}/estado`, {
          estado: this.nuevoEstado,
          fecha_Dev: this.nuevaFechaDevolucion
        });
        console.log(res.data);
        alert('Estado del préstamo actualizado correctamente');
        this.$router.push('/prestamos');
      } catch (error) {
        console.error(error);
        alert('Error al actualizar el estado del préstamo');
      }
    }
  }
});
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