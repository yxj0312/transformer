<template>
  <form @submit.prevent="registerUser" class="max-w-md mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Register</h2>
    
    <label class="block mb-4">
      Name:
      <input v-model="formData.name" class="w-full border rounded-md p-2">
    </label>
    
    <label class="block mb-4">
      Email:
      <input v-model="formData.email" type="email" class="w-full border rounded-md p-2">
    </label>
    
    <label class="block mb-4">
      Password:
      <input v-model="formData.password" type="password" class="w-full border rounded-md p-2">
    </label>
    
    <label class="block mb-4">
      Role:
      <select v-model="formData.role_id" class="w-full border rounded-md p-2">
        <option value="admin">Admin</option>
        <option value="customer">Customer</option>
        <option value="vendor">Vendor</option>
      </select>
    </label>
    
    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Register</button>
  </form>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const formData = ref({
  name: '',
  email: '',
  password: '',
  role_id: '',
});

const registerUser = async () => {
  try {
    const response = await axios.post('/register', formData.value);
    console.log('User registered:', response.data);
    // You can handle the response here, e.g., show a success message
  } catch (error) {
    console.error('Registration failed:', error.response.data);
    // You can handle the error here, e.g., show an error message
  }
};
</script>