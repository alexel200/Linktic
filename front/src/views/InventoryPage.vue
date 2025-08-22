<template>
  <div class="inventory-page">
    <h1 class="header">Inventario</h1>
    <div class="inventory-grid">
      <details v-for="item in inventory" :key="item.id" class="inventory-accordion">
        <summary>
          <div class="summary-content">
            <strong>
              <a href="#" @click.prevent="openPopup(item.product)">
                {{ item.product.name }}
              </a>
            </strong>
            <span>Cantidad: {{ item.quantity }}</span>
          </div>
        </summary>
        <div class="accordion-details">
          <p><strong>ID Inventario:</strong> {{ item.id }}</p>
          <p><strong>Stock:</strong> {{ item.product.stock }}</p>
          <p><strong>Precio:</strong> €{{ item.product.price.toFixed(2) }}</p>
          <p><strong>Descripción:</strong> {{ item.product.description }}</p>
        </div>
      </details>
    </div>


    <ProductPopup
      :product="selectedProduct"
      :visible="showPopup"
      :image="shopImage"
      @close="closePopup"
    />
  </div>
</template>


<script lang="ts" setup>
import { ref, onMounted } from 'vue'
import { getInventory } from '@/services/InventoryService'
import type { Inventory } from '@/interfaces/Inventory'
import ProductPopup from '@/components/products/ProductPopup.vue'
import shopImage from '@/assets/shop.png'
import type { Product } from '@/interfaces/Product'

const selectedProduct = ref<Product | null>(null)
const showPopup = ref(false)

const openPopup = (product: Product) => {
  selectedProduct.value = product
  showPopup.value = true
}

const closePopup = () => {
  selectedProduct.value = null
  showPopup.value = false
}

const inventory = ref<Inventory[]>([])


onMounted(async () => {
  try {
    const response = await getInventory()
    inventory.value = response.data.data
  } catch (error) {
    console.error('Error al obtener el inventario:', error)
  }
})
</script>

<style scoped>
.inventory-page {
  padding: 1rem;
}

.header {
  font-size: 1.8rem;
  padding: 1rem;
  border-radius: 8px;
  text-align: center;
  margin-bottom: 1rem;
}

.inventory-grid {
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  gap: 1rem;
}

@media (min-width: 768px) {
  .inventory-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (min-width: 1024px) {
  .inventory-grid {
    grid-template-columns: repeat(4, 1fr);
  }
}

.inventory-accordion {
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 0.5rem;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

summary {
  cursor: pointer;
  list-style: none;
  outline: none;
}

.summary-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.accordion-details {
  margin-top: 0.5rem;
  font-size: 0.9rem;
}
</style>
