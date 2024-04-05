<template>
  <div>
    <h2>Crear nuevo préstamo</h2>

    <form @submit.prevent="crearPrestamo">
      <div class="form-group">
        <label for="socio">ID Socio</label>
        <input v-model="prestamo.socio" type="number" id="socio" placeholder="ID Socio" required>
      </div>

      <div class="form-group">
        <label for="libro">ID Libro</label>
        <input v-model="prestamo.libro" type="number" id="libro" placeholder="ID Libro" required>
      </div>

      <div class="form-group">
        <label for="fecha_desde">Fecha desde</label>
        <input v-model="prestamo.fecha_desde" type="date" id="fecha_desde" required>
      </div>

      <div class="form-group">
        <label for="fecha_hasta">Fecha hasta</label>
        <input v-model="prestamo.fecha_hasta" type="date" id="fecha_hasta" required>
      </div>

      <button :disabled="cargando">{{ cargando ? 'Cargando...' : 'Guardar' }}</button>
      <p v-if="mensajeError" class="error-message">{{ mensajeError }}</p>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      prestamo: {
        socio: "",
        libro: "",
        fecha_desde: new Date().toISOString().substring(0, 10),
        fecha_hasta: null,
        fecha_dev: null 
      },
      cargando: false,
      mensajeError: ""
    }
  },
  methods: {
    async crearPrestamo() {
      this.cargando = true;
      try {
        const res = await axios.post('http://192.168.20.10/apiv1/prestamos/nuevo', this.prestamo);
        console.log(res.data); // Manejar la respuesta según sea necesario
        // Aquí podrías redirigir a otra página o realizar otra acción después de crear el préstamo
        this.$router.push('/Prestamo');
      } catch (error) {
        console.error(error);
        this.mensajeError = "Error al crear el préstamo"; // Mostrar mensaje de error
      } finally {
        this.cargando = false;
      }
    }
  }
}
</script>

<style>
.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  font-weight: bold;
}

input[type="number"],
input[type="date"],
button {
  width: 50%;
  padding: 10px;
  font-size: 1.2em;
}

button {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}

.error-message {
  color: #ff0000;
}
</style>




