<script lang="ts">
 import axios from 'axios';

 
    export default{
      Data()
          { 
         return{
             socio:{
                id:"",
                descripcion:"",
                activo:1,

             }
         }     
          
      },
    
     methods:{
        
          async crearGenero(genero){
             console.log(genero)
             const res=await axios.get('http://192.168.20.10/apiv1/genero/nuevo', genero)
             
 
 
         }
 
    }
   
 }
</script>
<template>
<h2>Crear nuevo genero</h2>

<input v-model= genero.descripcion type="text" label='descripcion' placeholder="descripcion">
<button  @click = "crearGenero(genero)"> guardar</button>
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



