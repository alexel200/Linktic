<script setup lang="ts">

</script>

<template>
  <ul class="menu">
    <li><router-link to="/">Productos</router-link></li>
    <li><router-link to="/inventory">Inventario</router-link></li>
    <li><router-link to="/shop">Simular compra</router-link></li>
  </ul>
</template>

<style scoped>
.menu {
  list-style: none;
  display: flex;
  gap: 2rem;
  margin: 0;
  padding: 0;
}

.menu li {
  color: white;
  cursor: pointer;
  font-weight: bold;
  transition: color 0.3s ease;
}

.menu li:hover {
  color: lightblue;
}
</style>
