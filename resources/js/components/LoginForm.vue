<template>
    <form @submit.prevent="loginUser" class="max-w-md mx-auto p-6 bg-white shadow-md rounded-lg">
        <div>
        <label class="font-semibold">Email:</label>
        <input v-model="formData.email" type="email" class="w-full border rounded-md p-2">
        </div>
        
        <div>
        <label class="font-semibold">Password:</label>
        <input v-model="formData.password" type="password" class="w-full border rounded-md p-2">
        </div>
        
        <div class="mt-4">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold p-2 rounded-md w-full">
            Login
        </button>
        </div>
    </form>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useAuthStore } from '../services/authStore.js';

const formData = ref({
    email: '',
    password: '',
});

const authStore = useAuthStore();

const loginUser = async () => {
    try {
        const response = await axios.post('/api/login', formData.value);
        authStore.login();
        console.log(response.data);
    } catch (error) {
        console.log(error.response.data);
    }
};
</script>