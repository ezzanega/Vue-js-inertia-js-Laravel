<template>
  <div>
    <pre>
           {{ currentOrganisation }}
        </pre>
    <div class="flex flex-col space-y-5 p-10">
      <div class="grid grid-cols-3 gap-4 justify-between">
        <UploadFile class="w-1/2" label="Déposez ou cliquez si vous souhaitez ajouter votre logo" />
        <div class="p-2 h-auto">
          <div class="mb-2">
            <DocumentFieldInput
              placeholder="Adresse de la société"
              :modelValue="currentOrganisation.billing_address.full_address"
              :fontBold="true"
            />
          </div>
          <div class="mb-2">
            <DocumentFieldInput
              :modelValue="currentOrganisation.phone_number"
              placeholder="Téléphone"
              :fontBold="true"
            />
          </div>
          <div class="mb-2">
            <DocumentFieldInput
              placeholder="Adresse mail"
              :modelValue="currentOrganisation.email"
              v-model="organization.email"
              :fontBold="true"
            />
          </div>
          <DynamicHeaderFields :movingjob="currentMovingJob.id" :position="'header-left'"/>
        </div>
        <div class="p-2 h-auto">
          <div class="mb-2">
            <DocumentFieldInput
              :modelValue="currentOrganisation.siren"
              placeholder="SIREN"
              :fontBold="true"
            />
          </div>
          <div class="mb-2">
            <DocumentFieldInput
              :modelValue="currentOrganisation.ape_code"
              placeholder="Code APE"
              :fontBold="true"
            />
          </div>
          <div class="mb-2">
            <DocumentFieldInput
              :modelValue="currentOrganisation.licence_number"
              placeholder="Licence N°"
              :fontBold="true"
            />
          </div>
          <DynamicHeaderFields :movingjob="currentMovingJob.id" :position="'header-right'"/>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-20 pb-5 justify-between">
        <div class="flex flex-col space-y-2">
          <DocumentFieldFrame>
            <DocumentFieldInput :modelValue="'LETTRE DE VOITURE N° ' + currentWaybill.number" :fontBold="true" />
          </DocumentFieldFrame>

          <DocumentFieldFrame>
            <SelectOperative />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Volume: ' + currentMovingJob.capacity"  placeholder="Volume(en m³)" :fontBold="true" />
            </DocumentFieldFrame>
            
            <DocumentFieldFrame>
              <SelectFormulas @savingFormula="saveFormula"/>
            </DocumentFieldFrame>
          </div>
        </div>

        <div class="flex flex-col space-y-2">
          <DocumentFieldFrame>
            <DocumentFieldInput modelValue="Client" :fontBold="true" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Nom: ' + currentClient.last_name" placeholder="Nom" :fontBold="true"/>
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Prénom: ' + currentClient.first_name" placeholder="Prénom" :fontBold="true" />
            </DocumentFieldFrame>
          </div>

          <DocumentFieldFrame>
            <DocumentFieldInput :modelValue="'Adresse: ' + currentClient.address.full_address" placeholder="Adresse" :fontBold="true" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Tel: ' + currentClient.phone_number" placeholder="Téléphone" :fontBold="true" />
            </DocumentFieldFrame>
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Email: ' + currentClient.email" placeholder="Email" :fontBold="true" />
            </DocumentFieldFrame>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-20 justify-between">
        <div class="flex flex-col space-y-2">
          <DocumentLabel name="CHARGEMENT" color="#438A7A" />

          <DocumentFieldFrame>
            <DocumentFieldInput v-model="movingjob.loading_address" placeholder="Adresse de chargement" :modelValue="'Adresse: ' + currentMovingJob.loading_address" :fontBold="true" @savingValue="saveField('loading_address')" />
          </DocumentFieldFrame>

          <DocumentFieldFrame>
            <DocumentFieldInput v-model="movingjob.loading_date" placeholder="Date de chargement" :modelValue="'Date ou période: ' + currentMovingJob.loading_date" :fontBold="true" @savingValue="saveField('loading_date')" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput v-model="movingjob.loading_floor" placeholder="Étage" :modelValue="'Étage: ' + currentMovingJob.loading_floor" :fontBold="true" @savingValue="saveField('loading_floor')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput v-model="movingjob.loading_elevator" placeholder="Ascenceur" :modelValue="'Ascenseur: ' + currentMovingJob.loading_elevator" :fontBold="true" @savingValue="saveField('loading_elevator')" />
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput v-model="movingjob.loading_portaging" placeholder="Portage" :modelValue="'Portage: ' + currentMovingJob.loading_portaging" :fontBold="true" @savingValue="saveField('loading_portaging')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput v-model="movingjob.loading_details" placeholder="Détails" :modelValue="'Détails: ' + currentMovingJob.loading_details" :fontBold="true" @savingValue="saveField('loading_details')" />
            </DocumentFieldFrame>
          </div>

          <DynamicQuoteFields :movingjob="currentMovingJob.id" :position="'loading'"/>
        </div>

        <div class="flex flex-col space-y-2">
          <DocumentLabel name="LIVRAISON" color="#438A7A" />
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Adresse de livraison" v-model="movingjob.shipping_address" :modelValue="'Adresse: ' + currentMovingJob.shipping_address" :fontBold="true" @savingValue="saveField('shipping_address')" />
          </DocumentFieldFrame>

          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Date de livraison" v-model="movingjob.shipping_date" :modelValue="'Date ou période: ' + currentMovingJob.shipping_date" :fontBold="true" @savingValue="saveField('shipping_date')" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Étage" v-model="movingjob.shipping_floor" :modelValue="'Étage: ' + currentMovingJob.shipping_floor" :fontBold="true" @savingValue="saveField('shipping_floor')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Ascenseur" v-model="movingjob.shipping_elevator" :modelValue="'Ascenseur: ' + currentMovingJob.shipping_elevator" :fontBold="true" @savingValue="saveField('shipping_elevator')" />
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Portage" v-model="movingjob.shipping_portaging" :modelValue="'Portage: ' + currentMovingJob.shipping_portaging" :fontBold="true" @savingValue="saveField('shipping_portaging')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Détails" v-model="movingjob.shipping_details" :modelValue="'Détails: ' + currentMovingJob.shipping_details" :fontBold="true" @savingValue="saveField('shipping_details')" />
            </DocumentFieldFrame>
          </div>

          <DynamicQuoteFields :movingjob="currentMovingJob.id" :position="'shipping'"/>
        </div>
      </div>
      <div class="flex flex-col mt-4 space-y-2">
        <DocumentLabel name="OPTIONS" color="#438A7A" />
      </div>
      <div class="flex flex-col space-y-2">
        <DynamicFields />
      </div>
      <div class="flex flex-col mt-4 space-y-5">
        <DocumentLabel name="FINALISATION DU DEVIS" color="#438A7A" />
        <div class="flex space-x-2">
          <span class="w-2/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Assurance contractuelle'" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Valeur max par objet" v-model="insuranceContractual.max_value" :modelValue="'Valeur max par objet: ' + currentInsuranceContractual.max_value" :fontBold="true" @savingValue="saveInsurance(currentInsuranceContractual.id,'max_value', 'contractual')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Franchise" v-model="insuranceContractual.franchise" :modelValue="'Franchise: ' + currentInsuranceContractual.franchise" :fontBold="true" @savingValue="saveInsurance(currentInsuranceContractual.id,'franchise', 'contractual')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant HT" v-model="amount_ht" @updated:modelValue="updateTTC" :modelValue="'Montant HT: ' + currentInsuranceContractual.amount_ht" :fontBold="true" @savingValue="saveInsurance(currentInsuranceContractual.id,'amount_ht', 'contractual')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant TTC" :modelValue="contractualTTC" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
        </div>
        <div class="flex space-x-2">
          <span class="w-2/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Assurance ad valorem'" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Valeur max par objet" v-model="insuranceAdValorem.max_value" :modelValue="'Valeur max par objet: ' + currentInsuranceAdValorem.max_value" :fontBold="true" @savingValue="saveInsurance(currentInsuranceAdValorem.id,'max_value', 'adValorem')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Franchise" v-model="insuranceAdValorem.franchise" :modelValue="'Franchise: ' + currentInsuranceAdValorem.franchise" :fontBold="true" @savingValue="saveInsurance(currentInsuranceAdValorem.id,'franchise', 'adValorem')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant HT" v-model="insuranceAdValorem.amount_ht" :modelValue="'Montant HT: ' + currentInsuranceAdValorem.amount_ht" :fontBold="true" @savingValue="saveInsurance(currentInsuranceAdValorem.id,'amount_ht', 'adValorem')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant TTC" :modelValue="'Montant TTC: ' + insuranceAdValorem.amount_ht*vat" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
        </div>
        <div class="flex space-x-2">
          <span class="w-2/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Tarification'" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-2/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Remise en %" v-model="movingjob.discount_percentage" :modelValue="'Remise en %: ' + currentMovingJob.discount_percentage" :fontBold="true" @savingValue="saveField('discount_percentage')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant HT" v-model="movingjob.discount_amount_ht" :modelValue="'Montant HT: ' + currentMovingJob.discount_amount_ht" :fontBold="true" @savingValue="saveField('discount_amount_ht')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant TTC" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
        </div>
        <div class="flex space-x-2">
          <span class="w-1/2 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Modalités de règlement'" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/4 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Acompte en %" v-model="movingjob.advance" :modelValue="'Acompte en %: ' + currentMovingJob.advance" :fontBold="true" @savingValue="saveField('advance')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/4 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Solde en %" v-model="movingjob.balance" :modelValue="'Solde en %: ' + currentMovingJob.balance" :fontBold="true" @savingValue="saveField('balance')" />
            </DocumentFieldFrame>
          </span>
        </div>
        <pre>
          {{ insuranceContractual }}
        </pre>
      </div>
    </div>
  </div>
