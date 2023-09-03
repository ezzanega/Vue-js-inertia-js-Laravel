<template>
  <div class="flex flex-col space-y-2 text-sm">
    <div
      v-for="(invoice, index) in invoices"
      :key="index"
      class="flex p-2 border-l-4 border-[#F4BF00]"
    >
      <div class="text-left w-1/3 my-auto">
        <span class="text-primary border-b border-dashed border-primary cursor-pointer" @click="() => router.visit(route('6dem.documents.invoice.preview', invoice.id))">
          F-{{ invoice.number }}
        </span>
      </div>
      <div class="text-left w-1/3 my-auto">
        {{ invoice.moving_job.client?.first_name + ' ' + invoice.moving_job.client?.last_name }}
      </div>
      <div class="text-left w-1/3 my-auto">
        {{ invoice.status }}
      </div>
    </div>
    <div class="mx-auto">
      <IconButton customClass="m" @click="router.visit('/6dem/documents' + '?tab=Factures', { replace: true })" text="Voir Plus"> </IconButton>
    </div>
  </div>
</template>
  
  <script setup>
import IconButton from "@/Components/Atoms/IconButton.vue";

import { router, usePage } from "@inertiajs/vue3";
const invoices = usePage().props.invoices
</script>