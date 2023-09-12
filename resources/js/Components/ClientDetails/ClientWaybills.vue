<template>
    <div class="overflow-hidden space-y-2">
      <div class="flex flex-row justify-between items-center mt-5">
        <SearchBar name="document" v-model="searchWaybillQuery" class="shrink mt-1 mx-1 w-1/3"
          placeholder="Recherchez un numéro de lettre de voiture/nom de client" />
        <div class="flex flex-row space-x-2 items-center">
          <SelectQuoteModal />
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
            @change="toggleSelectedAll" /></div>
        <div class="w-3/12 flex flex-row justify-center items-center">N° de la lettre de voiture
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
        <div class="w-2/12 flex flex-row justify-center items-center">Statut
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
        <div class="w-2/12 flex flex-row justify-center items-center">Type de déménagement
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
        <div class="w-2/12 flex flex-row justify-center items-center">Date de déménagement
          <div class="flex flex-col items-center ml-2">
            <button>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="w-3 h-3 text-gray-400 hover:text-gray-900"
                :class="[filters.date == 'asc' ? 'text-gray-900 hover:opacity-80' : '']" @click="sortField('date', 'asc')">
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
        <div class="w-2/12"></div>
      </div>

      <!-- <div v-if="searchWaybillResults.length" class="space-y-2">
        <ClientWaybillsItem v-for="(waybills, index) in searchWaybillResults" :key="index" :waybills="waybills"
          :selected-all="selectedAll" :toggle-document-selection="toggleDocumentSelection" />
      </div>
      <div v-else-if="filteredWaybillsResults.length > 0" class="space-y-2 overflow-auto">
        <ClientWaybillsItem v-for="(waybills, index) in filteredWaybillsResults" :key="index" :waybills="waybills"
          :selected-all="selectedAll" :toggle-document-selection="toggleDocumentSelection" />
      </div>
      <div v-else class="space-y-2">
        <ClientWaybillsItem v-for="(waybills, index) in $page.props.waybills" :key="index" :waybills="waybills"
          :selected-all="selectedAll" :toggle-document-selection="toggleDocumentSelection"
         />
      </div> -->
      <div v-if="searchWaybillResults.length" class="space-y-2">
        <WaybillListItem v-for="(document, index) in searchWaybillResults" :key="index" :document="document"
          :selected-all="selectedAll" :toggle-document-selection="toggleDocumentSelection" :deleteLv="deleteLv" :opendelModal="opendelModal" />
      </div>
      <div v-else-if="filteredWaybillsResults.length > 0" class="space-y-2 overflow-auto">
        <WaybillListItem v-for="(document, index) in filteredWaybillsResults" :key="index" :document="document"
          :selected-all="selectedAll" :toggle-document-selection="toggleDocumentSelection" :deleteLv="deleteLv" :opendelModal="opendelModal"/>
      </div>
      <div v-else class="space-y-2">
        <WaybillListItem v-for="(document, index) in $page.props.waybills" :key="index" :document="document"
          :selected-all="selectedAll" :toggle-document-selection="toggleDocumentSelection"
        :deleteLv="deleteLv" :opendelModal="opendelModal" />
      </div>
    </div>
  </template>

  <script setup>
  import ExcelJS from "exceljs";
  import ClientWaybillsItem from "@/Components/ClientDetails/ListItems/ClientWaybillsItem.vue";
  import WaybillListItem from "@/Components/Molecules/WaybillListItem.vue";

  import IconButton from "@/Components/Atoms/IconButton.vue";
  import SelectQuoteModal from "@/Components/Organisms/SelectQuoteModal.vue";
  import SearchBar from "@/Components/Atoms/SearchBar.vue";
  import { usePage } from "@inertiajs/vue3";
  import { ref, watch } from "vue";
  import debounce from "lodash/debounce";
  import { reactive } from "vue";

  const props=defineProps({
    opendelModal:Function,
    deleteLv:Function,
});
  const filteredWaybillsResults = ref([]);
  const searchWaybillQuery = ref("");
  const searchWaybillResults = ref([]);
  const searchingWaybill = ref(false);

  const filters = reactive({
    number: "",
    client: "",
    date: "",
    status: "",
    clientType: ""
  });

  const selectedAll = ref(false);

  const selectedDocuments = ref([]);

  const toggleDocumentSelection = (document) => {
    const index = selectedDocuments.value.findIndex((doc) => doc.id === document.id);
    if (index !== -1) {
      selectedDocuments.value.splice(index, 1); // Remove the document if already selected
    } else {
      selectedDocuments.value.push(document); // Add the document if not selected
    }
  };

  const toggleSelectedAll = () => {
    if (selectedAll.value) {
      selectedDocuments.value = []; // Deselect all documents
    } else {
      selectedDocuments.value = [...usePage().props.waybills]; // Select all documents
    }
    selectedAll.value = !selectedAll.value;
  };

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
      console.log('error');
    }
  };

  const debouncedFetchWaybillResults = debounce(searchWaybill, 300);

  const sortField = async (field, order) => {
    if (filters[field] == order) {
      filters[field] = "";
      const allFieldsEmpty = Object.values(filters).every(value => value === "");

      if (allFieldsEmpty) {
        filteredWaybillsResults.value = ref([]);
      }
    } else {
      filters[field] = order;
      try {
        const result = await axios.get(
          route("6dem.sort.waybill") +
          "?number=" + filters.number +
          "&client=" + filters.client +
          "&date=" + filters.date +
          "&status=" + filters.status +
          "&clientType=" + filters.clientType
        );
        filteredWaybillsResults.value = result.data;
      } catch (e) {
        console.log('error');
      }
    }
  }

  const exportSelectedDocuments = (selectedDocuments) => {
    const workbook = new ExcelJS.Workbook();
    const worksheet = workbook.addWorksheet("Lettres de voiture");

    const columns = [
      "Client",
      "N° de la lettre de voiture",
    //   "Email",
      "Statut",
      "Date de déménagment",
      "Type de déménagement"
    ];
    worksheet.addRow(columns);

    selectedDocuments.forEach((document) => {
      const rowData = [
        document.moving_job.client.type == "professional" ? document.moving_job.client.client_organization.name : document.moving_job.client.first_name + " " + document.moving_job.client.last_name,
        // document.moving_job.client.email,
        document.number,
        document.status,
        document.moving_job.loading_date ? document.moving_job.loading_date : '        --       ',
        document.moving_job.client.type == "professional" ? "Professionnel" : "Particulier",
      ];
      worksheet.addRow(rowData);
    });

    const fileName = "Liste des lettres de voiture.xlsx";
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
