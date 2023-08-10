<template>
  <div class="overflow-hidden space-y-2">
    <SearchBar name="document" v-model="searchQuotationQuery" class="shrink mt-1 mx-1 w-1/3"
      placeholder="Recherchez un numéro de devis/nom de client" />
    <TailwindPagination
        :data="$page.props.quotations"
        @pagination-change-page="getResults"
    />
    <div
      class="w-full rounded-xl bg-white text-left text-sm px-6 py-4 font-medium text-gray-900 flex justify-between border-b border-gray-200">
      <div class="w-1/12 text-center"></div>
      <div class="w-2/12 text-center">N° du devis</div>
      <div class="w-2/12 text-center">Client</div>
      <div class="w-1/12 text-center">Statut</div>
      <div class="w-1/12 text-center">Date du devis</div>
      <div class="w-2/12 text-center">Type du client</div>
      <div class="w-1/12 text-center">Montant HT</div>
      <div class="w-1/12 text-center">Montant TTC</div>
      <div class="w-1/12 text-center"></div>
    </div>

    <div v-if="searchQuotationResults.length" class="space-y-2">
      <QuotationListItem v-for="(document, index) in searchQuotationResults" :key="index" :document="document" />
    </div>
    <div v-else class="space-y-2">
      <QuotationListItem v-for="(document, index) in $page.props.quotations" :key="index" :document="document" />
    </div>
  </div>
</template>
  
<script setup>
import QuotationListItem from "@/Components/Molecules/QuotationListItem.vue";
import SearchBar from "@/Components/Atoms/SearchBar.vue";
import { TailwindPagination } from 'laravel-vue-pagination';
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

const laravelData = ref({});
const searchQuotationQuery = ref("");
const searchQuotationResults = ref([]);
const searchingQuotation = ref(false);

watch(searchQuotationQuery, (newQuery) => {
  debouncedFetchQuotationResults(newQuery);
});

const searchQuotation = async () => {
  searchingQuotation.value = true;
  try {
    const result = await axios.get(
      route("6dem.search.quotation") + "?search_text=" + searchQuotationQuery.value
    );
    searchQuotationResults.value = result.data;
  } catch (e) {
    console.log(e);
  }
};

const debouncedFetchQuotationResults = debounce(searchQuotation, 300);

const getResults = async (page = 1) => {
    const response = await fetch(
      route("6dem.documents") + "?page=" + page
    );
    laravelData.value = await response;
}

getResults();
</script>