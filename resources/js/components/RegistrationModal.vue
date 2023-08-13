<template>
  <Modal :isOpen="isOpen" title="Register" @close="close">
    <!-- Registration form content -->
    <RegistrationForm />
  </Modal>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';
import Modal from './Modal.vue'; // Import the Modal component
import RegistrationForm from './RegistrationForm.vue';

const props = defineProps({
  isOpen: Boolean,
});

const emits = defineEmits();

const close = () => {
  emits('close');
};

// Other login logic here
</script>