<template>
  <Head title="Documents" />
  <DemLayout>
    <Tabs>
      <Tab title="Devis">
        <div v-if="$page.props.quotations.length">
          <SelectClientModal />
          <div class="mt-2">
            <QuotationList />
          </div>
        </div>
        <ListEmptyMessage
          v-if="!$page.props.quotations.length"
          message-title="Vous n'avez pas de devis créés"
          message-content="Commencez par ajouter un nouveau devis"
        >
          <SelectClientModal />
        </ListEmptyMessage>
      </Tab>
      <Tab title="Lettres de voiture">
        <div v-if="$page.props.waybills.length">
          <SelectQuoteModal/>
          <div class="mt-2">
            <WaybillList />
          </div>
        </div>
        <ListEmptyMessage
          v-if="!$page.props.waybills.length"
          message-title="Vous n'avez pas de lettres de voiture créées"
          message-content="Commencez par ajouter une nouvelle lettre de voiture"
        >
          <SelectQuoteModal />
        </ListEmptyMessage>
      </Tab>
      <Tab title="Facture">
        <div v-if="$page.props.invoices.length">
          <SelectQuoteInvoiceModal/>
          <div class="mt-2">
            <InvoiceList />
          </div>
        </div>
        <ListEmptyMessage
          v-if="!$page.props.invoices.length"
          message-title="Vous n'avez pas de factures créées"
          message-content="Commencez par ajouter une nouvelle facture"
        >
          <SelectQuoteInvoiceModal />
        </ListEmptyMessage>
      </Tab>
    </Tabs>
  </DemLayout>
</template>
  
<script setup>
import DemLayout from "@/Layouts/DemLayout.vue";
import SelectClientModal from "@/Components/Organisms/SelectClientModal.vue";
import SelectQuoteModal from "@/Components/Organisms/SelectQuoteModal.vue";
import SelectQuoteInvoiceModal from "@/Components/Organisms/SelectQuoteInvoiceModal.vue";
import ListEmptyMessage from "@/Components/Organisms/ListEmptyMessage.vue";
import QuotationList from "@/Components/Molecules/QuotationList.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import Tabs from "@/Components/Molecules/Tabs.vue";
import Tab from "@/Components/Atoms/Tab.vue";
import WaybillList from "@/Components/Molecules/WaybillList.vue";
import InvoiceList from "@/Components/Molecules/InvoiceList.vue";

let isDrawerOpen = ref(false);
let innerWidth = ref(window.innerWidth / 4 + "px");

const toggleDrawer = () => {
  isDrawerOpen.value = !isDrawerOpen.value;
};

const closeDrawer = () => {
  isDrawerOpen.value = false;
};
</script>