<template>
  <nav class="bg-blue-500 p-4">
    <div class="container mx-auto flex items-center justify-between">
      <div class="text-white text-2xl font-bold">Logo</div>
      <div class="flex space-x-4">
        <a href="#" class="text-white">Home</a>
        <a href="#" class="text-white">Products</a>
        <a href="#" class="text-white">About Us</a>
        <a href="#" class="text-white">Contact</a>
        <!-- User Registration Button -->
        <button class="text-white" @click="showRegistrationModal">Register</button>
        <!-- User Login Button -->
        <button class="text-white" @click="showLoginModal">Login</button>
      </div>
    </div>
  </nav>
</template>

<script setup>
const showRegistrationModal = () => {
  // Your logic for showing the registration modal
};

const showLoginModal = () => {
  // Your logic for showing the login modal
};
</script>