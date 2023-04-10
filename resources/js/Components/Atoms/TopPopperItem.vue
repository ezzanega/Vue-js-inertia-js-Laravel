<template>
  <a
    href="#"
    class="group px-4 py-2 text-sm group flex items-center text-neutral-700 hover:bg-secondary hover:text-neutral-900"
  >
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
      aria-hidden="true"
      class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600"
    ><path
      stroke-linecap="round"
      stroke-linejoin="round"
      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
    /></svg>
    <span class="inline-flex w-full items-center justify-between">
      <span>{{ item }}</span>
    </span>
  </a>
</template>

<script setup>
  defineProps({
    item: {
      type: String,
      default: '',
    },
  });

</script>