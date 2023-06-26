<template>
    <Head title="Nouvelle Lettre de voiture" />
    <DemLayout>
      <SettingsBar />
      <DocumentFormLayout class="mt-5">
        <WayBillForm />
      </DocumentFormLayout>
    </DemLayout>
  </template>
      
  <script setup>
  import DemLayout from "@/Layouts/DemLayout.vue";
  import { Head } from "@inertiajs/vue3";
  import SettingsBar from "@/Components/Organisms/SettingsBar.vue";
  import WayBillForm from "@/Components/Organisms/WayBillForm.vue";
  import DocumentFormLayout from "@/Components/DocumentFormLayout.vue";
  </script>