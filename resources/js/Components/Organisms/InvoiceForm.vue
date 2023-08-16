<template>
  <div class="px-28">
    <div class="pt-14 grid justify-items-center">
      <UploadFile class="w-1/6" label="Déposez ou cliquez si vous souhaitez ajouter votre logo" />
    </div>
    <div class="flex flex-col space-y-5 px-10 pb-5 mt-24">
      <div class="text-center text-4xl font-bold pb-2">
        <h1>Informations pré-remplies</h1>
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
            <DocumentFieldInput v-model="movingjob.loading_date" placeholder="Date de chargement"
              :value="currentMovingJob.loading_date" :fontBold="true" @savingValue="saveField('loading_date')" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Date de livraison" v-model="movingjob.shipping_date"
              :value="currentMovingJob.shipping_date" :fontBold="true" @savingValue="saveField('shipping_date')" />
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
      <DocumentLabel name="Désignation" color="#438A7A" />
      <div v-if="currentClient.type == 'individual'">
        <DocumentSelectInput v-model="movingjob.formula" :value="movingjob.formula" @change="saveFormula" :options="formulaOptions" default-text="Formule de déménagament"/>
      </div>
      <div class="flex flex-col space-y-2 pb-8">
        <DynamicFields />
      </div>
      <DocumentLabel name="Assurances (optionnel)" color="#438A7A" />
      <div class="flex space-x-2">
        <span class="w-2/6 p-1">
          <DocumentFieldFrame>
            <DocumentFieldInput :value="'Assurance contractuelle'" />
          </DocumentFieldFrame>
        </span>
        <span class="w-1/6 p-1">
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Valeur max par objet" v-model="insuranceContractual.max_value"
              :value="currentInsuranceContractual.max_value" :fontBold="true"
              @savingValue="saveInsurance(currentInsuranceContractual.id, 'max_value', 'contractual')" />
          </DocumentFieldFrame>
        </span>
        <span class="w-1/6 p-1">
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Franchise" v-model="insuranceContractual.franchise"
              :value="currentInsuranceContractual.franchise" :fontBold="true"
              @savingValue="saveInsurance(currentInsuranceContractual.id, 'franchise', 'contractual')" />
          </DocumentFieldFrame>
        </span>
        <span class="w-1/6 p-1">
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Montant HT" v-model="amount_ht" @updated:value="updateTTC"
              :value="currentInsuranceContractual.amount_ht" :fontBold="true"
              @savingValue="saveInsurance(currentInsuranceContractual.id, 'amount_ht', 'contractual')" />
          </DocumentFieldFrame>
        </span>
        <span class="w-1/6 p-1">
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Montant TTC" :value="contractualTTC" :fontBold="true" />
          </DocumentFieldFrame>
        </span>
      </div>
      <div class="flex space-x-2">
        <span class="w-2/6 p-1">
          <DocumentFieldFrame>
            <DocumentFieldInput :value="'Assurance ad valorem'" />
          </DocumentFieldFrame>
        </span>
        <span class="w-1/6 p-1">
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Valeur max par objet" v-model="insuranceAdValorem.max_value"
              :value="currentInsuranceAdValorem.max_value" :fontBold="true"
              @savingValue="saveInsurance(currentInsuranceAdValorem.id, 'max_value', 'adValorem')" />
          </DocumentFieldFrame>
        </span>
        <span class="w-1/6 p-1">
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Franchise" v-model="insuranceAdValorem.franchise"
              :value="currentInsuranceAdValorem.franchise" :fontBold="true"
              @savingValue="saveInsurance(currentInsuranceAdValorem.id, 'franchise', 'adValorem')" />
          </DocumentFieldFrame>
        </span>
        <span class="w-1/6 p-1">
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Montant HT" v-model="insuranceAdValorem.amount_ht"
              :value="currentInsuranceAdValorem.amount_ht" :fontBold="true"
              @savingValue="saveInsurance(currentInsuranceAdValorem.id, 'amount_ht', 'adValorem')" />
          </DocumentFieldFrame>
        </span>
        <span class="w-1/6 p-1">
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Montant TTC" :value="insuranceAdValorem.amount_ht * vat"
              :fontBold="true" />
          </DocumentFieldFrame>
        </span>
      </div>
    </div>
    <div class="flex flex-col space-y-5 px-10 pb-8 mt-16">
      <div class="text-center text-4xl font-bold pb-5">
        <h1>Informations à remplir</h1>
      </div>
      <DocumentLabel name="Facture" color="#438A7A" />
      <div class="grid grid-cols-3 gap-6 pb-5 justify-between">
        <div>
          <DocumentSelectInput v-model="invoice.type" :value="invoice.type" @change="saveInvoiceType" :options="invoiceTypeOptions" default-text="Type de facture"/>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentMovingJob.capacity" placeholder="Volume(en m³)"
              v-model="movingjob.capacity" :fontBold="true" @savingValue="saveField('capacity')" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Distance" />
          </DocumentFieldFrame>
        </div>
      </div>
      <DocumentLabel name="Prix total" color="#438A7A" />
      <div class="grid grid-cols-2 gap-6 pb-5 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput v-model="currentInvoice.amount_ht" :value="currentInvoice.amount_ht"
              placeholder="Montant HT" :fontBold="true" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Montant TTC" />
          </DocumentFieldFrame>
        </div>
      </div>
    </div>
    <div class="flex flex-row w-1/6 pb-10 mt-10 mx-auto">
      <DefaultButton @click="previewInvoice" buttontext="Générer le document" />
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
import DynamicFields from "@/Components/Organisms/DynamicFields.vue";
import DocumentSelectInput from "@/Components/Atoms/DocumentSelectInput.vue";
import SelectInvoiceType from "@/Components/Atoms/SelectInvoiceType.vue";
import 'vue-select/dist/vue-select.css';
import { reactive, ref, onMounted, computed } from "vue";


