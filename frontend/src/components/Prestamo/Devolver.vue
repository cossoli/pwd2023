<template>
  <div>
    <h1>Devolver Libro</h1>
    <form @submit.prevent="manejarDevolucion">
      <div>
        <label for="libro">Libro:</label>
        <input type="text" id="libro" v-model="libro.titulo" readonly />
      </div>
      <div>
        <label for="autor">Autor:</label>
        <input type="text" id="autor" v-model="libro.autor" readonly />
      </div>
      <div>
        <label for="fecha_desde">Fecha Desde:</label>
        <input type="text" id="fecha_desde" v-model="libro.fecha_desde" readonly />
      </div>
      <div>
        <label for="fecha_hasta">Fecha Hasta:</label>
        <input type="text" id="fecha_hasta" v-model="libro.fecha_hasta" readonly />
      </div>
      <div>
        <label for="estado">Estado:</label>
        <input type="text" id="estado" v-model="libro.estado" readonly />
      </div>
      <button type="submit">Confirmar Devolución</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      libro: {}
    };
  },
  created() {
    this.obtenerLibro();
  },
  methods: {
    async obtenerLibro() {
      const libroId = this.$route.params.id;
      try {
        const res = await axios.get(`http://192.168.20.10/apiv1/prestamos/${libroId}`);
        this.libro = res.data;
      } catch (error) {
        console.error('Error al obtener el libro:', error);
      }
    },
    async manejarDevolucion() {
      const libroId = this.$route.params.id;
      try {
        await axios.put(`http://192.168.20.10/apiv1/libros/${libroId}`, { estado: 'activo' });
        this.$router.push('/prestamos');
      } catch (error) {
        console.error('Error al devolver el libro:', error);
      }
    }
  }
}
</script>
