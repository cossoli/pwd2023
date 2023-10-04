<script lang="ts">
 import axios from 'axios';

 
    export default{
      data()
          { 
         return{
             editoriales:{
                id:"",
                nombre:"",
                activo:1,

             }
         }     
          
      },
    
     methods:{
        
          async crearEditorial(editoriales){
             console.log(editoriales)
             const res=await axios.post('http://192.168.20.10/apiv1/editorial/nuevo', editoriales)
             
 
 
         }
 
    }
   
 }
</script>
<template>
<h2>Crear nuevo Editorial</h2>

<input v-model=editoriales.nombre type="text" label='nombre ' placeholder="nombre">
<button  @click = "crearEditorial(editoriales)"> guardar</button>
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



