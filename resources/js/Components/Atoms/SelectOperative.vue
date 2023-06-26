<template>
    <v-select taggable label="title" :options="options" :create-option="operative => ({ title: operative })" push-tags
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