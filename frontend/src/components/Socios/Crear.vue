
<script lang="ts">
 import axios from 'axios';

 
    export default{
        data()
          { 
         return{
             Socio:{
                
                id:1,
                fecha_alta: new Date().toISOString().substring(0,10),
                nombre_apellido:"",
                direccion:"",
                telefono:"",
                activo:1,                       

             }
         }     
          
      },
    
     methods:{
        
          async crearSocios(Socio){
             console.log(Socio)
             const res= await axios.post('http://192.168.20.10/apiv1/socios/nuevo', Socio)
             console.log(res.data);
 
 
         }
 
    }
   
 }
</script>
<template>
<h2>Crear nuevo socios</h2>

<input v-model=Socio.nombre_apellido type="text" label='nombre y apellido' placeholder="apellido y nombre">
<input v-model=Socio.telefono type="text" label ='telefono' placeholder="telefono">
<input v-model=Socio.direccion type="text" label ='direccion' placeholder="direccion">
<button  @click = "crearSocios(Socio)"> guardar</button>
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



