<template>
  <div class="2xl:px-28">
    <div class="pt-14 grid justify-items-center">
      <UploadFile class="w-1/6" label="Déposez ou cliquez si vous souhaitez ajouter votre logo" />
    </div>
    <div class="flex flex-col space-y-5 px-8 mt-24">
      <div class="text-center text-4xl font-bold pb-5">
        <h1>Informations pré-remplies</h1>
      </div>
      <div class="grid grid-cols-3 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="'DEVIS N° ' + currentQuotation.number" placeholder="N° du devis"
              :font-bold="true" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.phone_number" placeholder="Téléphone" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Adresse mail" :value="currentOrganisation.email" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.siren" placeholder="SIREN" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.code_ape" placeholder="Code APE" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.licence" placeholder="Licence N°" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div>
        <DocumentFieldFrame>
          <DocumentFieldInput placeholder="Adresse de la société"
            :value="currentOrganisation.billing_address.full_address" />
        </DocumentFieldFrame>
      </div>
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
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Nom complet de l'entreprise"
              :value="currentClient.client_organization.name" />
          </DocumentFieldFrame>
        </div>
      </div>
    </div>
    <div class="flex flex-col space-y-5 px-8 mt-16">
      <div class="text-center text-4xl font-bold pb-5">
        <h1>Informations à remplir</h1>
      </div>
      <DocumentLabel name="Devis" color="#438A7A" />
      <div v-if="currentClient.type == 'individual'">
        <div class="grid grid-cols-3 gap-6 pb-5 justify-between">
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Validité devis (7 jours, 1 mois ..)" v-model="movingjob.validity_duration"
                @savingValue="saveField('validity_duration')" />
            </DocumentFieldFrame>
          </div>
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Volume(en m³)" v-model="movingjob.capacity"
                @savingValue="saveField('capacity')" />
            </DocumentFieldFrame>
          </div>
          <div>
            <DocumentSelectInput v-model="movingjob.formula" :value="movingjob.formula" @change="saveFormula" :options="formulaOptaions" default-text="Formule de déménagament"/>
          </div>
        </div>
      </div>
      <div v-else>
        <div class="grid grid-cols-2 gap-6 pb-5 justify-between">
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Validité devis (7 jours, 1 mois ..)" v-model="movingjob.validity_duration"
                @savingValue="saveField('validity_duration')" />
            </DocumentFieldFrame>
          </div>
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Volume(en m³)" v-model="movingjob.capacity"
                @savingValue="saveField('capacity')" />
            </DocumentFieldFrame>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-20 justify-between">
        <div class="flex flex-col space-y-2">
          <DocumentLabel name="Chargement" color="#438A7A" />
          <ToggleButton v-model:checked="sameAddressAsClient" label="Adresse de chargement identique à l'adresse du client ?" />
          <DocumentFieldFrame>
            <DocumentFieldInputAddress :value="movingjob.loading_address" name="loading_address" placeholder="Adresse de chargement"
              @place_changed="setLoadingAddressData" />
          </DocumentFieldFrame>
          <div v-if="movingjobLocationUrl.loading_google_map_url">
            <a :href="movingjobLocationUrl.loading_google_map_url" target="_blank" class="border-b text-primary border-primary border-dotted text-xs">
              Voir l'adresse sur Google street map
            </a>
          </div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Date de chargement" v-model="movingjob.loading_date"
              @savingValue="saveField('loading_date')" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Étage" v-model="movingjob.loading_floor"
                @savingValue="saveField('loading_floor')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Ascenseur" v-model="movingjob.loading_elevator"
                @savingValue="saveField('loading_elevator')" />
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Portage" v-model="movingjob.loading_portaging"
                @savingValue="saveField('loading_portaging')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Détails" v-model="movingjob.loading_details"
                @savingValue="saveField('loading_details')" />
            </DocumentFieldFrame>
          </div>

          <DynamicQuoteFields :movingjob="currentMovingJob.id" :position="'loading'" />
        </div>

        <div class="flex flex-col space-y-2">
          <DocumentLabel name="Livraison" color="#438A7A" />
          <div class="pt-6"></div>
          <DocumentFieldFrame>
            <DocumentFieldInputAddress :value="movingjob.shipping_address" name="shipping_address" placeholder="Adresse de livraison"
              @place_changed="setShippingAddressData" />
          </DocumentFieldFrame>
          <div v-if="movingjobLocationUrl.shipping_google_map_url">
            <a :href="movingjobLocationUrl.shipping_google_map_url" target="_blank" class="border-b text-primary border-primary border-dotted text-xs">
              Voir l'adresse sur Google street map
            </a>
          </div>

          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Date de livraison" v-model="movingjob.shipping_date"
              @savingValue="saveField('shipping_date')" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Étage" v-model="movingjob.shipping_floor"
                @savingValue="saveField('shipping_floor')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Ascenseur" v-model="movingjob.shipping_elevator"
                @savingValue="saveField('shipping_elevator')" />
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Portage" v-model="movingjob.shipping_portaging"
                @savingValue="saveField('shipping_portaging')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Détails" v-model="movingjob.shipping_details"
                @savingValue="saveField('shipping_details')" />
            </DocumentFieldFrame>
          </div>

          <DynamicQuoteFields :movingjob="currentMovingJob.id" :position="'shipping'" />
        </div>
      </div>
      <div class="text-center text-2xl font-bold pb-5 flex justify-center">
          <h1>Distance: </h1>
          <DocumentFieldInput placeholder="Distance" :value="movingjob.distance" v-model="movingjob.distance"
                @savingValue="saveField('distance')" />
        </div>
    </div>

    <div class="flex flex-col space-y-5 px-8 mt-8">
      <div class="flex flex-col mt-4 space-y-5">
        <DocumentLabel name="Options" color="#438A7A" />
      </div>
      <div class="flex flex-col space-y-2">
        <DynamicFields :movingjob="currentMovingJob.id" />
      </div>
    </div>
    <div class="flex flex-col space-y-5 px-8 mt-8">
      <div class="flex flex-col mt-4 space-y-5">
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
                :value="'Valeur max par objet: ' + currentInsuranceContractual.max_value"
                @savingValue="saveInsurance(currentInsuranceContractual.id, 'max_value', 'contractual')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Franchise" v-model="insuranceContractual.franchise"
                :value="'Franchise: ' + currentInsuranceContractual.franchise"
                @savingValue="saveInsurance(currentInsuranceContractual.id, 'franchise', 'contractual')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant HT" v-model="insuranceContractual.amount_ht"
                :value="'Montant HT: ' + currentInsuranceContractual.amount_ht"
                @savingValue="saveInsurance(currentInsuranceContractual.id, 'amount_ht', 'contractual')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant TTC"
                :model-value="'Montant TTC: ' + currentInsuranceContractual.amount_ht * vat" />
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
                :value="'Valeur max par objet : ' + currentInsuranceAdValorem.max_value"
                @savingValue="saveInsurance(currentInsuranceAdValorem.id, 'max_value', 'adValorem')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Franchise" v-model="insuranceAdValorem.franchise"
                :value="'Franchise : ' + currentInsuranceAdValorem.franchise"
                @savingValue="saveInsurance(currentInsuranceAdValorem.id, 'franchise', 'adValorem')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant HT" v-model="insuranceAdValorem.amount_ht"
                :value="'Montant HT : ' + currentInsuranceAdValorem.amount_ht"
                @savingValue="saveInsurance(currentInsuranceAdValorem.id, 'amount_ht', 'adValorem')" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant TTC"
                :value="'Montant TTC: ' + currentInsuranceAdValorem.amount_ht * vat" />
            </DocumentFieldFrame>
          </span>
        </div>
      </div>
    </div>
    <div class="flex flex-col px-8 pb-10 mt-10">
      <div class="flex flex-col space-y-5 px-16">
        <DocumentLabel name="Finalisation du devis" color="#438A7A" />
        <div class="grid grid-cols-4 gap-6 justify-between">
          <div class="space-y-5">
            <DocumentFieldFrame>
              <DocumentFieldInput :value="'Tarification'" />
            </DocumentFieldFrame>
            <DocumentFieldFrame>
              <DocumentFieldInput :value="'Modalités de règlement'" />
            </DocumentFieldFrame>
          </div>
          <div>
            <DocumentFieldFrame :className="'h-full'">
              <DocumentFieldInput :className="'h-full'" placeholder="Remise en %" v-model="movingjob.discount_percentage"
                @savingValue="saveField('discount_percentage')" />
            </DocumentFieldFrame>
          </div>
          <div class="space-y-5">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Acompte en %" v-model="movingjob.advance"
                @savingValue="saveField('advance')" />
            </DocumentFieldFrame>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant HT" v-model="movingjob.discount_amount_ht"
                @savingValue="saveField('discount_amount_ht')" />
            </DocumentFieldFrame>
          </div>
          <div class="space-y-5">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Solde en %" v-model="movingjob.balance"
                @savingValue="saveField('balance')" />
            </DocumentFieldFrame>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant TTC"
                :value="'Montant TTC: ' + movingjob.discount_amount_ht * vat" />
            </DocumentFieldFrame>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-row w-1/6 pb-10 mt-10 mx-auto">
      <DefaultButton @click="previewQuotation" buttontext="Générer le document" />
    </div>
  </div>
