<template>
  <div>
    <label
      class="flex justify-center h-32 px-4 transition bg-white border-2 border-secondary border-dashed rounded-md appearance-none cursor-pointer hover:border-primary focus:outline-none"
    >
      <span class="flex flex-col items-center text-center space-y-2 my-auto">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="w-8 h-8 text-gray-400"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
          />
        </svg>
        <span class="text-xs text-gray-400">
          {{ label }}
        </span>
      </span>
      <input type="file" :name="name" class="hidden" />
    </label>
  </div>
</template>

<script setup>
defineProps({
  name: {
    type: String,
    default: "",
  },

  label: {
    type: String,
    default: "",
  },
});
</script>