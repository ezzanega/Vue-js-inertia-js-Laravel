<template>
  <div class="overflow-hidden space-y-2">
    <div class="flex flex-row justify-between items-center mt-5">
      <SearchBar name="document" v-model="searchQuotationQuery" class="shrink mt-1 mx-1 w-1/3"
      placeholder="Recherchez un numéro de devis/nom de client" />
      <div class="flex flex-row space-x-2 items-center">
        <SelectClientModal />
        <IconButton class="mt-6" :customClass="'text-primary bg-white'" text="Exporter" @click="handleExportClick">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="pointer-events-none shrink-0 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
          </svg>

        </IconButton>
      </div>
    </div>
    <div
      class="w-full rounded-xl bg-white text-left text-xs px-6 py-4 font-medium text-gray-900 flex justify-between border-b border-gray-200">
      <div class="w-1/12"><input name="" type="checkbox"
            class="form-checkbox rounded-md text-primary h-5 w-5 focus:ring-0" :checked="selectedAll"
        @change="toggleSelectedAll"/></div>
      <div class="w-1/12 text-center flex flex-row justify-center items-center">N° du devis
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
      <div class="w-2/12 text-center flex flex-row justify-center items-center">Formule
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
      <div class="w-1/12 text-center flex flex-row justify-center items-center">Volume</div>
      <div class="w-1/12 text-center flex flex-row justify-center items-center">Distance</div>
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
      <div class="w-1/12 text-center"></div>
    </div>

      <div v-if="filteredQuotationsResults.length > 0" class="space-y-2 overflow-auto">
        <QuotationListItem v-for="(document, index) in filteredQuotationsResults" :key="index" :document="document" :selected-all="selectedAll" :toggle-document-selection="toggleDocumentSelection" :deletequotation="deletequotation" :opendelModal="opendelModal"/>
      </div>
      <div v-else-if="searchQuotationResults.length > 0" class="space-y-2 overflow-auto">
        <QuotationListItem v-for="(document, index) in searchQuotationResults" :key="index" :document="document" :selected-all="selectedAll" :toggle-document-selection="toggleDocumentSelection" :deletequotation="deletequotation" :opendelModal="opendelModal"/>
      </div>
      <div v-else class="space-y-2 w-auto">
        <QuotationListItem v-for="(document, index) in usePage().props.quotations" :key="index" :document="document" :selected-all="selectedAll" :toggle-document-selection="toggleDocumentSelection" :deletequotation="deletequotation" :opendelModal="opendelModal"
        :openDupQuotModal="openDupQuotModal"
        :openPayQuotModal="openPayQuotModal"/>
      </div>
    </div>
</template>

<script setup>
import ExcelJS from "exceljs";
import SelectClientModal from "@/Components/Organisms/SelectClientModal.vue";
import IconButton from "@/Components/Atoms/IconButton.vue";
import QuotationListItem from "@/Components/Molecules/QuotationListItem.vue";
import SearchBar from "@/Components/Atoms/SearchBar.vue";
import debounce from "lodash/debounce";
import { ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import { reactive } from "vue";


const props=defineProps({
  opendelModal:Function,
  deletequotation:Function,
  openDupQuotModal:Function,
  openPayQuotModal:Function,
});

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
const selectedAll = ref(false);

const selectedDocuments = ref([]);

const toggleDocumentSelection = (document) => {
  const index = selectedDocuments.value.findIndex((doc) => doc.id === document.id);
  if (index !== -1) {
    selectedDocuments.value.splice(index, 1);
  } else {
    selectedDocuments.value.push(document);
  }
};

const toggleSelectedAll = () => {
  if (selectedAll.value) {
    selectedDocuments.value = [];
  } else {
    selectedDocuments.value = [...usePage().props.quotations];
  }
  selectedAll.value = !selectedAll.value;
};

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
    console.log('error');
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
      console.log('error');
    }
  }
}

const exportSelectedDocuments = (selectedDocuments) => {
  const workbook = new ExcelJS.Workbook();
  const worksheet = workbook.addWorksheet("Quotations");

  const columns = [
    "N° du devis",
    "Client",
    "Email",
    "Statut",
    "Date",
    "Formule",
    "Volume/Distance",
    "Montant HT",
  ];
  worksheet.addRow(columns);

  selectedDocuments.forEach((document) => {
    const rowData = [
      document.number,
      document.moving_job.client.type == "professional" ? document.moving_job.client.client_organization.name : document.moving_job.client.first_name + " " + document.moving_job.client.last_name,
      document.moving_job.client.email,
      document.status,
      document.moving_job.loading_date,
      document.moving_job.client.type == "professional" ? "Professionnel" : "Particulier",
      document.moving_job.amount_ht,
    ];
    worksheet.addRow(rowData);
  });

  const fileName = "Liste des devis.xlsx";
  workbook.xlsx.writeBuffer().then((buffer) => {
    const blob = new Blob([buffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = fileName;
    link.click();
  });
};

const handleExportClick = () => {
  exportSelectedDocuments(selectedDocuments.value);
};
</script>
