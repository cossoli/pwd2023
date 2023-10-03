
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
        
          async ActualizarPrestamo(prestamo){
               const res=await axios.put('http://192.168.20.10/apiv1/prestamo/'+this.$route.params,prestamo)
                    this.$route.push('/socios')
                
           
         },
           async buscar(){
               const res=await axios.get('http://192.168.20.10/apiv1/prestamo/'+this.$route.params.id);
                    this.prestamo = res.data;
                    console.log(this.prestamo)
 
    }
     }
    
    }
 
</script>
<template>
<h2>Crear nuevo socio</h2>
<div v-if="Socio.activo ==1">
<input v-model= socio.nombre_apellido type="text" label='nombre y apellido' placeholder="apellido y nombre">
<input v-model= socio.telefono type="text" label ='telefono' placeholder="telefono">
<input v-model = socio.direccion type="text" label ='direccion' placeholder="direccion">
</div>
<button  @click = "ActualizarPrestamo(prestamo)"> Actualizacion</button>
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



