<template>
  <div class="w-56">
    <div class="flex items-center justify-between border-b border-neutral-200 px-4 py-3 text-sm">
      <p class="font-medium text-neutral-600">
        Création rapide
      </p><span class="rounded-md bg-neutral-700 px-1.5 text-base text-neutral-100"><span class="-mt-0.5 block">+</span></span>
    </div>
    <div class="space-y-0.5">
      <TopPopperItem item="Documents" />
      <TopPopperItem item="Documents" />
      <TopPopperItem item="Documents" />
    </div>
  </div>
</template>

<script setup>
import TopPopperItem from '@/Components/Atoms/TopPopperItem.vue';
</script>