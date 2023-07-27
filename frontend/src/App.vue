
<script setup lang="ts">


</script>

<template>
  
<RouterLink :to="{name:'Home'}"> Home </RouterLink> 
<RouterLink :to="{name:'Socios'}"> Socios </RouterLink> 
<RouterLink :to="{name:'Autor'}"> Autor </RouterLink> 
<RouterLink :to="{name:'Genero'}"> Genero </RouterLink> 
<RouterLink :to="{name:'Libro'}"> libro </RouterLink> 
<RouterLink :to="{name:'Prestamo'}"> Prestamo </RouterLink> 
<RouterLink :to="{name:'Categoria'}"> Categoria </RouterLink>
<RouterLink :to="{name:'Editorial'}"> Editorial </RouterLink> 


<RouterView> </RouterView>


</template>

<style scoped>

#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align:center ;
  color: #2c3050;
}

#nav {
  padding: 30px;
}

#nav a {
    font-weight: bold;
    color: #502c2f;
  }

#nav a.router-link-exact-active {
      color: #42b983;
    }

</style>