</template>

<script setup>
import { usePage, useForm } from "@inertiajs/vue3";
import UploadFile from "@/Components/Atoms/UploadFile.vue";
import DocumentFieldFrame from "@/Components/Atoms/DocumentFieldFrame.vue";
import DynamicHeaderFields from "@/Components/Organisms/DynamicHeaderFields.vue";
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";
import DocumentLabel from "@/Components/Atoms/DocumentLabel.vue";
import DynamicFields from "@/Components/Organisms/DynamicFields.vue";
import DynamicQuoteFields from "@/Components/Organisms/DynamicQuoteFields.vue";
import SelectFormulas from "@/Components/Atoms/SelectFormulas.vue";
import SelectOperative from "@/Components/Atoms/SelectOperative.vue";
import 'vue-select/dist/vue-select.css';
import { reactive, ref, watch, computed } from "vue";

const user = usePage().props.auth.user;
const currentOrganisation = usePage().props.organization;
const currentWaybill= usePage().props.waybill;
const currentMovingJob = usePage().props.movingJob;
const currentClient = usePage().props.client;
const currentInsuranceContractual = usePage().props.insurances.find(insurance => insurance.type === "contractual");
const currentInsuranceAdValorem = usePage().props.insurances.find(insurance => insurance.type === "ad_valorem");

