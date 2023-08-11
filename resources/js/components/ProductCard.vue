<!-- components/ProductCard.vue -->
<template>
  <div class="bg-white p-4 shadow-md">
    <img :src="imageUrl" :alt="name" class="w-full h-48 object-cover mb-4">
    <h3 class="text-lg font-bold">{{ name }}</h3>
    <p class="text-gray-500">{{ description }}</p>
    <div class="text-red-500 font-bold">{{ price }}</div>
    <button class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">Add to Cart</button>
  </div>
</template>

<script setup>
const { props } = defineProps(['imageUrl', 'name', 'description', 'price']);
</script>