<script setup lang="ts">
</script>

<template>
  <ul class="menu">
    <li>
      <router-link to="/" exact-active-class="active-link">Productos</router-link>
    </li>
    <li>
      <router-link to="/inventory" exact-active-class="active-link">Inventario</router-link>
    </li>
    <li>
      <router-link to="/add-to-inventory" exact-active-class="active-link">Ingresar Producto al inventario</router-link>
    </li>
    <li>
      <router-link to="/shop" exact-active-class="active-link">Simular compra</router-link>
    </li>
  </ul>
</template>

<style scoped>
.active-link {
  color: dodgerblue;
  font-weight: bold;
  border-bottom: 2px solid dodgerblue;
}

.menu {
  list-style: none;
  display: flex;
  gap: 2rem;
  margin: 0;
  padding: 0;
}

.menu li {
  font-weight: bold;
}

.menu li a {
  color: white;
  text-decoration: none;
  transition: color 0.3s ease;
}

.menu li a:hover {
  color: dodgerblue;
}
</style>
