
<script lang="ts">
 import axios from 'axios';

 
    export default{
      Data()
          { 
         return{
             libros:{
                id:"",
                anio:"",
                estado:"",
                titulo:"",
                id_categoria:"",
                id_editorial:"",
                id_genero:"",
                cant_paginas:""
               }
         }     
          
      },
    
     methods:{
        
          async crearLibros(libros){
             console.log(libros)
             const res=await axios.get('http:/192.168.20.10/apiv1/libro/nuevo', libros)
             
 
 
         }
 
    }
   
 }
</script>
<template>
<h2>Crear nuevo libro</h2>

<input v-model= Libros.estado type="text" label='estado' placeholder="estado">
<input v-model= libros.titulo type="text" label ='titulo' placeholder="titulo">
<input v-model= libros.anio type="text" label ='anio' placeholder="anio">
<input v-model= libros.id_categoria type="text" label ='categoria' placeholder="id_categoria">
<input v-model= libros.id_editorial type="text" label ='id_editorial' placeholder="id_editorial">
<input v-model= libros.id_genero type="text" label ='id_genero' placeholder="id_genero">
<input v-model= libros.cant_paginas type="text" label ='cant_paginas' placeholder="cant_paginas" >

<button  @click = "crearLibros(libros)"> guardar</button>
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



