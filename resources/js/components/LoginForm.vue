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
import { ref, defineEmits } from 'vue';
import axios from 'axios';
import { useAuthStore } from '../services/authStore.js';
import { useRouter } from "vue-router";

const formData = ref({
    email: '',
    password: '',
});

const authStore = useAuthStore();
const emits = defineEmits();
const router = useRouter();

const loginUser = async () => {
    try {
        const response = await axios.post('/api/login', formData.value);
        authStore.login();
        emits('login-success'); // Emit the custom "login-success" event
        console.log(response.data);

        // Assuming the API response contains a "token" field
        const token = response.data.token;

        // Store the token in Local Storage
        localStorage.setItem('token', token);
        router.push("/");
    } catch (error) {
        console.log(error);
    }
};
</script>