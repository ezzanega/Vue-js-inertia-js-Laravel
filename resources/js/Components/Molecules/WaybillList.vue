<template>
  <div class="overflow-hidden space-y-2">
    <SearchBar name="document" v-model="searchWaybillQuery" class="shrink mt-1 mx-1 w-1/3"
      placeholder="Recherchez un numéro de lettre de voiture/nom de client" />
    <div
      class="w-full rounded-xl bg-white text-left text-sm px-6 py-4 font-medium text-gray-900 flex justify-between border-b border-gray-200">
      <div class="w-1/12 text-center"></div>
      <div class="w-3/12 text-center">N° de la lettre de voiture</div>
      <div class="w-3/12 text-center">Client</div>
      <div class="w-2/12 text-center">Statut</div>
      <div class="w-2/12 text-center">Type de déménagement</div>
      <div class="w-2/12 text-center">Date de déménagement</div>
      <div class="w-1/12"></div>
    </div>

    <div v-if="searchWaybillResults.length" class="space-y-2">
      <WaybillListItem v-for="(document, index) in searchWaybillResults" :key="index" :document="document" />
    </div>
    <div v-else class="space-y-2">
      <WaybillListItem v-for="(document, index) in $page.props.waybills" :key="index" :document="document" />
    </div>
  </div>
</template>
    
<script setup>
import WaybillListItem from "@/Components/Molecules/WaybillListItem.vue";
import SearchBar from "@/Components/Atoms/SearchBar.vue";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

const searchWaybillQuery = ref("");
const searchWaybillResults = ref([]);
const searchingWaybill = ref(false);

watch(searchWaybillQuery, (newQuery) => {
  debouncedFetchWaybillResults(newQuery);
});

const searchWaybill = async () => {
  searchingWaybill.value = true;
  try {
    const result = await axios.get(
      route("6dem.search.waybill") + "?search_text=" + searchWaybillQuery.value
    );
    searchWaybillResults.value = result.data;
  } catch (e) {
    console.log(e);
  }
};

const debouncedFetchWaybillResults = debounce(searchWaybill, 300);
</script>
    