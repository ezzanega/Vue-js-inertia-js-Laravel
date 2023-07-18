<template>
  <Head title="Documents" />
  <DemLayout>
    <Tabs>
      <Tab title="Devis">
        <div v-if="$page.props.quotations.length">
          <SelectClientModal />
          <div class="mt-2">
            <QuotationListItem
              v-for="(quotation, index) in $page.props.quotations"
              :key="quotation.id"
              :number="quotation.number"
              status="En cours"
            />
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
        <ListEmptyMessage
          message-title="Vous n'avez pas de lettres de voiture créées"
          message-content="Commencez par ajouter une nouvelle lettre de voiture"
        >
          <SelectQuoteModal />
        </ListEmptyMessage>
      </Tab>
      <Tab title="Facture">
        <ListEmptyMessage
          message-title="Vous n'avez pas de factures créées"
          message-content="Commencez par ajouter une nouvelle facture"
        >
          <Link
            :href="route('6dem.documents.invoice')"
            class="border-b text-primary border-primary border-dotted"
          >
            Ajouter une facture
          </Link>
        </ListEmptyMessage>
      </Tab>
    </Tabs>
  </DemLayout>
</template>
  
<script setup>
import DemLayout from "@/Layouts/DemLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import IconButton from "@/Components/Atoms/IconButton.vue";
import ListEmptyMessage from "@/Components/Organisms/ListEmptyMessage.vue";
import Drawer from "@/Components/Organisms/Drawer.vue";
import DrawerContent from "@/Components/Molecules/DrawerContent.vue";
import SelectClientModal from "@/Components/Organisms/SelectClientModal.vue";
import SelectQuoteModal from "@/Components/Organisms/SelectQuoteModal.vue";
import { ref } from "vue";
import Tabs from "@/Components/Molecules/Tabs.vue";
import Tab from "@/Components/Atoms/Tab.vue";
import QuotationListItem from "@/Components/Atoms/QuotationListItem.vue";

let isDrawerOpen = ref(false);
let innerWidth = ref(window.innerWidth / 4 + "px");

const toggleDrawer = () => {
  isDrawerOpen.value = !isDrawerOpen.value;
};

const closeDrawer = () => {
  isDrawerOpen.value = false;
};
</script>