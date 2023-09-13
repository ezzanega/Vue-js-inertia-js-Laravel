
<template>
  <div
    class="flex items-center rounded-lg bg-white p-4 text-gray-500 shadow"
    role="alert"
  >
        <svg class="w-5 h-5 text-blue-600 dark:text-blue-500 rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 17 8 2L9 1 1 19l8-2Zm0 0V9"/>
        </svg>
        <div class="pl-4 text-sm font-normal">{{ props.message }}</div>
    <button
      @click="emit('remove')"
      type="button"
      class="-mx-1.5 -my-1.5 ml-auto inline-flex h-8 w-8 rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300"
      data-dismiss-target="#toast-default"
      aria-label="Close"
    >
      <span class="sr-only">Close</span>
      <svg
        aria-hidden="true"
        class="h-5 w-5"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
          clip-rule="evenodd"
        ></path>
      </svg>
    </button>
  </div>
</template>

<script setup>
import { onMounted } from "vue";

const props = defineProps({
  message: String,
  duration: {
    type: Number,
    default: 2000
  }
});

onMounted(() => {
  setTimeout(() => emit("remove"), props.duration);
});

const emit = defineEmits(["remove"]);
</script>
