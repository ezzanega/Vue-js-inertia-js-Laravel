<template>
  <div class="overflow-hidden space-y-4">
    <SearchBar
      name="client"
      class="shrink mt-1 mx-1 w-1/3"
      placeholder="Recherchez un nom de client"
    />
    <div
      class="w-full rounded-xl bg-white text-left text-sm px-6 py-4 font-medium text-gray-900 flex justify-between border-b border-gray-200"
    >
      <div class="w-1/12"></div>
      <div class="w-3/12">Nom</div>
      <div class="w-3/12">Télephone</div>
      <div class="w-3/12">Type de client</div>
      <div class="w-1/12">Source</div>
      <div class="w-1/12"></div>
    </div>

    <ClientListItem
      v-for="(client, index) in $page.props.clients"
      :key="index"
      :client="client"
    />
  </div>
</template>

<script setup>
import ClientListItem from "@/Components/Molecules/ClientListItem.vue";
import SearchBar from "@/Components/Atoms/SearchBar.vue";
</script>