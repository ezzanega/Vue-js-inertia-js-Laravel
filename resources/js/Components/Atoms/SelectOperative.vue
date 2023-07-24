<template>
    <v-select taggable v-model="selected" label="title" :options="options" :create-option="operative => ({ title: operative })" push-tags
      placeholder="Société exécutante :" class="border-none">
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

  const emit = defineEmits(["savingOperative"]);
  const selected = ref();
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