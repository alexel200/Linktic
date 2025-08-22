<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { addProductToInventory } from '@/services/InventoryService'


const router = useRouter()

const productId = ref<number>(0)
const quantity = ref<number>(0)

const handleSubmit = async () => {
  try {
    await addProductToInventory(productId.value, quantity.value)
    alert('Producto agregado exitosamente al inventario.')
    await router.push('/inventory')
  } catch (error: any) {
    alert(error.response?.data?.message || 'Error al agregar el producto.')
    console.error(error)
  }
}
</script>

<template>
  <div class="add-product">
    <h2>Agregar producto al inventario</h2>
    <form @submit.prevent="handleSubmit">
      <label>
        ID del producto:
        <input type="number" v-model="productId" required />
      </label>
      <label>
        Cantidad:
        <input type="number" v-model="quantity" required />
      </label>
      <button type="submit">Agregar</button>
    </form>
  </div>
</template>

<style scoped>
.add-product {
  color: black;
  padding: 1rem;
  background-color: #f9f9f9;
  border-radius: 8px;
  max-width: 400px;
  margin: 0 auto;
  top: 3vh;
}

input {
  margin: 0.5rem 0;
  padding: 0.4rem;
  width: 100%;
  box-sizing: border-box;
}

button {
  background-color: dodgerblue;
  color: white;
  border: none;
  padding: 0.6rem 1rem;
  cursor: pointer;
  margin-top: 1rem;
}

button:hover {
  background-color: #1e90ff;
}
</style>
