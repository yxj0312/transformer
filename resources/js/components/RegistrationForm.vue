<template>
  <form @submit.prevent="registerUser" class="max-w-md mx-auto p-6 bg-white shadow-md rounded-md">
    <h2 class="text-2xl font-semibold mb-4">Register</h2>
    
    <label class="block mb-2">
      Name:
      <input v-model="formData.name" type="text" class="w-full border rounded-md p-2">
    </label>
    
    <label class="block mb-2">
      Email:
      <input v-model="formData.email" type="email" class="w-full border rounded-md p-2">
    </label>
    
    <label class="block mb-2">
      Password:
      <input v-model="formData.password" type="password" class="w-full border rounded-md p-2">
    </label>
    
    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md">Register</button>
  </form>
</template>

<script setup>
import { ref } from 'vue';
// import axios from 'axios';

const formData = ref({
  name: '',
  email: '',
  password: '',
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
