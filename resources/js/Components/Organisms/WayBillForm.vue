<template>
  <div class="px-28">
    <div class="pt-14 grid justify-items-center">
      <UploadFile class="w-1/6" label="Déposez ou cliquez si vous souhaitez ajouter votre logo" />
    </div>
    <div class="flex flex-col space-y-5 px-10 mt-24">
      <div class="text-center text-4xl font-bold pb-5">
        <h1>Informations pré-remplies</h1>
      </div>
      <div class="grid grid-cols-3 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :modelValue="'LETTRE DE VOITURE N° ' + currentWaybill.number"
              placeholder="N° de la lettre de voiture" :font-bold="true" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :modelValue="currentOrganisation.phone_number" placeholder="Téléphone" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Adresse mail" :modelValue="currentOrganisation.email" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :modelValue="currentOrganisation.siren" placeholder="SIREN" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :modelValue="currentOrganisation.code_ape" placeholder="Code APE" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :modelValue="currentOrganisation.licence_number" placeholder="Licence N°" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div>
        <DocumentFieldFrame>
          <DocumentFieldInput placeholder="Adresse de la société"
            :modelValue="currentOrganisation.billing_address.full_address" />
        </DocumentFieldFrame>
      </div>
      <div class="grid grid-cols-3 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Prénom" :modelValue="currentClient.first_name" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Nom" :modelValue="currentClient.last_name" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Téléphone" :modelValue="currentClient.phone_number" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div v-if="currentClient.type == 'professional'">
        <DocumentFieldFrame>
          <DocumentFieldInput placeholder="Nom complet du client/de l'entreprise"
            :modelValue="currentClient.client_organization.name" />
        </DocumentFieldFrame>
      </div>
      <div>
        <DocumentFieldFrame>
          <DocumentFieldInput placeholder="Adresse du client" :modelValue="currentClient.address.full_address" />
        </DocumentFieldFrame>
      </div>
    </div>
    <div class="flex flex-col space-y-5 px-10 mt-16">
      <div class="text-center text-4xl font-bold pb-5">
        <h1>Informations à remplir</h1>
      </div>
      <DocumentLabel name="Lettre de voiture" color="#438A7A" />
      <DocumentFieldFrame>
        <SelectOperative @savingExecutingCompany="saveExecutingCompany" />
      </DocumentFieldFrame>
      <div v-if="currentClient.type == 'individual'">
        <div class="grid grid-cols-3 gap-6 pb-5 justify-between">
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Distance" />
            </DocumentFieldFrame>
          </div>
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="currentMovingJob.capacity" placeholder="Volume(en m³)" :fontBold="true" />
            </DocumentFieldFrame>
          </div>
          <div>
            <DocumentFieldFrame>
              <SelectFormulas @savingFormula="saveFormula" />
            </DocumentFieldFrame>
          </div>
        </div>
      </div>
      <div v-else>
        <div class="grid grid-cols-2 gap-6 pb-5 justify-between">
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Distance" />
            </DocumentFieldFrame>
          </div>
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="currentMovingJob.capacity" placeholder="Volume(en m³)" :fontBold="true" />
            </DocumentFieldFrame>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-20 justify-between">
        <div class="flex flex-col space-y-2">
          <DocumentLabel name="Chargement" color="#438A7A" />

          <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" @change="setLoadingAddress" class="sr-only peer" />
            <div
              class="w-11 h-6 bg-secondary peer-focus:outline-none peer-focus:ring-0 peer-focus:ring-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-none after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
            </div>
            <p class="text-sm ml-5 font-semibold leading-6 text-gray-900">
              Adresse de chargement identique à l'adresse du client ?
            </p>
          </label>
          <DocumentFieldFrame>
            <DocumentFieldInputAddress :required="true" name="loading_address" :value="currentMovingJob.loading_address"
              placeholder="Adresse de chargement" @place_changed="setLoadingAddressData" />
          </DocumentFieldFrame>

          <DocumentFieldFrame>
            <DocumentFieldInput v-model="movingjob.loading_date" placeholder="Date de chargement"
              :modelValue="currentMovingJob.loading_date" :fontBold="true" @savingValue="saveField('loading_date')" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput v-model="movingjob.loading_floor" placeholder="Étage"
                :modelValue="currentMovingJob.loading_floor" :fontBold="true" @savingValue="saveField('loading_floor')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput v-model="movingjob.loading_elevator" placeholder="Ascenceur"
                :modelValue="currentMovingJob.loading_elevator" :fontBold="true"
                @savingValue="saveField('loading_elevator')" />
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput v-model="movingjob.loading_portaging" placeholder="Portage"
                :modelValue="currentMovingJob.loading_portaging" :fontBold="true"
                @savingValue="saveField('loading_portaging')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput v-model="movingjob.loading_details" placeholder="Détails"
                :modelValue="currentMovingJob.loading_details" :fontBold="true"
                @savingValue="saveField('loading_details')" />
            </DocumentFieldFrame>
          </div>

          <DynamicQuoteFields :movingjob="currentMovingJob.id" :position="'loading'" />
        </div>

        <div class="flex flex-col space-y-2">
          <DocumentLabel name="Livraison" color="#438A7A" />
          <div class="pt-6"></div>
          <DocumentFieldFrame>
            <DocumentFieldInputAddress :required="true" :value="currentMovingJob.shipping_address" name="shipping_address"
              placeholder="Adresse de livraison" @place_changed="setShippingAddressData" />
          </DocumentFieldFrame>

          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Date de livraison" v-model="movingjob.shipping_date"
              :modelValue="currentMovingJob.shipping_date" :fontBold="true" @savingValue="saveField('shipping_date')" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Étage" v-model="movingjob.shipping_floor"
                :modelValue="currentMovingJob.shipping_floor" :fontBold="true"
                @savingValue="saveField('shipping_floor')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Ascenseur" v-model="movingjob.shipping_elevator"
                :modelValue="currentMovingJob.shipping_elevator" :fontBold="true"
                @savingValue="saveField('shipping_elevator')" />
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Portage" v-model="movingjob.shipping_portaging"
                :modelValue="currentMovingJob.shipping_portaging" :fontBold="true"
                @savingValue="saveField('shipping_portaging')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Détails" v-model="movingjob.shipping_details"
                :modelValue="currentMovingJob.shipping_details" :fontBold="true"
                @savingValue="saveField('shipping_details')" />
            </DocumentFieldFrame>
          </div>

          <DynamicQuoteFields :movingjob="currentMovingJob.id" :position="'shipping'" />
        </div>
      </div>
    </div>
    <div class="flex flex-col space-y-5 px-10 mt-8">
      <div class="flex flex-col mt-4 space-y-5">
        <DocumentLabel name="Options" color="#438A7A" />
      </div>
      <div class="flex flex-col space-y-2">
        <DynamicFields />
      </div>
    </div>
    <div class="flex flex-col space-y-5 px-10 mt-8">
      <div class="flex flex-col mt-4 space-y-5">
        <DocumentLabel name="Assurances (optionnel)" color="#438A7A" />
        <div class="flex space-x-2">
          <span class="w-2/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Assurance contractuelle'" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Valeur max par objet" v-model="insuranceContractual.max_value"
                :modelValue="currentInsuranceContractual.max_value" :fontBold="true"
                @savingValue="saveInsurance(currentInsuranceContractual.id, 'max_value', 'contractual')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Franchise" v-model="insuranceContractual.franchise"
                :modelValue="currentInsuranceContractual.franchise" :fontBold="true"
                @savingValue="saveInsurance(currentInsuranceContractual.id, 'franchise', 'contractual')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant HT" v-model="amount_ht" @updated:modelValue="updateTTC"
                :modelValue="currentInsuranceContractual.amount_ht" :fontBold="true"
                @savingValue="saveInsurance(currentInsuranceContractual.id, 'amount_ht', 'contractual')" />
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
              <DocumentFieldInput :modelValue="'Assurance ad valorem'" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Valeur max par objet" v-model="insuranceAdValorem.max_value"
                :modelValue="currentInsuranceAdValorem.max_value" :fontBold="true"
                @savingValue="saveInsurance(currentInsuranceAdValorem.id, 'max_value', 'adValorem')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Franchise" v-model="insuranceAdValorem.franchise"
                :modelValue="currentInsuranceAdValorem.franchise" :fontBold="true"
                @savingValue="saveInsurance(currentInsuranceAdValorem.id, 'franchise', 'adValorem')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant HT" v-model="insuranceAdValorem.amount_ht"
                :modelValue="currentInsuranceAdValorem.amount_ht" :fontBold="true"
                @savingValue="saveInsurance(currentInsuranceAdValorem.id, 'amount_ht', 'adValorem')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant TTC" :modelValue="insuranceAdValorem.amount_ht * vat"
                :fontBold="true" />
            </DocumentFieldFrame>
          </span>
        </div>
      </div>
    </div>
    <div class="flex flex-col px-10 pb-10 mt-10">
      <div class="flex flex-col space-y-5 px-16">
        <DocumentLabel name="Finalisation du devis" color="#438A7A" />
        <div class="grid grid-cols-4 gap-6 justify-between">
          <div class="space-y-5">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Tarification'" />
            </DocumentFieldFrame>
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Modalités de règlement'" />
            </DocumentFieldFrame>
          </div>
          <div>
            <DocumentFieldFrame :className="'h-full'">
              <DocumentFieldInput :className="'h-full'" placeholder="Remise en %" v-model="movingjob.discount_percentage"
                :modelValue="currentMovingJob.discount_percentage" :fontBold="true"
                @savingValue="saveField('discount_percentage')" />
            </DocumentFieldFrame>
          </div>
          <div class="space-y-5">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Acompte en %" v-model="movingjob.advance"
                :modelValue="currentMovingJob.advance" :fontBold="true" @savingValue="saveField('advance')" />
            </DocumentFieldFrame>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant HT" v-model="movingjob.discount_amount_ht"
                @savingValue="saveField('discount_amount_ht')" />
            </DocumentFieldFrame>
          </div>
          <div class="space-y-5">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Solde en %" v-model="movingjob.balance"
                :modelValue="currentMovingJob.balance" :fontBold="true" @savingValue="saveField('balance')" />
            </DocumentFieldFrame>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant TTC" :fontBold="true" />
            </DocumentFieldFrame>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-row w-1/6 pb-10 mt-10 mx-auto">
      <DefaultButton @click="previewWaybill" buttontext="Générer le document" />
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
import DynamicQuoteFields from "@/Components/Organisms/DynamicQuoteFields.vue";
import SelectFormulas from "@/Components/Atoms/SelectFormulas.vue";
import SelectOperative from "@/Components/Atoms/SelectOperative.vue";
import 'vue-select/dist/vue-select.css';
import { reactive, ref, onMounted, computed } from "vue";


