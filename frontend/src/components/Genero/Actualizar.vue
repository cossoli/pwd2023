<script lang="ts">
 import axios from 'axios';

 
    export default{
      Data(){
        
             },
             created(){
                this.buscar()
             },
    
     methods:{
        
          async ActualizarGenero(genero){
               const res=await axios.put('http:/192.168.20.10/apiv1/genero/'+this.$route.params, genero)
                    this.$route.push('/ genero')
                
           
         },
           async buscar(){
               const res=await axios.get('http:/192.168.20.10/apiv1/genero/'+this.$route.params.id);
                    this.genero = res.data;
                    console.log(this.genero)
 
    }
     }
    
    }
 
</script>
<template>
<h2>Crear nuevo genero</h2>
<div v-if="genero.activo ==1">
<input v-model= genero.descripcion type="text" label='descripcion' placeholder="descripcion">

</div>
<button  @click = "ActualizarGenero(genero)"> Actualizacion</button>
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



