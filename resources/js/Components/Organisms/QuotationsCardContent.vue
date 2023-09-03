<template>
  <div class="flex flex-col space-y-2 text-sm">
    <div
      v-for="(quotation, index) in quotations"
      :key="index"
      class="flex justify-between p-2 border-l-4 border-primary"
    >
      <div class="text-left my-auto">
        <span class="text-primary border-b border-dashed border-primary cursor-pointer" @click="() => router.visit(route('6dem.documents.quotation.preview', quotation.id))">
          D-{{ quotation.number }}
        </span>
      </div>
      <div class="text-left my-auto">
        {{ quotation.moving_job.client?.first_name + ' ' + quotation.moving_job.client?.last_name }}
      </div>
    </div>
    <div class="mx-auto">
      <IconButton customClass="m" @click="router.visit('/6dem/documents' + '?tab=Devis', { replace: true });" text="Voir Plus"> </IconButton>
    </div>
  </div>
</template>
  
  <script setup>
import IconButton from "@/Components/Atoms/IconButton.vue";
import { router, usePage } from "@inertiajs/vue3";

const quotations = usePage().props.quotations
</script>