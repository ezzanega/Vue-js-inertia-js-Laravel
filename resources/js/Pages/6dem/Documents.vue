<template>
  <Head title="Documents" />
  <DemLayout>
    <Tabs :routePath="route('6dem.documents')">
      <Tab title="Devis">
        <div v-if="$page.props.quotations.length">
          <div class="mt-2">
            <QuotationList :deletequotation="deletequotation" :opendelModal="opendelModal"
            :openDupQuotModal="openDupQuotModal"
            :openPayQuotModal="openPayQuotModal"/>
            <!-- Pour la suppression des 3 section -->
            <DeleteFormModal :isModaldelOpen="isModaldelOpen"
            @closedelModal="closedelModal()"
            @deleteFunction="
                Deletedtype === 'devis' ? deletequotation(selectedvalue) :
                Deletedtype === 'facture' ? deleteFacture(selectedvalue) :
                Deletedtype === 'Lv' ? deleteLv(selectedvalue) : null
            "
            />

            <DuplicateQuotation v-if="isModal_dup_quot_Open"
            :isModal_dup_quot_Open="isModal_dup_quot_Open"
            @closeDupQuotModal="closeDupQuotModal()"
            :id="selectedvalue" />

            <PayementQuotation
            v-if="isModal_payment_quot_Open"
            :isModal_payment_quot_Open="isModal_payment_quot_Open"
            @closePayQuotModal="closePayQuotModal()"
            :selectedvalue="selectedvalue"/>
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
          <div class="mt-2">
            <WaybillList :deleteLv="deleteLv" :opendelModal="opendelModal" />
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
      <Tab title="Factures">
        <div v-if="$page.props.invoices.length">
          <div class="mt-2">
            <InvoiceList :deleteFacture="deleteFacture" :opendelModal="opendelModal"/>
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
import DuplicateQuotation from "@/Components/Molecules/DuplicateQuotation.vue";
import PayementQuotation from "@/Components/Molecules/PayementQuotation.vue";
import DeleteFormModal from "@/Components/Atoms/DeleteFormModal.vue";
import { Head,router } from "@inertiajs/vue3";
import { ref } from "vue";
import Tabs from "@/Components/Molecules/Tabs.vue";
import Tab from "@/Components/Atoms/Tab.vue";
import WaybillList from "@/Components/Molecules/WaybillList.vue";
import InvoiceList from "@/Components/Molecules/InvoiceList.vue";

function deleteLv(id) {
  router.delete(`/6dem/documents/waybill/delete/${id}`, {
    onBefore: () => opendelModal(),
    onSuccess:() => closedelModal()
  });
}

function deleteFacture(id) {
  router.delete(`/6dem/documents/invoice/delete/${id}`, {
    onBefore: () => opendelModal(),
    onSuccess:() => closedelModal()
  });
}

function deletequotation(id) {
  router.delete(`/6dem/documents/quotation/delete/${id}`, {
      onBefore: () => opendelModal(),
      onSuccess:() => closedelModal()
  });
}

const isModaldelOpen=ref(false);
const selectedvalue=ref(null);
const Deletedtype = ref(null);

const opendelModal = (id,deleted) => {
  isModaldelOpen.value = true;
  selectedvalue.value = id;
  Deletedtype.value = deleted;
  console.log(Deletedtype.value)

};

const closedelModal = () => {
  isModaldelOpen.value = false;
  selectedvalue.value=null;
};
//fin Open et Close Pop-up

//début Open et Close Pop-up de duplicate quotation
const isModal_dup_quot_Open = ref(false);

const openDupQuotModal = (id_quot) => {
  isModal_dup_quot_Open.value = true;
  selectedvalue.value = id_quot;
};

const closeDupQuotModal = () => {
  isModal_dup_quot_Open.value = false;
};
//fin Open et Close Pop-up

//début Open et Close Pop-up de duplicate quotation
const isModal_payment_quot_Open = ref(false);

const openPayQuotModal = (id_quot) => {
    isModal_payment_quot_Open.value = true;
    selectedvalue.value = id_quot;
};

const closePayQuotModal = () => {
    isModal_payment_quot_Open.value = false;
};
</script>
