<template>
  <a
    href="#"
    class="text-white hover:bg-secondary hover:text-primary group relative flex items-center rounded-md px-2 py-3 text-md font-bold"
  >
    <slot />
    {{ item }}
    <a
      v-if="quickcreate"
      href="#"
      class="ml-auto hidden rounded-md group-hover:block hover:bg-primary hover:bg-opacity-50 hover:text-white"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        aria-hidden="true"
        class="h-6 w-6"
      ><path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M12 4.5v15m7.5-7.5h-15"
      /></svg>
    </a>
  </a>
</template>
<script setup>
  defineProps({
    item: {
      type: String,
      default: '',
    },
    quickcreate: {
      type: Boolean,
      default: false,
    },
  });

</script>