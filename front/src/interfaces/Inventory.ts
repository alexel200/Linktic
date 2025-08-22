import type { Product } from '@/interfaces/Product.ts'


export interface Inventory {
  id: number
  product_id: number
  quantity: number
  product: Product
}
