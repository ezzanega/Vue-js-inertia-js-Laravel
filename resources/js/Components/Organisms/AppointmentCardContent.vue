<template>
  <div class="flex flex-col space-y-2">
    <div
      v-for="(appointment, index) in appointments"
      :key="index"
      class="flex p-2 border-l-4 border-primary"
    >
      <div class="space-y-1">
        <div class="text-sm leading-5 w-72">
          {{ appointment }}
        </div>
      </div>
    </div>
    <div class="mx-auto">
      <IconButton customClass="m" text="Voir Plus"> </IconButton>
    </div>
  </div>
</template>

<script setup>
import IconButton from "@/Components/Atoms/IconButton.vue";

const appointments = [
  "Présentation de notre nouveau produit à Société Y (test)",
  "Présentation de notre nouveau produit à Société Y (test)",
  "Présentation de notre nouveau produit à Société Y (test)",
];
</script>