<template>
  <div class="pt-3 flex flex-col py-10 h-auto">
    <form
      @submit.prevent="createClient"
      class="w-full pt-3 flex flex-col space-y-3"
    >
      <div class="w-full pt-3 flex space-x-2">
        <SelectableButton
          text="Particulier"
          value="individual"
          :selected="form.clientType === 'individual'"
          @selected="clientTypeChange"
        />
        <SelectableButton
          text="Professionnel"
          value="professional"
          :selected="form.clientType === 'professional'"
          @selected="clientTypeChange"
        />
      </div>

      <div
        v-if="form.clientType === 'individual'"
        class="w-full flex flex-col space-y-2"
      >
        <div class="w-full flex space-x-2">
          <DefaultInput
            class="w-1/2"
            :required="true"
            v-model="form.firstName"
            :error="form.errors.firstName"
            name="fist_name"
            label="Prénom"
          />
          <DefaultInput
            class="w-1/2"
            :required="true"
            v-model="form.lastName"
            :error="form.errors.lastName"
            name="last_name"
            label="Nom"
          />
        </div>

        <DefaultInput
          :required="true"
          v-model="form.phoneNumber"
          :error="form.errors.phoneNumber"
          name="phone"
          label="Téléphone"
        />

        <DefaultInput
          :required="false"
          v-model="form.email"
          :error="form.errors.email"
          name="email"
          label="Email"
        />

        <LocationAutocomplete
          :required="true"
          v-model="form.address"
          :error="form.errors.address"
          name="address"
          label="Adresse"
          placeholder="Adresse du client"
          @place_changed="setAddressData"
        />

        <div class="w-full flex space-x-2">
          <DefaultInput
            class="w-1/3"
            :required="false"
            v-model="form.city"
            :error="form.errors.city"
            name="city"
            label="Ville"
          />
          <DefaultInput
            class="w-1/3"
            :required="false"
            v-model="form.postalCode"
            :error="form.errors.postalCode"
            name="postalCode"
            label="Code postal"
          />

          <DefaultInput
            class="w-1/3"
            :required="false"
            v-model="form.country"
            :error="form.errors.country"
            name="country"
            label="Pays"
          />
        </div>

        <DefaultSelectInput
          name="source"
          label="Source"
          v-model="form.source"
          :options="sourceOptions"
          :error="form.errors.source"
        />
      </div>

      <div
        v-if="form.clientType === 'professional'"
        class="w-full flex flex-col space-y-2"
      >

        <DefaultInput
          v-model="form.siren" 
          :error="form.errors.siren"
          @update:modelValue="getCompanyInformations" 
          name="siren"
          label="Numéro Siren ou Siret de la societé (Remplissage automatique)"
        />

        <DefaultInput
          :required="true"
          v-model="form.clientOrganizationName"
          :error="form.errors.clientOrganizationName"
          name="company_name"
          label="Nom de la societé"
        />

        <div class="flex flex-col space-y-1">
          <span class="text-sm underline">Répresantant de la société</span>
          <div class="w-full flex space-x-2">
            <DefaultInput
              class="w-1/2"
              :required="true"
              v-model="form.firstName"
              :error="form.errors.firstName"
              name="fist_name"
              label="Prénom"
            />
            <DefaultInput
              class="w-1/2"
              :required="true"
              v-model="form.lastName"
              :error="form.errors.lastName"
              name="last_name"
              label="Nom"
            />
          </div>
        </div>

        <DefaultInput
          :required="false"
          v-model="form.email"
          :error="form.errors.email"
          name="email"
          label="Email"
        />

        <DefaultInput
          :required="true"
          v-model="form.phoneNumber"
          :error="form.errors.phoneNumber"
          name="phone"
          label="Téléphone"
        />

        <LocationAutocomplete
          :required="true"
          v-model="form.address"
          :error="form.errors.address"
          name="address"
          label="Adresse de Facturation"
          placeholder="Adresse du client"
          @place_changed="setAddressData"
        />

        <div class="w-full flex space-x-2">
          <DefaultInput
            class="w-1/3"
            :required="false"
            v-model="form.city"
            :error="form.errors.city"
            name="city"
            label="Ville"
          />
          <DefaultInput
            class="w-1/3"
            :required="false"
            v-model="form.postalCode"
            :error="form.errors.postalCode"
            name="postalCode"
            label="Code postal"
          />

          <DefaultInput
            class="w-1/3"
            :required="false"
            v-model="form.country"
            :error="form.errors.country"
            name="country"
            label="Pays"
          />
        </div>

        <DefaultSelectInput
          name="source"
          label="Source"
          v-model="form.source"
          :options="sourceOptions"
          :error="form.errors.source"
        />
      </div>
      <div class="pt-3 font-bold">Les champs marqués d'une <span class="text-red-500">*</span> sont obligatoires</div>
      <div class="shrink-0 py-4">
        <div class="flex flex-wrap justify-end space-x-3 sm:flex-nowrap">
          <DefaultButton type="submit" class="w-1/2" buttontext="Valider" />
        </div>
      </div>
    </form>
  </div>
