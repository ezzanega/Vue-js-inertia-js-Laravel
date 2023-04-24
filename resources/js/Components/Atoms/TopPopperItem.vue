<template>
  <a
    href="#"
    class="group px-4 py-2 text-sm group flex items-center text-neutral-700 hover:bg-secondary hover:text-neutral-900"
    @click="$emit('clicked')"
  >
    <slot />
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