<template>
   <h1> Listado de libros</h1>
  
   <RouterLink class ="crear" to="/libro/crear"><img src="../..assets/editar.svg" 
    alt="" />Crear libros</RouterLink> 
   
<table>
    <thead>
        <tr>
            <td>id</td>
            <td>titulo</td>
            <td>anio</td>
            <td>estado</td>
            <td>id_categoria</td>
            <td>id_editorial</td>
            <td>id_genero</td>
            <td>cant_paginas</td>
        </tr>
    </thead>
    <tbody>
        <tr v-for="libros in items" :key="libros">
        
        <td>{{ libros.id }}</td>
        <td>{{ libros.anio }}</td>
        <td>{{ libros.titulo }}</td>
        <td>{{ libros.estado }}</td>
        <td>{{ libros.id_categoria }}</td>
        <td>{{ libros.id_editorial }}</td>
        <td>{{ libros.id_genero }}</td>
        <td>{{ libros.cant_paginas }}</td>  
                    
        </tr>      
          
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
            const res=await axios.get('http://192.168.20.10/apiv1/libros');
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