const vat = ref(2);
const amount_ht = ref(2);

const organization = reactive({
  name: "",
  siret: "",
  siren: "",
  ape_code: "",
  address: "",
  billing_address: "",
  phone_number: "",
  email: "",
});

const insuranceContractual = useForm({
  max_value: currentInsuranceContractual.max_value,
  franchise: currentInsuranceContractual.franchise,
  amount_ht: currentInsuranceContractual.amount_ht,
  amount_ttc: currentInsuranceContractual.amount_ht*vat.value,
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

const newQuotation = reactive({
  validity_duratation: ""
});

const form = reactive({
  clientType: "individual",
  firstName: "",
  lastName: "",
  phoneNumber: "",
  email: "",
  address: "",
  source: "",
  clientOrganizationName: "",
  siret: "",
  siren: "",
});


const saveField = (field) => {
  console.log(movingjob[field]);
  movingjob.put(route("6dem.waybill.update", {id : currentWaybill.id, field: field}), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("saved"),
  });
};

const saveFormula = (formula) => {
  movingjob.formula = formula.title;
  console.log(movingjob.formula);
  movingjob.put(route("6dem.waybill.update", {id : currentWaybill.id, field: 'formula'}), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("saved"),
    onError: (errors) => console.log(errors)
  });
};

const saveInsurance = (id, field, type) => {
  if (type === 'contractual'){
    insuranceContractual.put(route("6dem.insurance.update", {id : id, field: field}), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => console.log("saved"),
      onError: (errors) => console.log(errors)
    });
  }else{
    insuranceAdValorem.put(route("6dem.insurance.update", {id : id, field: field}), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => console.log("saved"),
      onError: (errors) => console.log(errors)
    });
  }
};

const updateTTC = () => {
  insuranceContractual.amount_ttc = insuranceContractual.amount_ht*vat.value;
};

/* watch(
  () => insuranceContractual.amount_ht,
  (amount_ht) => {
    insuranceContractual.amount_ttc = ""+amount_ht*vat.value;
    console.log(insuranceContractual.amount_ttc);
  }
) */

</script>