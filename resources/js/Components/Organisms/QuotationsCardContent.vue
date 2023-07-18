<template>
  <div class="flex flex-col space-y-2">
    <div
      v-for="(quotation, index) in quotations"
      :key="index"
      class="flex justify-between p-2 border-l-4 border-primary"
    >
      <div class="text-left my-auto">
        {{ quotation.number }}
      </div>
      <div class="text-left my-auto">
        {{ quotation.client }}
      </div>
    </div>
    <div class="mx-auto">
      <IconButton customClass="m" text="Voir Plus"> </IconButton>
    </div>
  </div>
</template>
  
  <script setup>
import IconButton from "@/Components/Atoms/IconButton.vue";

const quotations = [
  { number: "N° 8706222", client: "M. Smith" },
  { number: "N° 4506222", client: "M. Abdoul" },
  { number: "N° 9206222", client: "M. Doe" },
  { number: "N° 9306222", client: "M. Khalid" },
];
</script>