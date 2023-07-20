
<script setup lang="ts">


</script>

<template>
  
<RouterLink :to="{name:'Home'}"> Home </RouterLink> 
<RouterLink :to="{name:'AcercaDe'}"> AcercaDe </RouterLink> 
<RouterLink :to="{name:'Socios'}"> Socios </RouterLink> 
<RouterLink :to="{name:'Autor'}"> Autor </RouterLink> 
<RouterLink :to="{name:'Genero'}"> Genero </RouterLink> 
<RouterLink :to="{name:'Editorial'}"> Editorial </RouterLink> 
<RouterLink :to="{name:'Categoria'}"> Categoria </RouterLink>
<RouterLink :to="{name:'libro'}"> libro </RouterLink> 
<RouterLink :to="{name:'Prestamo'}"> Prestamo </RouterLink> 

<RouterView></RouterView>


</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}

</style>
