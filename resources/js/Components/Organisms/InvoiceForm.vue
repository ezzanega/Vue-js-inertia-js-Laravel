<template>
  <div class="2xl:px-28">
    <div class="pt-14 grid justify-items-center">
      <UploadFile class="w-1/6" label="Déposez ou cliquez si vous souhaitez ajouter votre logo" />
    </div>
    <div class="flex flex-col space-y-5 px-10 pb-5 mt-24">
      <div class="text-center text-4xl font-bold pb-2">
        <h1>Facture pour le devis N°{{ currentQuotation.number + ' formule: ' + currentMovingJob.formula }}</h1>
      </div>
      <DocumentLabel name="Informations de la société de déménagement" color="#438A7A" />
      <div>
        <DocumentFieldFrame>
          <DocumentFieldInput :value="'Facture N° ' + currentInvoice.number" placeholder="N° de la lettre de voiture"
            :font-bold="true" disabled />
        </DocumentFieldFrame>
      </div>
      <div class="grid grid-cols-3 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.siren" placeholder="SIREN" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.ape_code" placeholder="Code APE" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.licence_number" placeholder="Licence N°" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.phone_number" placeholder="Téléphone" />
          </DocumentFieldFrame>
        </div>
        <div class="col-span-2">
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Email" :value="currentOrganisation.email" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div class="pb-8">
        <DocumentFieldFrame>
          <DocumentFieldInput placeholder="Adresse de la société"
            :value="currentOrganisation.billing_address.full_address" />
        </DocumentFieldFrame>
      </div>
      <DocumentLabel name="Informations du client" color="#438A7A" />
      <div class="grid grid-cols-3 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Prénom" :value="currentClient.first_name" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Nom" :value="currentClient.last_name" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Téléphone" :value="currentClient.phone_number" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div v-if="currentClient.type == 'professional'">
        <DocumentFieldFrame>
          <DocumentFieldInput placeholder="Nom complet de l'entreprise"
            :value="currentClient.client_organization?.name" />
        </DocumentFieldFrame>
      </div>
      <div class="pb-8">
        <DocumentFieldFrame>
          <DocumentFieldInput placeholder="Adresse du client" :value="currentClient.address.full_address" />
        </DocumentFieldFrame>
      </div>
      <DocumentLabel name="Chargement et Livraison" color="#438A7A" />
      <div class="grid grid-cols-2 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Date de chargement"
              :value="currentMovingJob.loading_date" :fontBold="true" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Date de livraison"
              :value="currentMovingJob.shipping_date" :fontBold="true" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-6 pb-8 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInputAddress :required="true" name="loading_address" :value="currentMovingJob.loading_address"
              placeholder="Adresse de chargement" @place_changed="setLoadingAddressData" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInputAddress :required="true" :value="currentMovingJob.shipping_address" name="shipping_address"
              placeholder="Adresse de livraison" @place_changed="setShippingAddressData" />
          </DocumentFieldFrame>
        </div>
      </div>
    </div>
    <div class="flex flex-col space-y-4 px-10 pb-8">
      <DocumentLabel name="Facture" color="#438A7A" />
      <div class="grid grid-cols-3 gap-6 justify-between">
        <DocumentFieldFrame>
          <div class="p-0.5">
            <span class="w-full">
              Déménagement de <span class="font-bold">{{ currentMovingJob.capacity }}</span>
            </span>
          </div>
        </DocumentFieldFrame>

        <DocumentFieldFrame>
          <div class="p-0.5">
              Distance de <span class="font-bold">{{ currentMovingJob.distance }}</span> 
          </div>
        </DocumentFieldFrame>

        <DocumentFieldFrame>
          <div class="font-bold p-0.5 flex justify-start">
            <span class="w-1/2">
              Total TTC : 
            </span>
            <span class="w-1/2">
              {{  currentMovingJob.amount_ttc ? currentMovingJob.amount_ttc + ' €' : '' }}
            </span>
          </div>
        </DocumentFieldFrame>
      </div>

      <div class="flex flex-col">
        <span class="text-xs text-gray-500">Type de facture</span>
        <DocumentSelectInput v-model="invoice.type" :value="invoice.type" @change="updateInvoice" :options="invoiceTypeOptions" default-text="Type de facture"/>
      </div>

      <div class="grid grid-cols-3 gap-6 pb-5 justify-between">
        <DocumentFieldFrame>
          <div class="p-0.5 flex justify-start">
            <span class="w-1/2">
              Montant HT ({{ getAdvanceOrBalanceNameFromKey(invoice.type) }}) :
            </span>
            <span class="w-1/2 font-bold">
              {{  invoice.amount_ht ? invoice.amount_ht + ' €' : '' }}
            </span>
          </div>
        </DocumentFieldFrame>

        <DocumentFieldFrame>
          <div class="p-0.5 flex justify-start">
            <span class="w-1/2">
              TVA ({{ currentSettings.vat }}%) :
            </span>
            <span class="w-1/2 font-bold">
              {{  invoice.amount_tva ? invoice.amount_tva + ' €' : '' }}
            </span>
          </div>
        </DocumentFieldFrame>

        <DocumentFieldFrame>
          <div class="p-0.5 flex justify-start">
            <span class="w-1/2">
              TTC ({{ getAdvanceOrBalanceNameFromKey(invoice.type) }}) :
            </span>
            <span class="w-1/2 font-bold">
              {{  invoice.amount_ttc ? invoice.amount_ttc + ' €' : '' }}
            </span>
          </div>
        </DocumentFieldFrame>
      </div>

    </div>
    <div class="flex flex-row w-1/3 pb-10 mt-10 mx-auto">
      <DefaultButton @click="previewInvoice" buttontext="Générer la facture" />
    </div>
  </div>
