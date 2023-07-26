<template>
    <div class="overflow-hidden space-y-2">
      <SearchBar
        name="document"
        class="shrink mt-1 mx-1 w-1/3"
        placeholder="Recherchez un numéro de document"
      />
      <div
        class="w-full rounded-xl bg-white text-left text-sm px-6 py-4 font-medium text-gray-900 flex justify-between border-b border-gray-200"
      >
        <div class="w-1/12"></div>
        <div class="w-3/12">N° Lettre de voiture</div>
        <div class="w-3/12">Client</div>
        <div class="w-2/12">Statut</div>
        <div class="w-2/12">Type de déménagement</div>
        <div class="w-2/12">Date de déménagement</div>
        <div class="w-1/12"></div>
      </div>
  
      <WaybillListItem
        v-for="(document, index) in $page.props.waybills"
        :key="index"
        :document="document"
      />
    </div>
  </template>
    
    <script setup>
  import WaybillListItem from "@/Components/Molecules/WaybillListItem.vue";
  import SearchBar from "@/Components/Atoms/SearchBar.vue";
  </script>
    