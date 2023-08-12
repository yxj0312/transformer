<template>
  <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-8 rounded-md shadow-md">
      <h2 class="text-xl font-semibold">{{ title }}</h2>
      <button class="absolute top-4 right-4 text-gray-500" @click="close">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 8.586L15.293 3.293a1 1 0 111.414 1.414L11.414 10l5.293 5.293a1 1 0 11-1.414 1.414L10 11.414l-5.293 5.293a1 1 0 11-1.414-1.414L8.586 10 3.293 4.707a1 1 0 111.414-1.414L10 8.586z" clip-rule="evenodd" />
        </svg>
      </button>
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
