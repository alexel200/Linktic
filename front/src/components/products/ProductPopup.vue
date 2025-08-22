<template>
  <div v-if="visible" class="popup-overlay" @click.self="onClose">
    <div class="popup-content">
      <img :src="image" alt="Imagen del producto" class="popup-imagen" />
      <h2>{{ product?.name }}</h2>
      <p><strong>Name:</strong> {{ product?.name }}</p>
      <p><strong>Descripción:</strong> {{ product?.description }}</p>
      <p><strong>Precio:</strong> {{ product?.price }} €</p>
      <p><strong>Stock:</strong> {{ product?.stock }}</p>
      <p><strong>ID:</strong> {{ product?.id }}</p>
      <button @click="onClose">Cerrar</button>
    </div>
  </div>
</template>

<script setup lang="ts">
import type { Product } from '@/interfaces/Product'
defineProps<{
  product: Product | null
  visible: boolean
  image: string
}>()

const emit = defineEmits(['close'])

const onClose = () => {
  emit('close')
}
</script>

<style scoped>
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.popup-content {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  width: 90%;
  max-width: 580px;
}
</style>
