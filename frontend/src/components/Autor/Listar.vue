<template>
  <div>
    <h1>Listar Autores</h1>
    <router-link to="/Autor/crear" class="crear">
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
            <button @click="editarAutor(autor.id)" class="btn editar">Editar</button>
            <button @click="eliminarAutorConfirmacion(autor.id)" class="btn eliminar">Eliminar</button>
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
    async editarAutor(id) {
      // Redirigir a la página de edición del autor con el ID proporcionado
      this.$router.push(`/Autor/Actualizar/${id}`);
    },
    async eliminarAutorConfirmacion(autor) {
      if (confirm(`¿Estás seguro de que quieres eliminar al Autor ${autor.id}?`)) {
        await this.eliminarAutor(autor);
      }
    },

    async eliminarAutor(id) {
      try {
        const res = await axios.delete(`http://192.168.20.10/apiv1/autores/${id}`);
        console.log(res.data); // Mostrar mensaje de éxito si es necesario
        // Eliminar el autor del array items
        this.items = this.items.filter(item => item.id !== id);
      } catch (error) {
        console.error(error);
        // Mostrar mensaje de error si es necesario
      }
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
thead {
  background-color: #f2f2f2;
}
th {
  padding: 10px;
}
.btn {
  padding: 8px 12px;
  border-radius: 5px;
  cursor: pointer;
  font-weight: bold;
}

/* Estilo para el botón "Editar" */
.btn.editar {
  background-color: #3498db; /* Azul */
  color: #fff;
}

/* Estilo para el botón "Eliminar" */
.btn.eliminar {
  background-color: #e74c3c; /* Rojo */
  color: #fff;
}

/* Estilo para el botón "Crear" */
.crear {
  display: inline-block;
  padding: 8px 12px;
  border-radius: 5px;
  background-color: #27ae60; /* Verde */
  color: #fff;
  text-decoration: none;
}
</style>

  