</template>

<script setup>
import { usePage, useForm, router } from "@inertiajs/vue3";
import UploadFile from "@/Components/Atoms/UploadFile.vue";
import DocumentFieldFrame from "@/Components/Atoms/DocumentFieldFrame.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import ToggleButton from "@/Components/Atoms/ToggleButton.vue";
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";
import DocumentFieldInputAddress from "@/Components/Atoms/DocumentFieldInputAddress.vue";
import DocumentLabel from "@/Components/Atoms/DocumentLabel.vue";
import DynamicFields from "@/Components/Organisms/DynamicFields.vue";
import DynamicQuoteFields from "@/Components/Organisms/DynamicQuoteFields.vue";
import DocumentSelectInput from "@/Components/Atoms/DocumentSelectInput.vue";
import "vue-select/dist/vue-select.css";
import { reactive, ref, computed } from "vue";
import { watch } from "vue";
import { reformatLocation } from "@/utils";

const currentSettingss = usePage().props.settings;
const currentOrganisation = usePage().props.organization;
const currentQuotation = usePage().props.quotation;
const currentMovingJob = usePage().props.movingJob;
const currentClient = usePage().props.client;
const currentInsuranceContractual = usePage().props.insurances.find(insurance => insurance.type === "contractual");
const currentInsuranceAdValorem = usePage().props.insurances.find(insurance => insurance.type === "ad_valorem");
const movingJobFormulas = usePage().props.movingJobFormulas;