const user = usePage().props.auth.user;
const currentOrganisation = usePage().props.organization;
const currentInvoice = usePage().props.invoice;
const currentMovingJob = usePage().props.movingJob;
const currentClient = usePage().props.client;
const currentInsuranceContractual = usePage().props.insurances.find(insurance => insurance.type === "contractual");
const currentInsuranceAdValorem = usePage().props.insurances.find(insurance => insurance.type === "ad_valorem");
const movingJobFormulas = usePage().props.movingJobFormulas;

const formulaOptions = movingJobFormulas.map(item => ({
  name: item.name,
  value: item.slug
}));

const invoiceTypeOptions = [
    {
      name :"Acompte",
      value : "acompte"
    },
    {
      name : "Solde",
      value : "solde"
    }
  ];

const vat = ref(2);
const amount_ht = ref(2);

const insuranceContractual = useForm({
  max_value: currentInsuranceContractual.max_value,
  franchise: currentInsuranceContractual.franchise,
  amount_ht: currentInsuranceContractual.amount_ht,
  amount_ttc: currentInsuranceContractual.amount_ht * vat.value,
});

const contractualTTC = computed(() => {
  return amount_ht;
});

const insuranceAdValorem = useForm({
  max_value: currentInsuranceAdValorem.max_value,
  franchise: currentInsuranceAdValorem.franchise,
  amount_ht: currentInsuranceAdValorem.amount_ht
});

const movingjob = useForm({
  capacity: currentMovingJob.capacity,
  formula: currentMovingJob.formula,
  loading_address: currentMovingJob.loading_address,
  loading_date: currentMovingJob.loading_date,
  loading_floor: currentMovingJob.loading_floor,
  loading_elevator: currentMovingJob.loading_elevator,
  loading_portaging: currentMovingJob.loading_portaging,
  loading_details: currentMovingJob.loading_details,
  shipping_address: currentMovingJob.shipping_address,
  shipping_date: currentMovingJob.shipping_date,
  shipping_floor: currentMovingJob.shipping_floor,
  shipping_elevator: currentMovingJob.shipping_elevator,
  shipping_portaging: currentMovingJob.shipping_portaging,
  shipping_details: currentMovingJob.shipping_details,
  discount_percentage: currentMovingJob.discount_percentage,
  discount_amount_ht: currentMovingJob.discount_amount_ht,
  advance: currentMovingJob.advance,
  balance: currentMovingJob.balance
});

const invoice = useForm({
  type: currentInvoice.type ? currentInvoice.type : "",
  executing_company: currentInvoice.executing_company,
  amount_ht: currentInvoice.amount_ht
});

const saveField = (field) => {
  console.log(movingjob[field]);
  movingjob.put(route("6dem.invoice.update", { id: currentInvoice.id, field: field }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("saved"),
  });
};

const saveInvoiceType = () => {
  invoice.put(route("6dem.invoice.update", { id: currentInvoice.id, field: 'type' }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("saved"),
    onError: (errors) => console.log(errors)
  });
};

const saveFormula = () => {
  movingjob.put(route("6dem.invoice.update", { id: currentInvoice.id, field: 'formula' }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("saved"),
    onError: (errors) => console.log(errors)
  });
};


const saveInsurance = (id, field, type) => {
  if (type === 'contractual') {
    insuranceContractual.put(route("6dem.insurance.update", { id: id, field: field }), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => console.log("saved"),
      onError: (errors) => console.log(errors)
    });
  } else {
    insuranceAdValorem.put(route("6dem.insurance.update", { id: id, field: field }), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => console.log("saved"),
      onError: (errors) => console.log(errors)
    });
  }
};

const setLoadingAddressData = (location) => {
  movingjob.loading_address = location.fullAddress;
  saveField('loading_address');
};

const setShippingAddressData = (location) => {
  movingjob.shipping_address = location.fullAddress;
  saveField('shipping_address');
};

const updateTTC = () => {
  insuranceContractual.amount_ttc = insuranceContractual.amount_ht * vat.value;
};

const previewInvoice = () => {
  router.visit(route("6dem.documents.invoice.preview", currentInvoice.id), {
    method: "get",
  });
};
</script>