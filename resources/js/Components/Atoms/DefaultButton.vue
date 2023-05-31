<template>
  <button
    type="button"
    class="w-full py-3 flex items-center justify-center px-5 border rounded-md shadow-sm focus:outline-none text-white bg-primary space-x-2 hover:bg-opacity-90"
  >
    <slot></slot>
    <span class="font-inter">{{ buttontext }}</span>
  </button>
</template>

<script setup>
defineProps({
  buttontext: {
    type: String,
    default: "",
  },
});
</script>