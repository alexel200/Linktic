<script setup lang="ts">

import MenuComponent from '@/components/shared/MenuComponent.vue'
</script>

<template>
  <div class="header">
    <h1>Prueba Técnica</h1>
    <MenuComponent />
  </div>
</template>

<style scoped>
.header {
  width: 100%;
  height: 5vh;
  background-color: darkblue;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 2rem;
  box-sizing: border-box;
}

h1{
  color: white;
  font-size: 1.2rem;
  margin: 0;
}
</style>
