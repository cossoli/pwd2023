<template>
  <div class="form-container">
    <h2>Crear nueva editorial</h2>

    <input v-model="editoriales.nombre" type="text" label="Nombre" placeholder="Nombre">
    <button @click="crearEditorial" class="guardar-btn">Guardar</button>

    <p v-if="mensaje">{{ mensaje }}</p>
  </div>
</template>

  
  <script lang="ts">
  import axios from 'axios';
  
  export default {
    data() {
      return {
        editoriales: {
          id: "",
          nombre: "",
          activo: 1
        },
        mensaje: "" // Mensaje de retroalimentación para el usuario
      };
    },
    methods: {
      async crearEditorial() {
        try {
          // Validar que el nombre no esté vacío
          if (!this.editoriales.nombre.trim()) {
            this.mensaje = "Por favor ingresa un nombre válido para la editorial.";
            return;
          }
  
          const res = await axios.post('http://192.168.20.10/apiv1/editoriales/nuevo', this.editoriales);
          console.log(res.data); 

          this.$router.push('/editorial');
         } catch (error) {
          console.error(error);
   
        }
      }
    }
  };
  </script>
  
  <style scoped>
.form-container {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  text-align: center;
}

input {
  width: 100%;
  font-size: 1.2em;
  padding: 10px;
  margin: 15px 0;
  box-sizing: border-box;
}

.guardar-btn {
  padding: 10px 20px;
  background-color: #28a745; /* Verde */
  color: #fff;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
}

.guardar-btn:hover {
  background-color: #218838; /* Verde oscuro */
}

p {
  color: #333;
  font-size: 1em;
  margin-top: 15px;
}
</style>


