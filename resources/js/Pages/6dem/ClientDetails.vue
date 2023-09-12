<template>
    <Head title="Fiche client" />
    <DemLayout>
      <Tabs :routePath="route('6dem.clients.details', currentClient.id)">
        <Tab title="Informations client">
            <div class="mt-5 py-5">
                <ClientInformations />
            </div>
        </Tab>
        <Tab title="Devis">
            <ClientQuotations v-if="$page.props.quotations.length"
            :deletequotation="deletequotation" :opendelModal="opendelModal"
            :openDupQuotModal="openDupQuotModal"
            :openPayQuotModal="openPayQuotModal" />
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
            <ListEmptyMessage
                v-if="!$page.props.quotations.length"
                message-title="Pas de devis enregistré"
                message-content="Pas de devis enregistré pour ce client"
                >
                <IconButton @click="initQuatation" class="mt-6" text="Céer un devis" >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" aria-hidden="true" class="pointer-events-none shrink-0 w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                </IconButton>
            </ListEmptyMessage>
        </Tab>
        <Tab title="Paiements">
            <ClientPayment v-if="$page.props.payments.length" />
            <ListEmptyMessage
                v-if="!$page.props.payments.length"
                message-title="Pas de paiements effectués"
                message-content="Pas de paiements effectués pour ce client"
                >
            </ListEmptyMessage>
        </Tab>
        <Tab title="Factures">
            <ClientFactures v-if="$page.props.invoices.length" />
            <ListEmptyMessage
                v-if="!$page.props.invoices.length"
                message-title="Pas de factures enregistré"
                message-content="Pas de factures enregistré pour ce client"
                >
            </ListEmptyMessage>
        </Tab>
        <Tab title="Lettres de voiture">
            <ClientWaybills v-if="$page.props.waybills.length"
            :deleteLv="deleteLv" :opendelModal="opendelModal"  />
            <ListEmptyMessage
                v-if="!$page.props.waybills.length"
                message-title="Pas de lettres de voiture enregistré"
                message-content="Pas de Lettres de voiture enregistré pour ce client"
                >
            </ListEmptyMessage>
        </Tab>
      </Tabs>
    </DemLayout>
  </template>

  <script setup>
  import DemLayout from "@/Layouts/DemLayout.vue";
  import { Head, router, usePage } from "@inertiajs/vue3";
  import Tabs from "@/Components/Molecules/Tabs.vue";
  import Tab from "@/Components/Atoms/Tab.vue";
  import ListEmptyMessage from "@/Components/Organisms/ListEmptyMessage.vue";
  import ClientInformations from "@/Components/ClientDetails/ClientInformations.vue";
  import ClientQuotations from "@/Components/ClientDetails/ClientQuotations.vue";
  import ClientPayment from "@/Components/ClientDetails/ClientPayment.vue";
  import ClientFactures from "@/Components/ClientDetails/ClientFactures.vue";
  import ClientWaybills from "@/Components/ClientDetails/ClientWaybills.vue";
  import DuplicateQuotation from "@/Components/Molecules/DuplicateQuotation.vue";
  import PayementQuotation from "@/Components/Molecules/PayementQuotation.vue";
  import DeleteFormModal from "@/Components/Atoms/DeleteFormModal.vue";
  import IconButton from "@/Components/Atoms/IconButton.vue";
  import { ref } from "vue";


  const currentClient = usePage().props.client


    const initQuatation = () => {
        router.visit(
        route("6dem.documents.quotation.init", currentClient.id),
        {
            method: "post",
        }
        );
    };

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
