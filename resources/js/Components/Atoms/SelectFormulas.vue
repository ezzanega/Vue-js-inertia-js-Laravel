<template>
  <v-select taggable label="title" :options="options" :create-option="formula => ({ title: formula, price: 0 })" push-tags
    placeholder="Formule" class="border-none">
    <template v-slot:no-options="{ search, searching }">
      <template v-if="searching">
        Aucun résultat trouvé pour <em>{{ search }}.</em>.
      </template>
      <em v-else style="opacity: 0.5">Saisissez pour chercher/créer une formule.</em>
    </template>
  </v-select>
</template>

<script setup>
import vSelect from 'vue-select';
const options = [
  {
    title: "Standard",
    price: 0
  },
  {
    title: "Silver",
    price: 0
  },
  {
    title: "Gold",
    price: 0
  },
  {
    title: "Platine",
    price: 0
  }
];
</script>