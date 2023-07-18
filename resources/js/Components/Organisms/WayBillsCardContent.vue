<template>
  <div class="flex flex-col space-y-2">
    <div
      v-for="(invoice, index) in invoices"
      :key="index"
      class="flex p-2 border-l-4 border-[#E49292]"
    >
      <div class="text-left w-1/3 my-auto">
        {{ invoice.number }}
      </div>
      <div class="text-center w-1/3 my-auto">
        {{ invoice.client }}
      </div>
      <div class="flex justify-end w-1/3 my-auto">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-6 h-6"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>
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
  { number: "N° 8706222", client: "M. Smith" },
  { number: "N° 4506222", client: "M. Abdoul" },
  { number: "N° 9206222", client: "M. Doe" },
  { number: "N° 9306222", client: "M. Khalid" },
];
</script>