<template>
    <div class="overflow-hidden space-y-2">
      <div class="flex flex-row items-center justify-between mt-5">
          <div class="flex flex-row space-x-2 items-center">
            <IconButton class="mt-6" :customClass="'text-primary bg-white'" text="Exporter" @click="handleExportClick">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="pointer-events-none shrink-0 w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
                </svg>
            </IconButton>
          </div>
      </div>

      <div class="w-full rounded-xl bg-white text-left text-xs px-6 py-4 font-medium text-gray-900 flex justify-between border-b border-gray-200">
        <div class="w-1/12">
            <input name="" type="checkbox" class="form-checkbox rounded-md text-primary h-5 w-5 focus:ring-0" :checked="selectedAll" @change="toggleSelectedAll"/>
        </div>
        <div class="flex flex-row items-center justify-center w-2/12 text-center">N° du devis</div>
        <div class="flex flex-row items-center justify-center w-2/12 text-center">Référence</div>
        <div class="flex flex-row items-center justify-center w-2/12 text-center">Type de paiement</div>
        <div class="flex flex-row items-center justify-center w-2/12 text-center">Mode de paiement</div>
        <div class="flex flex-row items-center justify-center w-2/12 text-center">Montant HT</div>
        <div class="flex flex-row items-center justify-center w-2/12 text-center">Date du paiement</div>
        <div class="w-1/12"></div>
      </div>

      <div class="space-y-2 overflow-auto">
        <PaymentListItem v-for="(payments, index) in currentPayments" :key="index" :payments="payments" :selected-all="selectedAll" :toggle-payment-selection="togglePaymentSelection"/>
      </div>
    </div>
  </template>

  <script setup>
  import ExcelJS from "exceljs";
  import IconButton from "@/Components/Atoms/IconButton.vue";
  import PaymentListItem from "@/Components/Molecules/PaymentListItem.vue";
  import { usePage } from "@inertiajs/vue3";
  import { ref } from "vue";

  const currentPayments = ref(usePage().props.payments)
  const selectedAll = ref(false);
  const selectedPayments = ref([]);

  const togglePaymentSelection = (payment) => {
    const index = selectedPayments.value.findIndex((pay) => pay.id === payment.id);
    if (index !== -1) {
      selectedPayments.value.splice(index, 1);
    } else {
      selectedPayments.value.push(payment);
    }
    console.log(selectedPayments.value);
  };

  const toggleSelectedAll = () => {
    if (selectedAll.value) {
        selectedPayments.value = [];
    } else {
        selectedPayments.value = [...usePage().props.payments];
    }
    selectedAll.value = !selectedAll.value;
    console.log(selectedPayments.value);
  };

  const exportSelectedPayments = (selectedPayments) => {
    const workbook = new ExcelJS.Workbook();
    const worksheet = workbook.addWorksheet("Payments");
    const columns = [
      "Référence",
      "Type de paiement",
      "Mode de paiement",
      "Montant HT",
      "Date",
    ];
    worksheet.addRow(columns);
    selectedPayments.forEach((payment) => {
      const rowData = [
        payment.reference,
        payment.type,
        payment.payment_channel,
        payment.amount,
        payment.created_at,
      ];
      worksheet.addRow(rowData);
    });

    const fileName = "Liste des payments.xlsx";
    workbook.xlsx.writeBuffer().then((buffer) => {
      const blob = new Blob([buffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
      const link = document.createElement("a");
      link.href = URL.createObjectURL(blob);
      link.download = fileName;
      link.click();
    });
  };

  const handleExportClick = () => {
    exportSelectedPayments(selectedPayments.value);
  };

  </script>
