<template>
   <h1> Listado de Socios</h1>
  
   <RouterLink class ="Crear" to="Socios/Crear"><img src="../../assets/editar.svg" alt="">Crear Socios</RouterLink> 
   
<table> 

    <thead>
        <tr>
            <td>id</td>
            <td>nombre</td>
            <td>fecha alta</td>
            <td>direccion</td>
            <td>telefono</td>
            <td>acciones</td>
        </tr>
    </thead>
    <tbody>
        <tr
         v-for="socio in items" :key="socio">
                <td>{{ socio.id }}</td>
                <td>{{ socio.nombre_apellido }}</td>
                <td>{{ socio.fecha_alta }}</td>
                <td>{{ socio.direccion }}</td>
                <td>{{ socio.telefono }}</td>  
                
                 <!-- <RouterLink :to="{name: 'ActualizarSocio', params: {id: socio.id}}"> -->
            <Boton btnText="Editar" btnUrl="" btnClass="btn blue"></Boton>
            <!-- </RouterLink> -->
   
         <td>
            <!-- <boton texto="Eliminar" v-bind:class="{warning:true}"></boton> -->
            <Boton btnText="Eliminar" btnUrl="" btnClass="btn red"></Boton>
         </td> 
         
        </tr>
     
         
          
   </tbody>
</table>
</template>
  
<script lang="ts">
import axios from 'axios';
import Boton from '../Boton.vue';

   export default{

    components :{ Boton },
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
            const res = await axios.get('http://192.168.20.10/apiv1/socios');
            this.items = res.data;
            console.log(res.data);


        }

   }
  
}

</script>

<style >
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
</style>