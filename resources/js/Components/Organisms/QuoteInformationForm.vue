<template>
  <div>
    <div class="flex flex-col space-y-5 p-10">
      <div class="grid grid-cols-3 gap-4 justify-between">
        <UploadFile
          class="w-1/2"
          label="Déposez ou cliquez si vous souhaitez ajouter votre logo"
        />
        <div class="p-2 h-auto">
          <div class="mb-2">
            <DocumentFieldInput
              placeholder="Adresse de la société"
              :modelValue="currentOrganisation.billing_address"
              v-model="organization.billing_address"
              :fontBold="true"
            />
          </div>
          <div class="mb-2">
            <DocumentFieldInput
              :modelValue="currentOrganisation.phone_number"
              v-model="organization.phone_number"
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
              v-model="organization.siren"
              placeholder="SIREN"
              :fontBold="true"
            />
          </div>
          <div class="mb-2">
            <DocumentFieldInput
              :modelValue="currentOrganisation.ape_code"
              v-model="organization.ape_code"
              placeholder="Code APE"
              :fontBold="true"
            />
          </div>
          <div class="mb-2">
            <DocumentFieldInput
              :modelValue="currentOrganisation.licence_number"
              v-model="organization.licence_number"
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
            <DocumentFieldInput
              :modelValue="'DEVIS N° ' + currentQuotation.number"
              v-model="quotation.number"
              :fontBold="true"
            />
          </DocumentFieldFrame>
          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput
                :modelValue="
                  'Conseiller: ' + user.first_name + ' ' + user.last_name
                "
                :fontBold="true"
              />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput
                :modelValue="'Tél: ' + user.phone_number"
                :fontBold="true"
              />
            </DocumentFieldFrame>
          </div>

          <DocumentFieldFrame>
            <DocumentFieldInput
              placeholder="Validité devis (7 jours, 1 mois ..)"
              v-model="movingjob.validity_duration"
              :fontBold="true"
              @savingValue="saveField('validity_duration')"
            />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Volume" v-model="movingjob.capacity" :fontBold="true" @savingValue="saveField('capacity')" />
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
              <DocumentFieldInput :modelValue="'Nom: ' + currentClient.last_name" :fontBold="true"/>
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Prénom: ' + currentClient.first_name" :fontBold="true" />
            </DocumentFieldFrame>
          </div>

          <DocumentFieldFrame>
            <DocumentFieldInput :modelValue="'Adresse: ' + currentClient.address" :fontBold="true" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Tel: ' + currentClient.phone_number" :fontBold="true" />
            </DocumentFieldFrame>
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Email: ' + currentClient.email" :fontBold="true" />
            </DocumentFieldFrame>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-20 justify-between">
        <div class="flex flex-col space-y-2">
          <DocumentLabel name="CHARGEMENT" color="#438A7A" />

          <label class="relative inline-flex items-center cursor-pointer">
            <input
              type="checkbox"
              @change="setLoadingAddress"
              class="sr-only peer"
            />
            <div
              class="w-11 h-6 bg-secondary peer-focus:outline-none peer-focus:ring-0 peer-focus:ring-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-none after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"
            ></div>
            <p class="text-sm ml-5 font-semibold leading-6 text-gray-900">
              Adresse de chargement identique à l'adresse du client ?
            </p>
          </label>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Adresse" v-model="movingjob.loading_address" :fontBold="true" @savingValue="saveField('loading_address')"/>
          </DocumentFieldFrame>

          <DocumentFieldFrame>
            <DocumentFieldInput
              placeholder="Date ou période"
              v-model="movingjob.loading_date"
              :fontBold="true"
              @savingValue="saveField('loading_date')"
            />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Étage" v-model="movingjob.loading_floor" :fontBold="true" @savingValue="saveField('loading_floor')"/>
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Ascenseur" v-model="movingjob.loading_elevator" :fontBold="true" @savingValue="saveField('loading_elevator')"/>
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Portage" v-model="movingjob.loading_portaging" :fontBold="true" @savingValue="saveField('loading_portaging')"/>
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Détails" v-model="movingjob.loading_details" :fontBold="true" @savingValue="saveField('loading_details')"/>
            </DocumentFieldFrame>
          </div>

          <DynamicQuoteFields :movingjob="currentMovingJob.id" :position="'loading'"/>
        </div>

        <div class="flex flex-col space-y-2">
          <DocumentLabel name="LIVRAISON" color="#438A7A" />
          <div class="pt-6"></div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Adresse" v-model="movingjob.shipping_address" :fontBold="true" @savingValue="saveField('shipping_address')"/>
          </DocumentFieldFrame>

          <DocumentFieldFrame>
            <DocumentFieldInput
              placeholder="Date ou période"
              v-model="movingjob.shipping_date"
              :fontBold="true"
              @savingValue="saveField('shipping_date')"
            />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Étage" v-model="movingjob.shipping_floor" :fontBold="true" @savingValue="saveField('shipping_floor')"/>
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Ascenseur" v-model="movingjob.shipping_elevator" :fontBold="true" @savingValue="saveField('shipping_elevator')"/>
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Portage" v-model="movingjob.shipping_portaging" :fontBold="true" @savingValue="saveField('shipping_portaging')"/>
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Détails" v-model="movingjob.shipping_details" :fontBold="true" @savingValue="saveField('shipping_details')"/>
            </DocumentFieldFrame>
          </div>

          <DynamicQuoteFields :movingjob="currentMovingJob.id" :position="'shipping'"/>
        </div>
      </div>
      <div class="flex flex-col mt-4 space-y-2">
        <DocumentLabel name="OPTIONS" color="#438A7A" />
      </div>
      <div class="flex flex-col space-y-2">
        <DynamicFields :movingjob="currentMovingJob.id"/>
      </div>
      <div class="flex flex-col mt-4 space-y-5">
        <DocumentLabel name="FINALISATION DU DEVIS" color="#438A7A" />
        <div class="flex space-x-2">
          <span class="w-2/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Assurance contractuelle'" :fontBold="true"/>
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput v-model="insuranceContractual.max_value" :modelValue="'Valeur max par objet : '+ currentInsuranceContractual.max_value" placeholder="Valeur max par objet" :fontBold="true" @savingValue="saveInsurance(currentInsuranceContractual.id,'max_value', 'contractual')"/>
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput v-model="insuranceContractual.franchise" :modelValue="'Franchise : '+ currentInsuranceContractual.franchise" placeholder="Franchise" :fontBold="true" @savingValue="saveInsurance(currentInsuranceContractual.id,'franchise', 'contractual')"/>
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput v-model="insuranceContractual.amount_ht" :modelValue="'Montant HT'+ currentInsuranceContractual.amount_ht" placeholder="Montant HT" :fontBold="true" @savingValue="saveInsurance(currentInsuranceContractual.id,'amount_ht', 'contractual')"/>
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="'Montant TTC'" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
        </div>
        <div class="flex space-x-2">
          <span class="w-2/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Assurance ad valorem'" :fontBold="true"/>
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput v-model="insuranceAdValorem.max_value" :modelValue="'Valeur max par objet : '+ currentInsuranceAdValorem.max_value" placeholder="Valeur max par objet" :fontBold="true" @savingValue="saveInsurance(currentInsuranceAdValorem.id,'max_value', 'adValorem')"/>
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput v-model="insuranceAdValorem.franchise" :modelValue="'Franchise : '+ currentInsuranceAdValorem.franchise" placeholder="Franchise" :fontBold="true" @savingValue="saveInsurance(currentInsuranceAdValorem.id,'franchise', 'adValorem')"/>
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput v-model="insuranceAdValorem.amount_ht" :modelValue="'Montant HT : '+ currentInsuranceAdValorem.amount_ht" placeholder="Montant HT" :fontBold="true" @savingValue="saveInsurance(currentInsuranceAdValorem.id,'amount_ht', 'adValorem')"/>
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="'Montant TTC'" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
        </div>
        <div class="flex space-x-2">
          <span class="w-2/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput
                placeholder="Tarification"
                :fontBold="true"
              />
            </DocumentFieldFrame>
          </span>
          <span class="w-2/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Remise en %" v-model="movingjob.discount_percentage" :fontBold="true" @savingValue="saveField('discount_percentage')"/>
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant HT" v-model="movingjob.discount_amount_ht" :fontBold="true" @savingValue="saveField('discount_amount_ht')"/>
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
              <DocumentFieldInput
                :modelValue="'Modalités de règlement'"
                :fontBold="true"
              />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/4 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Acompte en %" v-model="movingjob.advance" :fontBold="true" @savingValue="saveField('advance')"/>
            </DocumentFieldFrame>
          </span>
          <span class="w-1/4 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Solde en %" v-model="movingjob.balance" :fontBold="true" @savingValue="saveField('balance')"/>
            </DocumentFieldFrame>
          </span>
        </div>
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
import "vue-select/dist/vue-select.css";
import { reactive, ref } from "vue";

