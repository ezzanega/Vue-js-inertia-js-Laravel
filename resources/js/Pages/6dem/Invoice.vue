<template>
  <Head title="Nouvelle facture" />
  <DemLayout>
    <SettingsBar />
    <DocumentFormLayout class="mt-5">
      <InvoiceForm />
    </DocumentFormLayout>
  </DemLayout>
</template>
      
  <script setup>
import DemLayout from "@/Layouts/DemLayout.vue";
import { Head } from "@inertiajs/vue3";
import SettingsBar from "@/Components/Organisms/SettingsBar.vue";
import InvoiceForm from "@/Components/Organisms/InvoiceForm.vue";
import DocumentFormLayout from "@/Components/DocumentFormLayout.vue";
</script>