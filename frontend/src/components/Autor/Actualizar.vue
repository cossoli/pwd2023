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
        
          async ActualizarAutor(autor){
               const res=await axios.put('http:/192.168.20.10/apiv1/autor/'+this.$route.params, autor)
                    this.$route.push('/ autor')
                
           
         },
           async buscar(){
               const res=await axios.get('http:/192.168.20.10/apiv1/autor/'+this.$route.params.id);
                    this.autor = res.data;
                    console.log(this.autor)
 
    }
     }
    
    }
 
</script>
<template>
<h2>Crear nuevo Autor</h2>
<div v-if="autor.activo ==1">
<input v-model= autor.nombre_apellido type="text" label='nombre y apellido' placeholder="apellido y nombre">

</div>
<button  @click = "ActualizarAutor(Autor)"> Actualizacion</button>
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



