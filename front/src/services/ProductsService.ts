import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:9001/api',
  headers: {
    'Content-Type': 'application/json',
    'X-API-KEY': `clave-super-secreta`,
  }
});

export const getProducts = (page:number = 0, items: number = 0) => {
  if(page > 0 && items > 0){
    return api.get(`/products?page=${page}&per_page=${items}`)
  }else {
    return api.get(`/products`)
  }
};

export const getProductById = (id: number) => api.get(`/products/${id}`)
