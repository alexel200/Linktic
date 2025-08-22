import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:9001/api',
  headers: {
    'Content-Type': 'application/json',
    'X-API-KEY': `clave-super-secreta`,
  }
});

export const getProducts = () => api.get('/products');

export const getProductById = (id: number) => api.get(`/products/${id}`)
