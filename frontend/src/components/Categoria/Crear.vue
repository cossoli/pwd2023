<script lang="ts">
 import axios from 'axios';

 
    export default{
      data()
          { 
         return{
             categoria:{
                id:"",
                nombre:"",
                activo:1,

             }
         }     
          
      },
    
     methods:{
        
          async crearCategria(categoria){
             console.log(categoria)
             const res=await axios.post('http://192.168.20.10/apiv1/categorias/nuevo', categoria)
             
 
 
         }
 
    }
   
 }
</script>
<template>
<h2>Crear nueva categoria</h2>

<input v-model= categoria.nombre type="text" label='nombre' placeholder="nombre">

<button  @click = "crearCategria(categoria)"> guardar</button>
</template>
<style>
input {
    width: 50%;
    font-size: 1.2em;
    display: flex;
    align-content: center;
    padding: 10px;
    margin: 15px;
}
</style>



