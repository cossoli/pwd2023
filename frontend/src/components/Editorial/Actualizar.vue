<template>
    <h1>actualizar Editorial</h1>
  
 </template>

<script lang="ts">
 import axios from 'axios';

 
    export default{
      Data()
          { 
         return{
             editorial:{
                id:"",
                nombre:"",
                activo:1,

             },
             created(){
                this.buscar()
             }
         }     
          
      },
    
     methods:{
        
          async ActualizarEditorial(editorial){
               const res=await axios.get('http:/192.168.20.10/apiv1/editorial/'+this.$route.params, editorial)
                    this.$route.push('/ editorial')
                
           
         },
           async buscar(){
               const res=await axios.get('http:/192.168.20.10/apiv1/editorial/'+this.$route.params.id);
                    this.Socio = res.data;
                    console.log(this.editorial)
 
    }
     }
    
    }
 
</script>
<template>
<h2>Crear nuevo Editorial</h2>
<div v-if="editorial.activo ==1">
<input v-model= editorial.nombre type="text" label='nombre ' placeholder="nombre">
</div>
<button  @click = "ActualizarEditorial(editorial)"> Actualizacion</button>
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



