<script lang="ts">
 import axios from 'axios';

 
    export default{
      data()
          { 
         return{
             Autor:{
                id:4,
                nombre_apellido:"",
               
             }
         }     
          
      },
    
     methods:{
        
          async crearAutor(Autor){
             console.log(Autor)
             const res=await axios.post('http://192.168.20.10/apiv1/autores/nuevo', Autor)
            
 
         }
 
    }
   
 }
</script>
<template>
<h2>Crear nuevo Autor</h2>

<input v-model= Autor.nombre_apellido type="text" label='nombre y apellido' placeholder="apellido y nombre">

<button  @click = "crearAutor(Autor)"> guardar</button>
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



