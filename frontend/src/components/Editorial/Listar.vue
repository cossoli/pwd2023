<template>
   <h1> Listado de Editorial</h1>
  
   <RouterLink class ="crear" to="/editorial/crear"><img src="../..assets/editar.svg" 
    alt=""/>Crear Editorial</RouterLink> 
   
<table>
    <thead>
        <tr>
            <td>id</td>
            <td>nombre</td>
            <td>acciones</td>
        </tr>
    </thead>
    <tbody>
        <tr v-for="editorial in items" :key="editorial">
        <div v-if="editorial.activo == 1"> 
        <td>{{ editorial.id }}</td>
      
        <td>{{ editorial.nombre }}</td>
      
        <tr>
         <td>

            <RouterLink :to="{name: 'ActualizarEditorial', params: {id: editorial.id}}">
            <Boton texto="editar" v-bind:class="{primary:true}"></Boton>
            </RouterLink>
         </td>  
         <td>
            <boton texto="Eliminar" v-bind:class="{warning:true}"></boton>
         </td> 
         <td>
            <boton texto="Abrir" v-bind:class="{alert:true}"></boton>
         </td> 
         </tr>  
        </div>               
        </tr>      
          
   </tbody>
</table>
</template>
  
<script lang="ts">
import axios from 'axios';
import Boton from '../Boton.vue';

   export default{

    components :{Boton},
     Data()
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
            const res=await axios.get('http://192.168.20.10/apiv1/editorial');
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