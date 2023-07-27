<script lang="ts">
 import axios from 'axios';

 
    export default{
      Data()
          { 
        
             },
             created(){
                this.buscar()
        
          
      },
    
     methods:{
        
          async ActualizarCategoria (categoria){
               const res=await axios.put('http:/192.168.20.10/apiv1/categoria/'+this.$route.params, categoria)
                    this.$route.push('/ categoria')
                
           
         },
           async buscar(){
               const res=await axios.get('http:/192.168.20.10/apiv1/categoria/'+this.$route.params.id);
                    this.categoria = res.data;
                    console.log(this.categoria)
 
    }
     }
    
    }
 
</script>
<template>
<h2>Crear nuevo socio</h2>
<div v-if="categoria.activo ==1">

    <input v-model= categoria.nombre type="text" label='nombre' placeholder="nombre">

</div>
<button  @click = "ActualizarCategoria(categoria)"> actualizacion</button>
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



