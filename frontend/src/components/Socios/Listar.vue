<template>
  <div>
    <h1>Listado de Socios</h1>
    <router-link to="/Socios/Crear" class="Crear btn">Crear Socios</router-link>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Fecha Alta</th>
          <th>Dirección</th>
          <th>Teléfono</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="socio in items" :key="socio.id">
          <td>{{ socio.id }}</td>
          <td>{{ socio.nombre_apellido }}</td>
          <td>{{ socio.fecha_alta }}</td>
          <td>{{ socio.direccion }}</td>
          <td>{{ socio.telefono }}</td>
          <td>
            <button @click="editarSocio(socio)" class="Editar btn">Editar</button>
            <button @click="eliminarSocioConfirmacion(socio)" class="Eliminar btn">Eliminar</button>
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
      items: []
    };
  },
  created() {
    this.listarSocios();
  },
  methods: {
    async listarSocios() {
      try {
        const response = await axios.get('http://192.168.20.10/apiv1/socios');
        this.items = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    async eliminarSocioConfirmacion(socio) {
      if (confirm(`¿Estás seguro de que quieres eliminar al socio ${socio.nombre_apellido}?`)) {
        await this.eliminarSocio(socio);
      }
    },
    async eliminarSocio(socio) {
      try {
        const response = await axios.delete(`http://192.168.20.10/apiv1/socios/${socio.id}`);
        this.items = this.items.filter(item => item.id !== socio.id);
        console.log(response.data); // Mostrar mensaje de éxito si es necesario
      } catch (error) {
        console.error(error);
        // Mostrar mensaje de error si es necesario
      }
    },
    editarSocio(socio) {
      this.$router.push(`/Socios/Actualizar/${socio.id}`);
    }
  }
};
</script>

<style scoped>
table {
  background: #fff;
  border-radius: 10px;
  inset: 10px 50px 10px;
  box-shadow: 5px 5px 50px rgb(4, 96, 0.2);
  width: 100%;
  color: black;
  margin: 20px;
  padding: 15px;
}

table th {
  background-color: #f2f2f2;
}

.btn {
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.Crear {
  background-color: #4caf50;
  color: white;
}

.Editar {
  background-color: #2196f3;
  color: white;
}

.Eliminar {
  background-color: #f44336;
  color: white;
}

</style>
