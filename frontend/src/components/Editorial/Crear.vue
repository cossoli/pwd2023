<script lang="ts">
 import axios from 'axios';

 
    export default{
      Data()
          { 
         return{
             editorial:{
                id:"",
                nombre:"",
                activo:1,

             }
         }     
          
      },
    
     methods:{
        
          async crearEditorial(editorial){
             console.log(editorial)
             const res=await axios.get('http:/192.168.20.10/apiv1/editorial/nuevo', editorial)
             
 
 
         }
 
    }
   
 }
</script>
<template>
<h2>Crear nuevo Editorial</h2>

<input v-model= editorial.nombre type="text" label='nombre ' placeholder="nombre">
<button  @click = "crearEditorial(editorial)"> guardar</button>
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



