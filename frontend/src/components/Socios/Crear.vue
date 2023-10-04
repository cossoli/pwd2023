
<script lang="ts">
 import axios from 'axios';

 
    export default{
        data()
          { 
         return{
             Socio:{
                
                id:5,
                fecha_alta: new Date().toISOString().substring(0,10),
                nombre_apellido:"",
                direccion:"",
                telefono:258648525,
                activo:1,                       

             }
         }     
          
      },
    
     methods:{
        
          async crearSocios(Socio){
             console.log(Socio)
             const res= await axios.post('http://192.168.20.10/apiv1/socios/nuevo', Socio)
           
 
         }
 
    }
   
 }
</script>
<template>
<h2>Crear nuevo socios</h2>

<input v-model=Socio.nombre_apellido type="text" label='Nombre y Apellido' placeholder="Nombre y Apellido">
<input v-model=Socio.telefono type="text" label ='Telefono' placeholder="Telefono">
<input v-model=Socio.direccion type="text" label ='Direccion' placeholder="Direccion">
<button  @click = "crearSocios(Socio)"> guardar</button>
</template>

<style scope>

input {
    width: 50%;
    font-size: 1.2em;
    display: flex;
    align-content: center;
    padding: 10px;
    margin: 15px;
}
</style>



