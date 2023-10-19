
<script lang="ts">
 import axios from 'axios';

 
    export default{
      data()
          { 
         return{
             prestamo:{
                id:"",
                id_socio:"",
                fecha_desde: new Date().toISOString().substring(0,10),
                fecha_hasta: new Date().toISOString().substring(0,10),
                fecha_devolucion : new Date().toISOString().substring(0,10),


             }
         }     
          
      },
    
     methods:{
        
          async crearPrestamo(prestamo){
             console.log(prestamo)
             const res=await axios.post('http://192.168.20.10/apiv1/prestamos/nuevo', prestamo)
             
 
 
         }
 
    }
   
 }
</script>
<template>
<h2>Crear nuevo prestamos</h2>

<input v-model= prestamo.id type="text" label='id' placeholder="id">
<input v-model= prestamo.id_socio type="text" label ='socio' placeholder="socio">
<input v-model = prestamo.fecha_desde type="text" label ='fecha desde' placeholder="fecha desde">
<input v-model = prestamo.fecha_hasta type="text" label ='fecha hasta' placeholder="fecha hasta">
<input v-model = prestamo.fecha_devolucion type="text" label ='fecha dev' placeholder="fecha dev">


<button  @click = "crearPrestamo(prestamo)"> guardar</button>
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