const user = usePage().props.auth.user;
const currentOrganisation = usePage().props.organization;
const currentQuotation = usePage().props.quotation;
const currentMovingJob = usePage().props.movingJob;
const currentClient = usePage().props.client;
const currentOption = usePage().props.options;
const currentInsuranceContractual = usePage().props.insurances.find(insurance => insurance.type === "contractual");
const currentInsuranceAdValorem = usePage().props.insurances.find(insurance => insurance.type === "ad_valorem");

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
  max_value: "",
  franchise: "",
  amount_ht: ""
});

const insuranceAdValorem = useForm({
  max_value: "",
  franchise: "",
  amount_ht: ""
});

const movingjob = useForm({
  validity_duration: currentMovingJob.validity_duration,
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
  movingjob.put(route("6dem.quotation.update", {id : currentQuotation.id, field: field}), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("saved"),
    onError: (errors) => console.log(errors)
  });
};

const saveFormula = (formula) => {
  movingjob.formula = formula.title;
  console.log(movingjob.formula);
  movingjob.put(route("6dem.quotation.update", {id : currentQuotation.id, field: 'formula'}), {
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

let timeout;
/*watch(
  () => quotation.validity_duratation,
  (newValue, oldValue) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
      console.log("Search query stopped changing:", newValue);
      const result = Inertia.put(
        route("6dem.quotation.update", {
          id: currentQuotation.id,
          field: "validity_duratation",
        }),
        {
          validity_duratation: newValue,
        }
      );
      console.log(result);
    }, 1500);
  }
);*/
</script>