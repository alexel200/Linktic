<template>
  <div class="simulate-item-shop">
    <h2>Simular Compra de Producto</h2>
    <form @submit.prevent="simulatePurchase">
      <div>
        <label for="product_id">ID del Producto:</label>
        <input type="text" v-model="product_id" id="product_id" required />
      </div>
      <div>
        <label for="quantity">Cantidad:</label>
        <input type="number" v-model.number="quantity" id="quantity" required min="1" />
      </div>
      <button type="submit">Simular Compra</button>
    </form>

    <div v-if="responseMessage" class="response">
      {{ responseMessage }}
    </div>
  </div>
</template>

<script>
import InventoryService from '@/services/InventoryService'

export default {
  name: 'SimulateItemShop',
  data() {
    return {
      product_id: '',
      quantity: 1,
      responseMessage: ''
    }
  },
  methods: {
    async simulatePurchase() {
      try {
        const response = await InventoryService.decreaseStock(this.product_id, this.quantity)
        this.responseMessage = `Stock actualizado correctamente: ${JSON.stringify(response.data)}`
      } catch (error) {
        this.responseMessage = `Error al actualizar el stock: ${error.response?.data?.message || error.message}`
      }
    }
  }
}
</script>

<style scoped>
.simulate-item-shop {
  max-width: 400px;
  margin: auto;
  padding: 1rem;
  background-color: #f4f4f4;
  border-radius: 8px;
}
form div {
  margin-bottom: 1rem;
}
label {
  display: block;
  margin-bottom: 0.5rem;
}
input {
  width: 100%;
  padding: 0.5rem;
}
button {
  padding: 0.5rem 1rem;
  background-color: darkblue;
  color: white;
  border: none;
  border-radius: 4px;
}
.response {
  margin-top: 1rem;
  font-weight: bold;
}
</style>
