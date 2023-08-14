<template>
  <span class="text-gray-500 text-sm cursor-pointer" @mouseover="showInfo">{{ icon }}</span>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';

const props = defineProps({
  text: String,
});

const icon = ref('ℹ️');

const showInfo = () => {
  console.log(props.text);
};
</script>
