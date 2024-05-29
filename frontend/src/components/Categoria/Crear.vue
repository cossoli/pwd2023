<template>
  <div class="form-container">
    <h2>Crear nueva categoría</h2>

    <input v-model="categoria.descripcion" type="text" label="Descripción" placeholder="Descripción">
    <button @click="crearCategoria" class="guardar-btn">Guardar</button>

    <p v-if="mensaje">{{ mensaje }}</p>
  </div>
</template>

  
  <script lang="ts">
  import axios from 'axios';
  
  export default {
    data() {
      return {
        categoria: {
          id: "",
          descripcion: "",
          activo: 1
        },
        mensaje: "" // Mensaje de retroalimentación para el usuario
      };
    },
    methods: {
      async crearCategoria() {
        try {
          // Validar que la descripción no esté vacía
          if (!this.categoria.descripcion.trim()) {
            this.mensaje = "Por favor ingresa una descripción válida para la categoría.";
            return;
          }
  
          const res = await axios.post('http://192.168.20.10/apiv1/categorias/nuevo', this.categoria);
          console.log(res.data); // Manejar la respuesta según sea necesario
  
          // Limpiar el formulario y mostrar mensaje de éxito
          this.categoria.descripcion = "";
          this.mensaje = "Categoría creada exitosamente.";
        } catch (error) {
          console.error(error);
          this.mensaje = "Ocurrió un error al crear la categoría. Por favor intenta nuevamente.";
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
