<template>
  
    <!-- Use the Navbar component -->
    <Navbar />

    <!-- Use the HeroSection component -->
    <HeroSection />

    <!-- Featured Products -->
    <section class="py-16">
      <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-8">Featured Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
          <!-- Use the ProductCard component -->
          <ProductCard
            v-for="product in featuredProducts"
            :key="product.id"
            :image-url="product.imageUrl"
            :name="product.name"
            :description="product.description"
            :price="product.price"
          />
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
      <div class="container mx-auto text-center">&copy; 2023 Online Store. All rights reserved.</div>
    </footer>
</template>

<script setup>
import { defineProps, ref } from 'vue';

import Navbar from '../components/Navbar.vue';
import HeroSection from '../components/HeroSection.vue';
import ProductCard from '../components/ProductCard.vue';

const featuredProducts = ref([
  {
    id: 1,
    imageUrl: 'product1.jpg',
    name: 'Product 1',
    description: 'Description of Product 1',
    price: '$19.99',
  },
  // Add more products here
]);
</script>

<style>
/* Your styles here */
</style>