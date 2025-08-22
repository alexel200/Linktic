import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:9000/api',
  headers: {
    'Content-Type': 'application/json'
  }
});

export const getInventory = () => api.get('/inventory');


export const addProductToInventory = (productId: number, quantity: number) => {
  return api.post('/inventory/add-product', {
    product_id: productId,
    quantity: quantity
  });
};
