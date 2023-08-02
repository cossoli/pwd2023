
<script lang="ts">
 import axios from 'axios';

 
    export default{
      Data()
          { 
         return{
             socio:{
                id:"",
                nombre_apellido:"",
                direccion:"",
                fecha_alta: new Date().toISOString().substring(0,10),
                activo:1,

             }
         }     
          
      },
    
     methods:{
        
          async crearPrestamo(socio){
             console.log(socio)
             const res=await axios.get('http://192.168.20.10/apiv1/socios/nuevo', socio)
             
 
 
         }
 
    }
   
 }
</script>
<template>
<h2>Crear nuevo socio</h2>

<input v-model= socio.nombre_apellido type="text" label='nombre y apellido' placeholder="apellido y nombre">
<input v-model= socio.telefono type="text" label ='telefono' placeholder="telefono">
<input v-model = socio.direccion type="text" label ='direccion' placeholder="direccion">
<button  @click = "crearPrestamo(Socio)"> guardar</button>
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



