<template>
  <div>
    <h1>Listado de Prestamos</h1>

    <router-link class="crear btn-verde" to="/prestamo/crear">
      <img src="../../assets/editar.svg" alt=""/>Crear Prestamo
    </router-link>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>ID Libro</th>
          <th>ID Socio</th>
          <th>Fecha Desde</th>
          <th>Fecha Hasta</th>
          <th>Fecha Devolución</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="prestamo in items" :key="prestamo.id">
          <td>{{ prestamo.id }}</td>
          <td>{{ prestamo.id_libro }}</td>
          <td>{{ prestamo.id_socio }}</td>
          <td>{{ prestamo.fecha_desde }}</td>
          <td>{{ prestamo.fecha_hasta }}</td>    
          <td>{{ prestamo.fecha_devolucion }}</td>   
          <td>
            <button class="eliminar btn-rojo" @click="eliminarPrestamo(prestamo.id)">Eliminar</button>
            <button class="abrir btn-azul" @click="abrirPrestamo(prestamo.id)">Abrir</button>
          </td>
        </tr>      
      </tbody>
    </table>
  </div>
</template>

<script lang="ts">
import axios from 'axios';
import Boton from '../Boton.vue';

export default {
  components: { Boton },
  data() {
    return {
      items: []
    };
  },
  created() {
    this.Listar();
  },
  methods: {
    async Listar() {
      try {
        const res = await axios.get('http://192.168.20.10/apiv1/prestamos');
        this.items = res.data;
      } catch (error) {
        console.error('Error al obtener los préstamos:', error);
      }
    },
    async eliminarPrestamo(id) {
      try {
        await axios.delete(`http://192.168.20.10/apiv1/prestamos/${id}`);
        // Actualizar la lista después de eliminar
        this.Listar();
      } catch (error) {
        console.error('Error al eliminar el préstamo:', error);
      }
    },
    abrirPrestamo(id) {
      // Lógica para abrir el préstamo
    }
  }
}
</script>

<style scoped>
/* Estilos para los botones */
.btn {
  padding: 5px 10px;
  cursor: pointer;
}

.crear {
  background-color: #66cc99; /* Verde */
  color: white;
}

.abrir {
  background-color: #3498db; /* Azul */
  color: white;
}

.eliminar {
  background-color: #ff4d4d; /* Rojo */
  color: white;
}
</style>
