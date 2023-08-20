<template>
  <Modal :isOpen="isOpen" title="Login" @close="close">
    <LoginForm />
  </Modal>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';
import Modal from './Modal.vue'; // Import the Modal component
import LoginForm from './LoginForm.vue'; // Import the LoginForm component

const props = defineProps({
  isOpen: Boolean,
});

const emits = defineEmits();

const close = () => {
  emits('close');
};

// Other login logic here
</script>