</template>
<script setup>
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import SelectableButton from "@/Components/Atoms/SelectableButton.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import LocationAutocomplete from "@/Components/Atoms/LocationAutocomplete.vue";
import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";
import { useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import { parseCompanyInformations } from "@/utils/index";

const emit = defineEmits(["close"]);

const setAddressData = (location) => {
  form.address = location.address;
  form.city = location.city;
  form.postalCode = location.postalCode;
  form.country = location.country;
  form.fullAddress = location.fullAddress;
  form.lat = location.lat;
  form.lng = location.lng;
  form.googleMapUrl = location.googleMapUrl;
};

const form = useForm({
  clientType: "individual",
  firstName: "",
  lastName: "",
  phoneNumber: "",
  email: "",
  source: "",
  clientOrganizationName: "",
  siret: "",
  siren: "",
  address: "",
  city: "",
  postalCode: "",
  country: "",
  fullAddress: "",
  lat: "",
  lng: "",
  googleMapUrl: "",
});

const clientTypeChange = (value) => {
  form.clientType = value;
  form.clientOrganizationName = "";
  form.firstName = "";
  form.lastName = "";
  form.phoneNumber = "";
  form.email = "";
  form.address = "";
  form.source = "";
  form.siret = "";
  form.siren = "";
  form.address = "";
  form.city = "";
  form.postalCode = "";
  form.country = "";
  form.fullAddress = "";
  form.lat = "";
  form.lng = "";
  form.googleMapUrl = "";
  form.clearErrors();
};

const sourceOptions = [
  {
    name: 'Bouche à oreille & Recommandation',
    value: 'Bouche à oreille & Recommandation',
  },
  {
    name: 'Appel entant',
    value: 'Appel entant',
  },
  {
    name: 'Publicité en Ligne(google adwords…)',
    value: 'Publicité en Ligne(google adwords…)',
  },
  {
    name: 'Publicité traditionnelle',
    value: 'Publicité traditionnelle',
  },
  {
    name: "Campagnes d'Emailing",
    value: "Campagnes d'Emailing",
  },

  {
    name: "Site Web et SEO",
    value: "Site Web et SEO",
  }
];

const createClient = () => {
  form.post(route("6dem.create.clients"), {
    preserveScroll: true,
    replace: true,
    onSuccess: () => emit("close"),
  });
};

const setClientOrganizationData = (clientOrganization) => {
    form.clientOrganizationName = clientOrganization.organizationName;
    form.siren = clientOrganization.siren;
    form.siret = clientOrganization.siret;
    form.address = clientOrganization.fullAddress;
    form.city = clientOrganization.city;
    form.postalCode = clientOrganization.postalCode;
    form.country = clientOrganization.country;
    form.codeApe = clientOrganization.codeApe;
    form.fullAddress = clientOrganization.fullAddress;
    console.log(clientOrganization);
};

const getCompanyInformations = async (value) => {
    if (value.length >= 9) {
        try {
            const result = await axios.get(
                "https://suggestions.pappers.fr/v2/?q=" +
                value.replace(/\s/g, "") +
                "&cibles=siren,siret"
            );
            setClientOrganizationData(
                parseCompanyInformations(result.data.resultats_siren[0])
            );
        } catch (e) {
            console.log(e);
        }
    }
};
</script>  

<style>
.pac-container {
  z-index: 10000 !important;
}
</style>