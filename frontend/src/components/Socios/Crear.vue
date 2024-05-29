<template>
  <div class="container">
    <h2>Crear nuevo socio</h2>
    <input v-model="Socio.nombre_apellido" type="text" placeholder="Nombre y Apellido" />
    <input v-model="Socio.telefono" type="number" placeholder="Teléfono" />
    <input v-model="Socio.direccion" type="text" placeholder="Dirección" />
    <button @click="crearSocios">Guardar</button>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      Socio: {
        id: "",
        fecha_alta: new Date().toISOString().substring(0, 10),
        nombre_apellido: "",
        direccion: "",
        telefono: "",
        activo: 1,
      }
    }
  },
  methods: {
    async crearSocios() {
      console.log(this.Socio);
      try {
        const res = await axios.post('http://192.168.20.10/apiv1/socios/nuevo', this.Socio);
        console.log(res.data); // Manejar la respuesta según sea necesario
        this.$router.push('/socios'); // Usar $router en lugar de $route
      } catch (error) {
        console.error(error);
        // Manejar errores de la solicitud HTTP
      }
    }
  }
}
</script>

<style scoped>
.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-color: #f8f8f8;
}

h2 {
  margin-bottom: 20px;
  font-size: 2em;
  color: #333;
  text-align: center;
}

input {
  width: 50%;
  font-size: 1.2em;
  padding: 10px;
  margin: 15px 0;
  border: 1px solid #ccc;
  border-radius: 5px;
  display: block;
}

button {
  font-size: 1.2em;
  padding: 10px 20px;
  cursor: pointer;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 5px;
  margin-top: 10px;
}

button:hover {
  background-color: #218838;
}

p {
  font-size: 1em;
  color: red;
  margin-top: 20px;
}
</style>
