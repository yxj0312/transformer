<template>
  <form @submit.prevent="registerUser" class="max-w-md mx-auto p-6 bg-white shadow-md rounded-lg">
     <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="font-semibold">Name:</label>
        <input v-model="formData.name" class="w-full border rounded-md p-2">
      </div>
      
      <div>
        <label class="font-semibold">Email:</label>
        <input v-model="formData.email" type="email" class="w-full border rounded-md p-2">
      </div>
    </div>
    
    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="font-semibold">Password:</label>
        <input v-model="formData.password" type="password" class="w-full border rounded-md p-2">
      </div>
      
    <div>
      <label class="font-semibold">Role:</label>
      <select v-model="formData.role_id" class="w-full border rounded-md p-2">
        <option value="1">Admin</option>
        <option value="2">Customer</option>
        <option value="3">Vendor</option>
      </select>
    </div>
    </div>
    
    <div>
      <label class="font-semibold">Date of Birth:</label>
      <div class="relative">
        <input v-model="formData.date_of_birth" type="date" class="w-full border rounded-md p-2">
        <info-icon text="Your date of birth" class="absolute top-0 right-0" />
      </div>
    </div>
    
    <div>
      <label class="font-semibold">First Name:</label>
      <div class="relative">
        <input v-model="formData.first_name" class="w-full border rounded-md p-2">
        <info-icon text="Your first name" class="absolute top-0 right-0" />
      </div>
    </div>
    
    <div>
      <label class="font-semibold">Last Name:</label>
      <div class="relative">
        <input v-model="formData.last_name" class="w-full border rounded-md p-2">
        <info-icon text="Your last name" class="absolute top-0 right-0" />
      </div>
    </div>
    
    <div>
      <label class="font-semibold">Phone:</label>
      <div class="relative">
        <input v-model="formData.phone" class="w-full border rounded-md p-2">
        <info-icon text="Your phone number" class="absolute top-0 right-0" />
      </div>
    </div>
    
    <button type="submit" class="mt-10 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Register</button>
  </form>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import InfoIcon from './InfoIcon.vue';

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