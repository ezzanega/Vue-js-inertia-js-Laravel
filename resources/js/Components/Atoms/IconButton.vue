<template>
  <button
    type="button"
    class="flex space-x-2 border shadow-sm rounded-md px-5 py-2 focus:outline-none hover:bg-opacity-90"
    :class="[customClass != '' ? customClass: 'text-white bg-primary']"
  >
    <slot />
    <span class="font-inter">{{ text }}</span>
  </button>
</template>

<script setup>
  defineProps({
    text: {
      type: String,
      required: true,
    },
    customClass: {
      type: String,
      default: '',
    }
  })
</script>
