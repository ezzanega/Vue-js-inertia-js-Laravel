<template>
  <form>
    <label
      for="default-search"
      class="mb-2 text-sm font-medium text-gray-900 sr-only"
      >Search</label
    >
    <div class="relative">
      <div
        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
      >
        <svg
          class="w-4 h-4 text-gray-500 dark:text-gray-400"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 20 20"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
          />
        </svg>
      </div>
      <input
        type="search"
        id="default-search"
        :name="name"
        @input="$emit('update:modelValue', $event.target.value)"
        class="block p-4 pl-10 text-sm text-gray-900 h-12 w-full rounded-md border-tertiary bg-tertiary border-none focus:outline-none focus:ring-primary focus:border-none"
        :placeholder="placeholder"
      />
    </div>
  </form>
</template>

<script setup>
defineEmits(["update:modelValue"]);

defineProps({
  name: {
    type: String,
    default: "",
  },

  placeholder: {
    type: String,
    default: "",
  },
});
</script>
