<template>
  <div>
    <h1>Listado de libros</h1>

    <router-link class="crear" to="/libro/crear">
      <img src="../..assets/editar.svg" alt="" />Crear libros
    </router-link>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Año</th>
          <th>Estado</th>
          <th>Categoría</th>
          <th>Editorial</th>
          <th>Género</th>
          <th>Autor</th>
          <th>Cant. Páginas</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="libro in items" :key="libro.id">
          <td>{{ libro.id }}</td>
          <td>{{ libro.titulo }}</td>
          <td>{{ libro.anio }}</td>
          <td>{{ libro.estado }}</td>
          <td>{{ libro.categoria.descripcion }}</td>
          <td>{{ libro.editorial.nombre }}</td>
          <td>{{ libro.genero.descripcion }}</td>
          <td>
            <span v-for="(autor, index) in libro.autores" :key="index">
              {{ autor.nombre_apellido }}
              <span v-if="index !== libro.autores.length - 1">, </span>
            </span>
          </td>
          <td>{{ libro.cant_paginas }}</td>
          <td>
            <button @click="editarLibro(libro.id)" class="btn-editar">Editar</button>
            <button @click="eliminarLibroConfirmacion(libro)" class="btn-eliminar">Eliminar</button>

          <button @click="prestarLibro(libro)" class="btn-prestar">Prestar Libro</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';
import Boton from '../Boton.vue';

export default {
  components: { Boton },
  data() {
    return {
      items: [],
    };
  },
  created() {
    this.listarLibros();
  },
  methods: {
    async listarLibros() {
      try {
        const res = await axios.get('http://192.168.20.10/apiv1/libros');
        this.items = res.data;

        
      } catch (error) {
        console.error(error);
      }
    },
    editarLibro(id) {
      this.$router.push("/libro/Actualizar" +id);
    },
    async eliminarLibroConfirmacion(libro) {
      if (confirm(`¿Estás seguro de que quieres eliminar el libro "${libro.titulo}"?`)) {
        await this.eliminarLibro(libro.id);
      }
    },
    async eliminarLibro(id) {
      try {
        await axios.delete(`http://192.168.20.10/apiv1/libros/${id}`);
        this.listarLibros();
      } catch (error) {
        console.error('Error al eliminar el libro:', error);
      }
    },
    async prestarLibro(libro) {
      try {
    if (libro.estado !== 'Disponible') {
      alert('El libro seleccionado no está disponible para préstamo.');
      return;
    }


    const usuarioId = 1; 
    const fechaInicio = new Date().toISOString();
    const prestamo = {
      libro_id: libro.id,
      usuario_id: usuarioId,
      fecha_inicio: fechaInicio
    };
    await axios.post('http://192.168.20.10/apiv1/prestamos', prestamo);

    
    libro.estado = 'Prestado'; 
    await axios.put(`http://192.168.20.10/apiv1/libros/${libro.id}`, { estado: 'Prestado' });
   
    alert(`El libro "${libro.titulo}" se ha prestado correctamente.`);
  } catch (error) {
    console.error('Error al prestar el libro:', error);
    alert('Ocurrió un error al prestar el libro. Por favor, inténtalo de nuevo.');
  }
}
      
  },
};
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}

.btn-editar {
  background-color: #3498db; /* Azul */
  color: #fff;
  margin-right: 5px;
}

.btn-eliminar {
  background-color: #e74c3c; /* Rojo */
  color: #fff;
}

.btn-prestar {
  background-color: #66cc99; /* Verde */
  color: white;
  border: none;
  padding: 8px 12px;
  border-radius: 4px;
  cursor: pointer;
}

</style>
