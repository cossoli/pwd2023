<template>
    <h1> Listado de Autores</h1>
  
 </template>

<script lang="ts">
 import axios from 'axios';

 
    export default{
      Data()
          { 
         return{
             autores:{
                id:"",
                nombre_apellido:"",
               
             }
         }     
          
      },
    
     methods:{
        
          async crearAutor(autor){
             console.log(autor)
             const res=await axios.get('http:/192.168.20.10/apiv1/autor/nuevo', autor)
             
 
 
         }
 
    }
   
 }
</script>
<template>
<h2>Crear nuevo Autor</h2>

<input v-model= autores.nombre_apellido type="text" label='nombre y apellido' placeholder="apellido y nombre">

<button  @click = "crearAutor(autor)"> guardar</button>
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



