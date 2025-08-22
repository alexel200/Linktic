<script setup lang="ts">
import type { Product } from '@/interfaces/Product'
import shopImage from '@/assets/shop.png'

defineProps<Product>()
</script>

<template>
  <div class="product-card">
    <img :src="shopImage" alt="Imagen del producto" class="product-imagen" />
    <h3 @click="$emit('show-details', id)" class="product-name clickable">{{ name }}</h3>
    <p>{{ description }}</p>
    <p><strong>Precio:</strong> {{ price }} €</p>
    <p><strong>Stock:</strong> {{ stock }}</p>
  </div>
</template>



<style scoped>
.product-card {
  width: 80%;
  background: #f9f9f9;
  border-radius: 8px;
  padding: 1rem;
  margin-bottom: 1rem;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
}

.product-imagen {
  width: 100%;
  max-width: 150px;
  height: auto;
  border-radius: 8px;
  margin-bottom: 1rem;
  object-fit: cover;
}
.clickable {
  cursor: pointer;
  color: darkblue;
  text-decoration: underline;
}
</style>
