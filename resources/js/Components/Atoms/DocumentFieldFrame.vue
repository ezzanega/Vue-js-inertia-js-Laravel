<template>
  <div class="relative w-full flex items-center">
    <div class="p-1 border border-gray-200 rounded-md bg-gray-100 flex-grow">
      <slot />
    </div>
    <div v-if="removable" class="relative flex items-center justify-center">
      <button
        class="absolute top-1/2 right-0 transform translate-x-1/2 -translate-y-1/2 bg-red-200 rounded-full p-0.5 text-red-500 hover:text-red-700"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-4 w-4"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"
          ></path>
        </svg>
      </button>
    </div>
  </div>
</template>
  
  <script setup>
const props = defineProps({
  removable: {
    type: Boolean,
    default: false,
  },
});
</script>
  