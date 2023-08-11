<template>
  <div class="overflow-hidden space-y-2">
    <SearchBar name="document" v-model="searchQuotationQuery" class="shrink mt-1 mx-1 w-1/3"
      placeholder="Recherchez un numéro de devis/nom de client" />
    <TailwindPagination :data="$page.props.quotations" @pagination-change-page="getResults" />
    <div
      class="w-full rounded-xl bg-white text-left text-sm px-6 py-4 font-medium text-gray-900 flex justify-between border-b border-gray-200">
      <div class="w-1/12 text-center"></div>
      <div class="w-2/12 text-center flex flex-row justify-center items-center">N° du devis
        <div class="flex flex-col items-center ml-2">
          <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="w-3 h-3 text-gray-400 hover:text-gray-900"
              :class="[filters.number == 'asc' ? 'text-gray-900 hover:opacity-80' : '']"
              @click="sortField('number', 'asc')">
              <path fill-rule="evenodd"
                d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                clip-rule="evenodd" />
            </svg>
          </button>
          <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="w-3 h-3 text-gray-400 hover:text-gray-900"
              :class="[filters.number == 'desc' ? 'text-gray-900 hover:opacity-80' : '']"
              @click="sortField('number', 'desc')">
              <path fill-rule="evenodd"
                d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
      <div class="w-2/12 text-center flex flex-row justify-center items-center">Client
        <div class="flex flex-col items-center ml-2">
          <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="w-3 h-3 text-gray-400 hover:text-gray-900"
              :class="[filters.client == 'asc' ? 'text-gray-900 hover:opacity-80' : '']"
              @click="sortField('client', 'asc')">
              <path fill-rule="evenodd"
                d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                clip-rule="evenodd" />
            </svg>
          </button>
          <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="w-3 h-3 text-gray-400 hover:text-gray-900"
              :class="[filters.client == 'desc' ? 'text-gray-900 hover:opacity-80' : '']"
              @click="sortField('client', 'desc')">
              <path fill-rule="evenodd"
                d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
      <div class="w-1/12 text-center flex flex-row justify-center items-center">Statut
        <div class="flex flex-col items-center ml-2">
          <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="w-3 h-3 text-gray-400 hover:text-gray-900"
              :class="[filters.status == 'asc' ? 'text-gray-900 hover:opacity-80' : '']"
              @click="sortField('status', 'asc')">
              <path fill-rule="evenodd"
                d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                clip-rule="evenodd" />
            </svg>
          </button>
          <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="w-3 h-3 text-gray-400 hover:text-gray-900"
              :class="[filters.status == 'desc' ? 'text-gray-900 hover:opacity-80' : '']"
              @click="sortField('status', 'desc')">
              <path fill-rule="evenodd"
                d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
      <div class="w-1/12 text-center flex flex-row justify-center items-center">Date
        <div class="flex flex-col items-center ml-2">
          <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="w-3 h-3 text-gray-400 hover:text-gray-900"
              :class="[filters.date == 'asc' ? 'text-gray-900 hover:opacity-80' : '']" 
              @click="sortField('date', 'asc')">
              <path fill-rule="evenodd"
                d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                clip-rule="evenodd" />
            </svg>
          </button>
          <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="w-3 h-3 text-gray-400 hover:text-gray-900"
              :class="[filters.date == 'desc' ? 'text-gray-900 hover:opacity-80' : '']"
              @click="sortField('date', 'desc')">
              <path fill-rule="evenodd"
                d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
      <div class="w-2/12 text-center flex flex-row justify-center items-center">Type du client
        <div class="flex flex-col items-center ml-2">
          <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="w-3 h-3 text-gray-400 hover:text-gray-900"
              :class="[filters.clientType == 'asc' ? 'text-gray-900 hover:opacity-80' : '']"
              @click="sortField('clientType', 'asc')">
              <path fill-rule="evenodd"
                d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                clip-rule="evenodd" />
            </svg>
          </button>
          <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="w-3 h-3 text-gray-400 hover:text-gray-900"
              :class="[filters.clientType == 'desc' ? 'text-gray-900 hover:opacity-80' : '']"
              @click="sortField('clientType', 'desc')">
              <path fill-rule="evenodd"
                d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
      <div class="w-1/12 text-center flex flex-row justify-center items-center">Montant HT
        <div class="flex flex-col items-center ml-2">
          <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="w-3 h-3 text-gray-400 hover:text-gray-900"
              :class="[filters.amountHT == 'asc' ? 'text-gray-900 hover:opacity-80' : '']"
              @click="sortField('amountHT', 'asc')">
              <path fill-rule="evenodd"
                d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                clip-rule="evenodd" />
            </svg>
          </button>
          <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="w-3 h-3 text-gray-400 hover:text-gray-900"
              :class="[filters.amountHT == 'desc' ? 'text-gray-900 hover:opacity-80' : '']"
              @click="sortField('amountHT', 'desc')">
              <path fill-rule="evenodd"
                d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
      <div class="w-1/12 text-center flex flex-row justify-center items-center">Montant TTC
        <div class="flex flex-col items-center ml-2">
          <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="w-3 h-3 text-gray-400 hover:text-gray-900"
              :class="[filters.amountTTC == 'asc' ? 'text-gray-900 hover:opacity-80' : '']"
              @click="sortField('amountTTC', 'asc')">
              <path fill-rule="evenodd"
                d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                clip-rule="evenodd" />
            </svg>
          </button>
          <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="w-3 h-3 text-gray-400 hover:text-gray-900"
              :class="[filters.amountTTC == 'desc' ? 'text-gray-900 hover:opacity-80' : '']"
              @click="sortField('amountTTC', 'desc')">
              <path fill-rule="evenodd"
                d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
      <div class="w-1/12 text-center"></div>
    </div>

    <div v-if="filteredQuotationsResults.length > 0" class="space-y-2">
      <QuotationListItem v-for="(document, index) in filteredQuotationsResults" :key="index" :document="document" />
    </div>
    <div v-else-if="searchQuotationResults.length > 0" class="space-y-2">
      <QuotationListItem v-for="(document, index) in searchQuotationResults" :key="index" :document="document" />
    </div>
    <div v-else class="space-y-2">
      <QuotationListItem v-for="(document, index) in currentQuotations" :key="index" :document="document" />
    </div>
  </div>
</template>
  
<script setup>
import QuotationListItem from "@/Components/Molecules/QuotationListItem.vue";
import { usePage } from "@inertiajs/vue3";
import SearchBar from "@/Components/Atoms/SearchBar.vue";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";
import { reactive } from "vue";

const currentQuotations = ref(usePage().props.quotations)
const filteredQuotationsResults = ref([]);
const searchQuotationQuery = ref("");
const searchQuotationResults = ref([]);
const searchingQuotation = ref(false);

const filters = reactive({
  number: "",
  client: "",
  date: "",
  status: "",
  clientType: "",
  amountHT: "",
  amountTTC: ""
})

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

const sortField = async (field, order) => {
  if (filters[field] == order) {
    filters[field] = "";
    const allFieldsEmpty = Object.values(filters).every(value => value === "");

    if (allFieldsEmpty) {
      filteredQuotationsResults.value = ref([]);
    }
  } else {
    filters[field] = order;
    try {
      const result = await axios.get(
        route("6dem.sort.quotation") +
        "?number=" + filters.number +
        "&client=" + filters.client +
        "&date=" + filters.date +
        "&status=" + filters.status +
        "&clientType=" + filters.clientType +
        "&amountHT=" + filters.amountHT
      );
      filteredQuotationsResults.value = result.data;
    } catch (e) {
      console.log(e);
    }
  }
}
</script>