</template>
  
<script setup>
import { usePage, useForm, router } from "@inertiajs/vue3";
import UploadFile from "@/Components/Atoms/UploadFile.vue";
import DocumentFieldFrame from "@/Components/Atoms/DocumentFieldFrame.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";
import DocumentFieldInputAddress from "@/Components/Atoms/DocumentFieldInputAddress.vue";
import DocumentLabel from "@/Components/Atoms/DocumentLabel.vue";
import DocumentSelectInput from "@/Components/Atoms/DocumentSelectInput.vue";
import { calculatePercentage, calculateTTC, getAdvanceOrBalance, getAdvanceOrBalanceNameFromKey } from "@/utils";


const user = usePage().props.auth.user;
const currentSettings = usePage().props.settings;
const currentOrganisation = usePage().props.organization;
const currentQuotation = usePage().props.quotation;
const currentInvoice = usePage().props.invoice;
const currentMovingJob = usePage().props.movingJob;
const currentClient = usePage().props.client;


const invoiceTypeOptions = [
  {
    name :"Acompte",
    value : "advance"
  },
  {
    name : "Solde",
    value : "balance"
  }
];

const invoice = useForm({
  type: currentInvoice.type,
  executing_company: currentInvoice.executing_company,
  amount_ht: currentInvoice.amount_ht,
  amount_ttc: currentInvoice.amount_ttc,
  amount_tva: currentInvoice.amount_tva,
});

const updateInvoice = () => {
  invoice.amount_ht = calculatePercentage(currentMovingJob.amount_ht, getAdvanceOrBalance(currentMovingJob.payment_process, invoice.type));
  invoice.amount_tva = calculatePercentage(invoice.amount_ht, currentSettings.vat);
  invoice.amount_ttc = calculateTTC(invoice.amount_ht, invoice.amount_tva);
  invoice.put(route("6dem.invoice.update", { id: currentInvoice.id }), {
    preserveScroll: true,
    replace: true,
    preserveState: true,
    onSuccess: () => console.log("invoice.update"),
    onError: (errors) => console.log(errors)
  });
};

const previewInvoice = () => {
  router.visit(route("6dem.documents.invoice.preview", currentInvoice.id), {
    method: "get",
    replace: true
  });
};
</script>