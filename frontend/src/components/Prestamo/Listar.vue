<template>
  <div>
    <h1>Listado de Prestamos</h1>

    <router-link class="btn-crear" to="/prestamo/crear">
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
          <th>Estado</th>
          <th>Autores</th>
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
          <td>{{ prestamo.fecha_dev }}</td>   
          <td>{{ prestamo.estado }}</td> <!-- Mostrar el estado del préstamo -->
          <td>
            <span v-for="(autor, index) in prestamo.autores" :key="index">
              {{ autor.nombre_apellido }}
              <span v-if="index !== prestamo.autores.length - 1">, </span>
            </span>
          </td>
          <td>
            <button class="btn-devolver" @click="devolverLibro(prestamo.id)">Devolver</button>
          </td>
        </tr>      
      </tbody>
    </table>
  </div>
</template>

<script lang="ts">
import axios from 'axios';

export default {
  data() {
    return {
      items: [],
      nombre_autores :[]
      
    };
  },
  created() {
    this.Listar();
    this.obtenerNombresAutores();
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
    
  async obtenerNombresAutores() {

  try {
    const res = await axios.get(`http://192.168.20.10/apiv1/autores`);
    this.nombre_autores = res.data.map(autor => ({ id: autor.id, nombre: autor.nombre_apellido }));
  } catch (error) {
    console.error('Error al obtener autores:', error);
      }
      }
        },
        
    async devolverLibro(id) {
      try {
        await axios.put(`http://192.168.20.10/apiv1/prestamos/devolver/${id}`);
        // Actualizar la lista después de devolver el libro
        this.Listar();
      } catch (error) {
        console.error('Error al devolver el libro:', error);
      }
    }
  }

</script>

<style scoped>
/* Estilos para los botones */
.btn {
  padding: 8px 12px;
  cursor: pointer;
  border: none;
  border-radius: 4px;
  transition: background-color 0.3s;
}

.btn-crear {
  background-color: #66cc99; /* Verde */
  color: white;
  text-decoration: none;
}

.btn-devolver {
  background-color: #3498db; /* Azul */
  color: white;
}

.btn:hover {
  background-color: #555; /* Cambiar color al pasar el mouse */
}
</style>
