<template>
  <div class="flex flex-col space-y-2">
    <div
      v-for="(invoice, index) in invoices"
      :key="index"
      class="flex p-2 border-l-4 border-[#F4BF00]"
    >
      <div class="text-left w-1/3 my-auto">
        {{ invoice.number }}
      </div>
      <div class="text-left w-1/3 my-auto">
        {{ invoice.client }}
      </div>
      <div class="text-left w-1/3 my-auto">
        {{ invoice.status }}
      </div>
    </div>
    <div class="mx-auto">
      <IconButton customClass="m" text="Voir Plus"> </IconButton>
    </div>
  </div>
</template>
  
  <script setup>
import IconButton from "@/Components/Atoms/IconButton.vue";

const invoices = [
  { number: "N° 8706222", client: "M. Smith", status: "Acceptée" },
  { number: "N° 4506222", client: "M. Abdoul", status: "Envoyée" },
  { number: "N° 9206222", client: "M. Doe", status: "Payée" },
  { number: "N° 9306222", client: "M. Khalid", status: "En litige" },
];
</script>