const formulaOptaions = movingJobFormulas.map(item => ({
  name: item.name,
  value: item.slug
}));

const vat = 20;
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
  validity_duration: currentMovingJob.validity_duration ? currentMovingJob.validity_duration : currentSettingss.quotation_validity_duratation,
  capacity: currentMovingJob.capacity ? currentMovingJob.capacity : "",
  formula: currentMovingJob.formula ? currentMovingJob.formula : "",
  loading_address: currentMovingJob.loading_address ? currentMovingJob.loading_address : "",
  loading_date: currentMovingJob.loading_date ? currentMovingJob.loading_date : "",
  loading_floor: currentMovingJob.loading_floor ? currentMovingJob.loading_floor : "",
  loading_elevator: currentMovingJob.loading_elevator ? currentMovingJob.loading_elevator : "",
  loading_portaging: currentMovingJob.loading_portaging ? currentMovingJob.loading_portaging : "",
  loading_details: currentMovingJob.loading_details ? currentMovingJob.loading_details : "",
  shipping_address: currentMovingJob.shipping_address ? currentMovingJob.shipping_address : "",
  shipping_date: currentMovingJob.shipping_date ? currentMovingJob.shipping_date : "",
  shipping_floor: currentMovingJob.shipping_floor ? currentMovingJob.shipping_floor : "",
  shipping_elevator: currentMovingJob.shipping_elevator ? currentMovingJob.shipping_elevator : "",
  shipping_portaging: currentMovingJob.shipping_portaging ? currentMovingJob.shipping_portaging : "",
  shipping_details: currentMovingJob.shipping_details ? currentMovingJob.shipping_details : "",
  discount_percentage: currentMovingJob.discount_percentage ? currentMovingJob.discount_percentage : "",
  discount_amount_ht: currentMovingJob.discount_amount_ht ? currentMovingJob.discount_amount_ht : "",
  advance: currentMovingJob.advance ? currentMovingJob.advance : "",
  balance: currentMovingJob.balance ? currentMovingJob.balance : "",
  distance: currentMovingJob.distance ? currentMovingJob.distance : ""
});

