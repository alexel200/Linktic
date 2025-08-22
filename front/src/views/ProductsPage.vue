<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import { getProducts, getProductById } from '@/services/ProductsService'
import ProductCard from '@/components/products/ProductCard.vue'
import ProductPopup from '@/components/products/ProductPopup.vue'

import shopImage from '@/assets/shop.png'
import type { Product } from '@/interfaces/Product'

const products = ref<Product[]>([])
const currentPage = ref(1)
const itemsPerPage = 12
const totalPages = ref(1)

const selectedProduct = ref<Product | null>(null)
const showPopup = ref(false)

const fetchProducts = async (page: number = 1) => {
  try {
    const response = await getProducts(page, itemsPerPage)
    products.value = response.data.data
    currentPage.value = response.data.current_page
    totalPages.value = response.data.last_page
  } catch (error) {
    console.error('Error al obtener productos:', error)
  }
}

const showProductDetails = async (id: number) => {
  try {
    const response = await getProductById(id)
    selectedProduct.value = JSON.parse(response.data.data)
    showPopup.value = true
  } catch (error) {
    console.error('Error al obtener detalle del producto:', error)
  }
}

const cerrarPopup = () => {
  showPopup.value = false
  selectedProduct.value = null
}

const goToPage = (page: number) => {
  if (page >= 1 && page <= totalPages.value) {
    fetchProducts(page)
  }
}

onMounted(() => fetchProducts())
</script>


<template>
  <div class="products-container">
    <!-- Grid de productos -->
    <div class="products-grid">
      <ProductCard
        v-for="product in products"
        :key="product.id"
        v-bind="product"
        @show-details="showProductDetails"
      />
    </div>

    <!-- Paginación -->
    <div class="pagination">
      <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1">
        Anterior
      </button>
      <span>Página {{ currentPage }} de {{ totalPages }}</span>
      <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages">
        Siguiente
      </button>
    </div>

    <!-- Popup de detalle -->
    <ProductPopup
      :product="selectedProduct"
      :visible="showPopup"
      :image="shopImage"
      @close="cerrarPopup"
    />
  </div>
</template>



<style scoped>
.products-container {
  padding: 2rem;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 1.5rem;
  justify-items: center;
}

.pagination {
  display: flex;
  gap: 1rem;
  align-items: center;
  justify-content: center;
  margin-top: 2rem;
}

.pagination button {
  padding: 0.5rem 1rem;
  background-color: darkblue;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.pagination button:disabled {
  background-color: gray;
  cursor: not-allowed;
}

</style>

