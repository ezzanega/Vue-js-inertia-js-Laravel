<template>
    <v-select taggable v-model="selected" :options="options"
      placeholder="Type de facture" class="border-none" @focusout="$emit('savingInvoiceType', selected)">
      <template v-slot:no-options="{ search, searching }">
        <template v-if="searching">
          Aucun résultat trouvé pour <em>{{ search }}.</em>.
        </template>
        <em v-else style="opacity: 0.5">Saisissez pour chercher</em>
      </template>
    </v-select>
  </template>
  
  <script setup>
  import vSelect from 'vue-select';
  import { usePage } from "@inertiajs/vue3";
  import { ref } from "vue";
  
  const emit = defineEmits(["savingInvoiceType"]);
  const currentInvoice = usePage().props.invoice;
  const selected = ref(currentInvoice.type ? currentInvoice.type:"Type de facture");
  const options = [
    "Acompte",
    "Solde"
  ];
  </script>