const sameAddressAsClient = ref( movingjob.loading_address == currentClient.address.full_address);
const movingjobLocationUrl = ref( {
  loading_google_map_url: currentMovingJob.loading_location ? currentMovingJob.loading_location.google_map_url : "",
  shipping_google_map_url: currentMovingJob.shipping_location ? currentMovingJob.shipping_location.google_map_url : "",
});

const discountAmountTtc = computed(() => {
  return currentMovingJob.discount_amount_ht * 20;
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

const shippingLocation = useForm({
  type: '',
  address: '',
  city: '',
  postalCode: '',
  country: '',
  fullAddress: '',
  lat: '',
  lng: '',
  googleMapUrl: ''
});


const loadingLocation = useForm({
  type: '',
  address: '',
  city: '',
  postalCode: '',
  country: '',
  fullAddress: '',
  lat: '',
  lng: '',
  googleMapUrl: ''
});


watch(sameAddressAsClient, (value) => {
  if (value) {
    setLoadingAddressData(reformatLocation(currentClient.address))
  } else {
    movingjob.loading_address = "";
  }
});

const saveField = (field) => {
  movingjob.put(route("6dem.quotation.update", { id: currentQuotation.id, field: field }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("quotation.update"),
    onError: (errors) => console.log(errors)
  });
};

const saveFormula = () => {
  movingjob.put(route("6dem.quotation.update", { id: currentQuotation.id, field: 'formula' }), {
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
  loadingLocation.type = "loading";
  loadingLocation.address = location.address;
  loadingLocation.city = location.city;
  loadingLocation.postalCode = location.postalCode;
  loadingLocation.country = location.country;
  loadingLocation.fullAddress = location.fullAddress;
  loadingLocation.lat = location.lat;
  loadingLocation.lng = location.lng;
  loadingLocation.googleMapUrl = location.googleMapUrl;

  loadingLocation.put(route("6dem.quotation.location", { id: currentQuotation.id, from: 'quotation' }), {
    preserveScroll: true,
    onSuccess: updateDistance,
    onError: (errors) => console.log(errors)
  });
};

const setShippingAddressData = (location) => {
  movingjob.shipping_address = location.fullAddress;
  shippingLocation.type = "shipping";
  shippingLocation.address = location.address;
  shippingLocation.city = location.city;
  shippingLocation.postalCode = location.postalCode;
  shippingLocation.country = location.country;
  shippingLocation.fullAddress = location.fullAddress;
  shippingLocation.lat = location.lat;
  shippingLocation.lng = location.lng;
  shippingLocation.googleMapUrl = location.googleMapUrl;
  shippingLocation.put(route("6dem.quotation.location", { id: currentQuotation.id, from: 'quotation' }), {
    preserveScroll: true,
    onSuccess: updateDistance,
    onError: (errors) => console.log(errors)
  });
};

const updateDistance = (response) => {
  movingjobLocationUrl.value.loading_google_map_url = response.props.movingJob.loading_location.google_map_url;
  movingjobLocationUrl.value.shipping_google_map_url = response.props.movingJob.shipping_location.google_map_url; 
  movingjob.distance = response.props.movingJob.distance;
};

const previewQuotation = () => {
  router.visit(route("6dem.documents.quotation.preview", currentQuotation.id), {
    method: "get",
  });
};
</script>