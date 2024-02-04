<template>
  <div class="container">
    <h1>Listado de Prestamos</h1>

    <router-link class="btn btn-verde" to="/prestamo/crear">
      <img src="../../assets/editar.svg" alt=""/>Crear Prestamo
    </router-link>

    <div class="search-container">
      <input v-model="searchSocio" type="text" placeholder="Buscar Socio" @input="buscarSocio">
      <input v-model="searchLibro" type="text" placeholder="Buscar Libro" @input="buscarLibro">
    </div>

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
            <button class="btn btn-rojo" @click="eliminarPrestamo(prestamo.id)">Eliminar</button>
            <button class="btn btn-azul" @click="abrirPrestamo(prestamo.id)">Abrir</button>
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
      items: [],
      searchSocio: '',
      searchLibro: '',
    };
  },
  created() {
    this.listarPrestamos();
  },
  methods: {
    async listarPrestamos() {
      try {
        const res = await axios.get('http://192.168.20.10/apiv1/prestamos');
        this.items = res.data;
      } catch (error) {
        console.error('Error al obtener los préstamos:', error);
      }
    },
    buscarSocio() {
      // Lógica para filtrar socios según la búsqueda
    },
    buscarLibro() {
      // Lógica para filtrar libros según la búsqueda
    },
    async eliminarPrestamo(id) {
      try {
        await axios.delete(`http://192.168.20.10/apiv1/prestamos/${id}`);
        // Actualizar la lista después de eliminar
        this.listarPrestamos();
      } catch (error) {
        console.error('Error al eliminar el préstamo:', error);
      }
    },
    abrirPrestamo(id) {
      // Lógica para abrir el préstamo
    }
  }
};
</script>

<style scoped>
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

.btn {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn-verde {
  background-color: #66cc99; /* Verde */
  color: white;
}

.btn-rojo {
  background-color: #ff4d4d; /* Rojo */
  color: white;
}

.btn-azul {
  background-color: #3498db; /* Azul */
  color: white;
}

.search-container {
  margin-bottom: 20px;
}

.search-container input {
  padding: 10px;
  margin-right: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}
</style>
