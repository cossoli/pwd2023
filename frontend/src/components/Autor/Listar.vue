<template>
   <h1> Listar Autores</h1>
  
   <RouterLink class ="crear" to="/Autor/crear"><img src="../..assets/editar.svg" 
    alt=""/>Crear Autores</RouterLink> 
   
    <table>
    <thead>
        <tr>
            <td>id</td>
            <td>nombre y apellido</td>
            <td>acciones</td>
        </tr>

    
   
    </thead>
    <tbody>
        <tr v-for="autores in items" :key="autores">

        <td>{{ autores.id }}</td>
        <td>{{ autores.nombre_apellido }}</td>
     
       
          <!-- <RouterLink :to="{name: 'ActualizarSocio', params: {id: socio.id}}"> -->
            <Boton btnText="Editar" btnUrl="" btnClass="btn blue"></Boton>
            <!-- </RouterLink> -->
   
         <td>
            <!-- <boton texto="Eliminar" v-bind:class="{warning:true}"></boton> -->
            <Boton btnText="Eliminar" btnUrl="" btnClass="btn red"></Boton>
         </td> 
         
        </tr>
         <td>
            <!-- <boton texto="Abrir" v-bind:class="{alert:true}"></boton> -->

       

         </td>   
 


        </tbody>
   </table>
 </template>
  
<script lang="ts">
import axios from 'axios';
import Boton from '../Boton.vue';

   export default{

    components :{Boton},
     data()
         { 
        return{
            items:[]
        }     
         
     },
   
   created(){
    this.Listar();
   }, 

   methods:{
       
        async Listar(){
            const res=await axios.get('http://192.168.20.10/apiv1/autores');
            this.items = res.data;
            console.log(res);


        }

   }
  
}

</script>

<style scoped>
table {
    background:#fff ;
    border-radius: 10px;
    inset: 10px 50px 10px;
    box-shadow: 5px 5px 50px rgb(4,96,0.2);
    width: 100%;
    color:black;
    margin: 20px;
    padding: 15px;
}
thead {
    
}


</style>