const user = usePage().props.auth.user;
const currentOrganisation = usePage().props.organization;
const currentWaybill = usePage().props.waybill;
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

const newWaybill = useForm({
  executing_company_id: ""
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
  movingjob.put(route("6dem.waybill.update", { id: currentWaybill.id, field: field }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("saved"),
  });
};

const saveFormula = (formula) => {
  movingjob.formula = formula.title;
  console.log(movingjob.formula);
  movingjob.put(route("6dem.waybill.update", { id: currentWaybill.id, field: 'formula' }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("saved"),
    onError: (errors) => console.log(errors)
  });
};

const saveExecutingCompany = (executinCompany) => {
  newWaybill.executing_company_id = executinCompany.id;
  console.log(newWaybill.executing_company_id);
  newWaybill.put(route("6dem.waybill.update", { id: currentWaybill.id, field: 'executing_company_id' }), {
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

const previewWaybill = () => {
  router.visit(route("6dem.documents.waybill.preview", currentWaybill.id), {
    method: "get",
  });
};

/*onMounted(() => {
  calculateDistance();
})

const  calculateDistance = async () => {
      try {
        const { data: data1 } = await axios.get(`https://maps.googleapis.com/maps/api/geocode/json?address=${currentOrganisation.billing_address.full_address}&key=${`GooglAIzaSyC7TOs-73yQEUsNqVchkrvTr6I5gxYF5kEe_Maps_API_Key`}`);
        const { data: data2 } = await axios.get(`https://maps.googleapis.com/maps/api/geocode/json?address=${currentClient.address.full_address}&key=${`AIzaSyC7TOs-73yQEUsNqVchkrvTr6I5gxYF5kE`}`);
        
        const lat1 = data1.results[0].geometry.location.lat;
        const lng1 = data1.results[0].geometry.location.lng;
        const lat2 = data2.results[0].geometry.location.lat;
        const lng2 = data2.results[0].geometry.location.lng;

        const { data: data3 } = await axios.get(`https://maps.googleapis.com/maps/api/distancematrix/json?origins=${lat1},${lng1}&destinations=${lat2},${lng2}&key=${`AIzaSyC7TOs-73yQEUsNqVchkrvTr6I5gxYF5kE`}`);
        
        const distance = data3.rows[0].elements[0].distance.text;
        console.log(distance);
        return distance;
      } catch (error) {
        console.error(error);
      }
    }
*/
</script>