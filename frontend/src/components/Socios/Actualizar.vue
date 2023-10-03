<script lang="ts">
 import axios from 'axios';

 
    export default{
      data()
          {        

             },
             created(){
                this.buscar()
            
         },  
          
      
    
     methods:{
        
          async ActualizarSocio(Socio){
               const res = await axios.push ('http://192.168.20.10/apiv1/socios/'+this.$route.params.id, 
                   Socio);

                    this.$route.push('/ socios')
                
           
         },
           async buscar(){
               const res = await axios.get('http://192.168.20.10/apiv1/socios/'+this.$route.params.id);

                    this.Socio = res.data;
                    console.log(this.Socio)
 
    }
     }
    
    }
 
</script>
<template>
<h2>Crear nuevo socio</h2>
<div v-if="Socio.activo ==1">
<input v-model= Socio.nombre_apellido type="text" label='nombre y apellido' placeholder="apellido y nombre">
<input v-model= Socio.telefono type="text" label ='telefono' placeholder="telefono">
<input v-model = Socio.direccion type="text" label ='direccion' placeholder="direccion">
</div>
<button  @click = "ActualizarSocio(Socio)"> Actualizacion</button>
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



