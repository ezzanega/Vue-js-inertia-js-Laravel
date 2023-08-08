<template>
    <v-select taggable v-model="selected" label="name" :options="executingCompanies" :create-option="executingCompany => ({ name: executingCompany })" push-tags
      placeholder="Société exécutante :" class="border-none" @focusout="$emit('savingExecutingCompany', selected)">
      <template v-slot:no-options="{ search, searching }">
        <template v-if="searching">
          Aucun résultat trouvé pour <em>{{ search }}.</em>.
        </template>
        <em v-else style="opacity: 0.5">Saisissez pour chercher/créer un exécutant.</em>
      </template>
    </v-select>
  </template>
  
  <script setup>
  import vSelect from 'vue-select';
  import { usePage } from "@inertiajs/vue3";
  import { ref } from "vue";

  const emit = defineEmits(["savingExecutingCompany"]);
  const currentWaybill = usePage().props.waybill;
  const executingCompanies = usePage().props.executingCompanies;

  const selected = ref(currentWaybill.executing_company.name);
  const options = [
    {
      title: "L'agence du déménagement"
    },
    {
      title: "La super agence du déménagement"
    },
    {
      title: "L'incroyable agence de déménagement"
    }
  ];
  </script>