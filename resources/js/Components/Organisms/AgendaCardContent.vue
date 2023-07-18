<template>
  <div class="flex flex-col space-y-2">
    <div
      v-for="(activity, index) in activities"
      :key="index"
      class="flex p-2 border-l-4 border-[#9291F4]"
    >
      <div class="text-left w-1/3 my-auto">
        {{ activity.number }}
      </div>
      <div class="text-left w-1/3 my-auto">
        {{ activity.client }}
      </div>
      <div class="text-left w-1/3 my-auto">
        {{ activity.date }}
      </div>
    </div>
    <div class="mx-auto">
      <IconButton customClass="m" text="Voir Plus"> </IconButton>
    </div>
  </div>
</template>
  
  <script setup>
import IconButton from "@/Components/Atoms/IconButton.vue";

const activities = [
  { number: "N° 8706222", client: "M. Smith", date: "11/07/2023" },
  { number: "N° 4506222", client: "M. Abdoul", date: "13/07/2023" },
  { number: "N° 9206222", client: "M. Doe", date: "13/07/2023" },
  { number: "N° 9306222", client: "M. Khalid", date: "13/07/2023" },
];
</script>