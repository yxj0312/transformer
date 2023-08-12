<template>
  <Modal :isOpen="isOpen" title="Login" @close="close">
    <!-- Your login form content here -->
  </Modal>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';
import Modal from './Modal.vue'; // Import the Modal component

const props = defineProps({
  isOpen: Boolean,
});

const emits = defineEmits();

const close = () => {
  emits('close');
};

// Other login logic here
</script>