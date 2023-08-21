<template>
  <nav class="bg-blue-500 p-4 relative">
    <div class="container mx-auto flex items-center justify-between">
      <div class="text-white text-2xl font-bold">Logo</div>
      <div class="flex space-x-4">
        <a href="#" class="text-white">Home</a>
        <a href="#" class="text-white">Products</a>
        <a href="#" class="text-white">About Us</a>
        <a href="#" class="text-white">Contact</a>
        
        <!-- Profile Icon -->
        <div v-if="$store.state.auth.isLoggedIn" class="text-white cursor-pointer" @click="openProfile">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <!-- Your profile icon SVG code here -->
          </svg>
        </div>
        
        <!-- User Registration Button -->
        <button class="text-white" @click="showRegistrationModal" v-if="!$store.state.auth.isLoggedIn">Register</button>
        
        <!-- User Login Button -->
        <button class="text-white" @click="showLoginModal" v-if="!$store.state.auth.isLoggedIn">Login</button>
      </div>
    </div>
  </nav>

  <!-- Registration Modal -->
  <RegistrationModal :isOpen="isRegistrationModalVisible" @close="closeRegistrationModal" />

  <!-- Login Modal -->
  <LoginModal :isOpen="isLoginModalVisible" @close="closeLoginModal" />
</template>

<script setup>
import { ref } from 'vue';
import RegistrationModal from './RegistrationModal.vue';
import LoginModal from './LoginModal.vue';

const isRegistrationModalVisible = ref(false);
const isLoginModalVisible = ref(false);
const isLoggedIn = ref(false);

const showRegistrationModal = () => {
  isRegistrationModalVisible.value = true;
};

const closeRegistrationModal = () => {
  isRegistrationModalVisible.value = false;
};

const showLoginModal = () => {
  isLoginModalVisible.value = true;
};

const closeLoginModal = () => {
  isLoginModalVisible.value = false;
};

// Your API call functions for registration and login
// Call these functions inside the corresponding modal functions
// For example, after a successful registration, close the registration modal and show a success message
// Similarly, after successful login, close the login modal and perform further actions
</script>