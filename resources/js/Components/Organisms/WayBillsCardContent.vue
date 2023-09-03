<template>
  <div class="flex flex-col space-y-2 text-sm">
    <div
      v-for="(waybill, index) in waybills"
      :key="index"
      class="flex p-2 border-l-4 border-[#E49292]"
    >
      <div class="text-left w-1/3 my-auto">
        <span class="text-primary border-b border-dashed border-primary cursor-pointer" @click="() => router.visit(route('6dem.documents.waybill.preview', waybill.id))">
          LV-{{ waybill.number }}
        </span>
      </div>
      <div class="text-center w-1/3 my-auto">
        {{ waybill.moving_job.client?.first_name + ' ' + waybill.moving_job.client?.last_name }}
      </div>
      <div class="flex justify-end w-1/3 my-auto">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-6 h-6 cursor-pointer"
          @click="downloadWaybill(waybill.id)"
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
      <IconButton customClass="m" @click="router.visit('/6dem/documents' + '?tab=Lettres de voiture', { replace: true })" text="Voir Plus"> </IconButton>
    </div>
  </div>
</template>

  <script setup>
import IconButton from "@/Components/Atoms/IconButton.vue";
import { router, usePage } from "@inertiajs/vue3";

const waybills = usePage().props.waybills
const downloadWaybill = (id) => {
  window.location.href = route("6dem.waybill.download", [id])
};
</script>
