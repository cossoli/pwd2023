<template>
  <div>
    <h1>Listado de Préstamos</h1>

    <router-link class="btn-crear" to="/prestamo/crear">
      <img src="../../assets/editar.svg" alt=""/>Crear Préstamo
    </router-link>

    <table>
      <thead>
        <tr>
          <th>ID Libro</th>
          <th>ID Socio</th>
          <th>Fecha Desde</th>
          <th>Fecha Hasta</th>
          <th>Fecha Devolución</th>
          <th>Días de Retraso</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="prestamo in prestamos" :key="prestamo.id">
          <td>{{ prestamo.libro.id }}</td>
          <td>{{ prestamo.socio.id }}</td>
          <td>{{ prestamo.fecha_desde }}</td>
          <td>{{ prestamo.fecha_hasta }}</td>
          <td>{{ prestamo.fecha_dev || '-' }}</td>
                    <td>
            <span v-if="prestamo.dias_retraso > 0">
              {{ prestamo.dias_retraso }} días
            </span>
            <span v-else>
              -
            </span>
          </td>
          <td>
            <button class="btn-devolver" @click="devolverLibro(prestamo.id)">
              Devolver
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      prestamos: []
    };
  },
  created() {
    this.obtenerPrestamos();
  },
  methods: {
    async obtenerPrestamos() {
      try {
        const res = await axios.get('http://192.168.20.10/apiv1/prestamos');
        this.prestamos = res.data;
      } catch (error) {
        console.error('Error al obtener los préstamos:', error);
      }
    },
    prestarlibro(id) {
      this.$router.push("/prestamo/crear/" + id);
    },
    devolverLibro(id) {
      this.$router.push("/prestamo/Actualizar/" + id);
    }
  }
}
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
}
table th, table td {
  border: 1px solid #ccc;
  padding: 8px;
  text-align: left;
}
table th {
  background-color: #f2f2f2;
}
table tr:hover {
  background-color: #f5f5f5;
}
.btn-crear {
  background-color: #66cc99;
  color: white;
  text-decoration: none;
  padding: 8px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.btn-devolver {
  background-color: #3498db;
  color: white;
  padding: 5px 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.btn-devolver:hover {
  background-color: #2980b9;
}
</style>

