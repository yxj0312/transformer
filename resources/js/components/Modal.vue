<template>
  <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
      <div class="flex justify-end">
        <button @click="closeModal" class="text-gray-500 hover:text-gray-700">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      <h2 class="text-2xl font-semibold mb-4">{{ title }}</h2>
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';

const props = defineProps({
  isOpen: Boolean,
  title: String,
});

const emits = defineEmits();

const close = () => {
  emits('close');
};
</script>

<style scoped>
/* Add your custom modal styles here */
</style>
