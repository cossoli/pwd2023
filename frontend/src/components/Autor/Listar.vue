<template>
  <div>
    <h1>Listar Autores</h1>
    <router-link to="/Autor/crear" class="btn-crear">
      <img src="../../assets/editar.svg" alt="" />Crear Autores
    </router-link>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre y Apellido</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="autor in items" :key="autor.id">
          <td>{{ autor.id }}</td>
          <td>{{ autor.nombre_apellido }}</td>
          <td>
            <button @click="editarAutor(autor)" class="btn-editar">Editar</button>
            <button @click="eliminarAutorConfirmacion(autor)" class="btn-eliminar">Eliminar</button>
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
      items: []
    };
  },
  created() {
    this.listarAutores();
  },
  methods: {
    async listarAutores() {
      try {
        const res = await axios.get('http://192.168.20.10/apiv1/autores');
        this.items = res.data;
      } catch (error) {
        console.error(error);
      }
    },
    
    editarAutor(autores) {
      this.$router.push(`/Autor/Actualizar/${autores.id}`);
    },

    
    async eliminarAutorConfirmacion(autor) {
      if (confirm(`¿Estás seguro de que quieres eliminar al Autor ${autor.nombre_apellido}?`)) {
        await this.eliminarAutor(autor.id);
      }
    },
    async eliminarAutor(id) {
      try {
        await axios.delete(`http://192.168.20.10/apiv1/autores/${id}`);
        this.items = this.items.filter(item => item.id !== id);
        console.log('Autor eliminado correctamente');
      } catch (error) {
        console.error(error);
      }
    }
  }
};
</script>

<style scoped>
.btn-crear {
  display: inline-block;
  padding: 8px 12px;
  border-radius: 5px;
  background-color: #27ae60; /* Verde */
  color: #fff;
  text-decoration: none;
  margin-bottom: 10px;
}

.btn-editar,
.btn-eliminar {
  padding: 8px 12px;
  border-radius: 5px;
  cursor: pointer;
  font-weight: bold;
  margin-right: 5px;
}

.btn-editar {
  background-color: #3498db; /* Azul */
  color: #fff;
}

.btn-eliminar {
  background-color: #e74c3c; /* Rojo */
  color: #fff;
}

table {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 5px 5px 50px rgba(4, 96, 0, 0.2);
  width: 100%;
  color: black;
  margin-bottom: 20px;
  padding: 15px;
}

th {
  background-color: #f2f2f2;
  padding: 10px;
}

th, td {
  text-align: left;
  padding: 10px;
}
</style>
