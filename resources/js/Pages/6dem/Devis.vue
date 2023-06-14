<template>
  <Head title="Nouveau Devis" />
  <DemLayout>
    <SettingsBar />
    <DocumentFormLayout class="mt-5">
      <QuoteInformationForm />
    </DocumentFormLayout>
  </DemLayout>
</template>
    
<script setup>
import DemLayout from "@/Layouts/DemLayout.vue";
import { Head } from "@inertiajs/vue3";
import SettingsBar from "@/Components/Organisms/SettingsBar.vue";
import QuoteInformationForm from "@/Components/Organisms/QuoteInformationForm.vue";
import DocumentFormLayout from "@/Components/DocumentFormLayout.vue";
</script>