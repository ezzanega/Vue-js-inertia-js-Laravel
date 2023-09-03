<template>
  <div class="flex flex-col space-y-2 text-sm">
    <div
      v-for="(moving, index) in nextMovings"
      :key="index"
      class="flex p-2 border-l-4 border-[#9291F4]"
    >
      <div class="text-left w-2/3 my-auto">
        {{ moving.title }}
      </div>
      <div class="text-right w-1/3 my-auto">
        {{ formatDate(moving.start) }}
      </div>
    </div>
    <div class="mx-auto">
      <IconButton customClass="m" @click="router.visit('/6dem/calendar', { replace: true })"  text="Voir dans l'agenda"> </IconButton>
    </div>
  </div>
</template>
  
  <script setup>
import IconButton from "@/Components/Atoms/IconButton.vue";
import { router, usePage } from "@inertiajs/vue3";
import { formatTime, formatDate } from "@/utils/index";

const nextMovings = usePage().props.nextMovings
</script>