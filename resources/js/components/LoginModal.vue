<template>
  <Modal :isOpen="isOpen" title="Login">
    <LoginForm @login-success="handleLoginSuccess"/>
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

// const close = () => {
//   emits('close');
// };

const handleLoginSuccess = () => {
  console.log('Login successful');
  emits('close'); 
  // close(); // Close the login modal
  // Redirect to the homepage, you may need to use Vue Router or another method for this
};
// Other login logic here
</script>