<template>
    <div class="overflow-hidden space-y-2">
      <div class="flex flex-row justify-between items-center mt-5">
        <div class="flex flex-row space-x-2 items-center">
            <IconButton @click="initQuatation" class="mt-6" text="Ajouter un devis" >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" aria-hidden="true" class="pointer-events-none shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
            </IconButton>
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
        <div class="w-1/12">
            <input name="" type="checkbox" class="form-checkbox rounded-md text-primary h-5 w-5 focus:ring-0" :checked="selectedAll" @change="toggleSelectedAll"/>
        </div>
        <div class="w-1/12 text-center flex flex-row justify-center items-center">N° du devis</div>
        <div class="w-2/12 text-center flex flex-row justify-center items-center">Client</div>
        <div class="w-1/12 text-center flex flex-row justify-center items-center">Statut</div>
        <div class="w-1/12 text-center flex flex-row justify-center items-center">Date</div>
        <div class="w-2/12 text-center flex flex-row justify-center items-center">Formule</div>
        <div class="w-1/12 text-center flex flex-row justify-center items-center">Volume</div>
        <div class="w-1/12 text-center flex flex-row justify-center items-center">Distance</div>
        <div class="w-1/12 text-center flex flex-row justify-center items-center">Montant HT</div>
        <div class="w-1/12 text-center"></div>
      </div>
        <div class="space-y-2 overflow-auto">
          <QuotationListItem v-for="(document, index) in usePage().props.quotations" :key="index" :document="document" :selected-all="selectedAll" :toggle-document-selection="toggleDocumentSelection"
          :deletequotation="deletequotation" :opendelModal="opendelModal"
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
  import { usePage, router } from "@inertiajs/vue3";
  import { ref } from "vue";

  const props=defineProps({
    opendelModal:Function,
    deletequotation:Function,
    openDupQuotModal:Function,
    openPayQuotModal:Function,
   });
  const currentQuotations = ref(usePage().props.quotations)
  const currentClient = usePage().props.client

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
      selectedDocuments.value = [...usePage().props.quotations]; // Select all documents
    }
    selectedAll.value = !selectedAll.value;
  };

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
        document.moving_job.client.type == "professional" ? "Professionnel" : document.moving_job.formula,
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

  const initQuatation = () => {
    router.visit(
      route("6dem.documents.quotation.init", currentClient.id),
      {
        method: "post",
        replace: true
      }
    );
  };
  </script>
