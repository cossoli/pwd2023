<template>
   <h1> Listado de Categoria</h1>
  
   <RouterLink class ="crear" to="/categoria/crear"><img src="../..assets/editar.svg" 
    alt=""/>Crear Categoria</RouterLink> 
   
<table>
    <thead>
        <tr>
            <td>id</td>
            <td>nombre</td>
            <td>acciones</td>
        </tr>
    </thead>
    <tbody>
        <tr v-for="categorias in items" :key="categorias">
       
        <td>{{ categorias.id }}</td>
        <td>{{ categorias.descripcion}}</td>
        
        <tr>
         
         <td>
            <boton texto="Eliminar" v-bind:class="{warning:true}"></boton>
         </td> 
         <td>
            <boton texto="Abritr" v-bind:class="{alert:true}"></boton>
         </td> 
         </tr>  
            
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
            const res=await axios.get('http://192.168.20.10/apiv1/categorias');
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