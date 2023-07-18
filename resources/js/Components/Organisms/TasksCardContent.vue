<template>
  <div class="flex flex-col space-y-2">
    <div class="grid grid-cols-2 gap-4">
      <div
        class="flex flex-col py-5 text-center bg-[#F4BF00] rounded-md text-white"
      >
        <div class="text-lg font-semibold">A Faire</div>
        <div class="text-sm">0</div>
      </div>
      <div
        class="flex flex-col py-5 text-center bg-[#325E5A] rounded-md text-white"
      >
        <div class="text-lg font-semibold">En cours</div>
        <div class="text-sm">0</div>
      </div>
      <div
        class="flex flex-col py-5 text-center bg-[#9291F4] rounded-md text-white"
      >
        <div class="text-lg font-semibold">Terminées</div>
        <div class="text-sm">0</div>
      </div>
      <div
        class="flex flex-col py-5 text-center bg-[#E49292] rounded-md text-white"
      >
        <div class="text-lg font-semibold">En retard</div>
        <div class="text-sm">0</div>
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