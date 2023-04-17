<template>
  <button
    type="button"
    class="w-full py-3 flex items-center justify-center px-5 border rounded-md shadow-sm focus:outline-none text-white bg-primary space-x-2 hover:bg-opacity-90"
  >
    <!-- <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="2.2"
      stroke="currentColor"
      aria-hidden="true"
      class="pointer-events-none shrink-0 w-6 h-6"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M12 4.5v15m7.5-7.5h-15"
      />
    </svg> -->
    <span class="font-inter">{{ buttontext }}</span>
  </button>
</template>

<script setup>
  defineProps({
    buttontext: {
      type: String,
      default: '',
    },
  });

</script>