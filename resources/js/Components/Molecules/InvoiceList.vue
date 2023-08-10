<template>
  <div class="overflow-hidden space-y-2">
    <SearchBar name="document" v-model="searchInvoiceQuery" class="shrink mt-1 mx-1 w-1/3"
      placeholder="Recherchez un numéro de facture" />
    <div
      class="w-full rounded-xl bg-white text-left text-sm px-6 py-4 font-medium text-gray-900 flex justify-between border-b border-gray-200">
      <div class="w-1/12 text-center"></div>
      <div class="w-3/12 text-center">N° Facture</div>
      <div class="w-3/12 text-center">Date de déménagement</div>
      <div class="w-2/12 text-center">Type de facture</div>
      <div class="w-2/12 text-center">Statut</div>
      <div class="w-2/12 text-center">Montant HT</div>
      <div class="w-2/12 text-center">Montant TTC</div>
      <div class="w-1/12"></div>
    </div>

    <div v-if="searchInvoiceResults.length" class="space-y-2">
      <InvoiceListItem v-for="(document, index) in searchInvoiceResults" :key="index" :document="document" />
    </div>
    <div v-else class="space-y-2">
      <InvoiceListItem v-for="(document, index) in $page.props.invoices" :key="index" :document="document" />
    </div>
  </div>
</template>
    
<script setup>
import InvoiceListItem from "@/Components/Molecules/InvoiceListItem.vue";
import SearchBar from "@/Components/Atoms/SearchBar.vue";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

const searchInvoiceQuery = ref("");
const searchInvoiceResults = ref([]);
const searchingInvoice = ref(false);

watch(searchInvoiceQuery, (newQuery) => {
  debouncedFetchInvoiceResults(newQuery);
});

const searchInvoice = async () => {
  searchingInvoice.value = true;
  try {
    const result = await axios.get(
      route("6dem.search.invoice") + "?search_text=" + searchInvoiceQuery.value
    );
    searchInvoiceResults.value = result.data;
  } catch (e) {
    console.log(e);
  }
};

const debouncedFetchInvoiceResults = debounce(searchInvoice, 300);
</script>
    