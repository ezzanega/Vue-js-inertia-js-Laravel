<template>
  <div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <h3 class="text-lg font-medium leading-6 text-neutral-900">Société</h3>
        <p class="mt-1 text-sm text-neutral-600">
          Informations de l'entreprise
        </p>
      </div>
      <div class="mt-5 md:col-span-2 md:mt-0">
        <form @submit.prevent="updateBillingAddress">
          <div class="">
            <div
              class="card bg-white ring-1 ring-neutral-600 ring-opacity-5 rounded-lg shadow overflow-hidden"
            >
              <div class="px-4 py-5 sm:p-6">
                <Message
                  v-show="$page.props.status === 'organization-updated'"
                  status="success"
                  message="Les informations de la société ont bien été mises à jour"
                />
                <div class="w-full pt-3 flex flex-col space-y-2">

                  <DefaultInput
                    :required="true"
                    v-model="form.siren"
                    :error="form.errors.siren"
                    @update:modelValue="getCompanyInformations"
                    name="siren"
                    label="Veuillez renseigner le numéro SIREN ou SIRET (Remplissage automatique)"
                  />

                  <DefaultInput
                    :required="true"
                    v-model="form.organizationName"
                    :error="form.errors.organizationName"
                    name="organizationName"
                    label="Nom de la société"
                  />

                  <LocationAutocomplete
                    :required="true"
                    :value="form.address"
                    :error="form.errors.address"
                    name="address"
                    label="Adresse"
                    placeholder="Adresse du client"
                    @place_changed="setAddressData"
                  />

                  <div class="w-full flex space-x-2">
                    <DefaultInput
                      class="w-1/3"
                      :required="true"
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

                  <div class="w-full flex space-x-2">
                    <DefaultInput
                      :required="true"
                      class="w-1/2"
                      v-model="form.phoneNumber"
                      :error="form.errors.phoneNumber"
                      name="phone"
                      label="Téléphone"
                    />
                    <DefaultInput
                      :required="true"
                      class="w-1/2"
                      v-model="form.email"
                      :error="form.errors.email"
                      name="email"
                      label="Email"
                    />
                  </div>

                  <div class="w-full flex space-x-2">
                    <DefaultInput
                      class="w-1/2"
                      v-model="form.codeApe"
                      :error="form.errors.codeApe"
                      name="codeApe"
                      label="Code NAF ou APE de la Société (optionnel)"
                    />
                    <DefaultInput
                      class="w-1/2"
                      v-model="form.licence"
                      :error="form.errors.licence"
                      name="email"
                      label="Licence déménageur (optionnel)"
                    />
                  </div>
                </div>
              </div>
              <div class="bg-neutral-50 px-4 py-4 sm:px-6">
                <div class="flex justify-end">
                  <div>
                    <DefaultButton type="submit" buttontext="Modifier" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
  
<script setup>
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import Message from "@/Components/Atoms/Message.vue";
import LocationAutocomplete from "@/Components/Atoms/LocationAutocomplete.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { parseCompanyInformations } from "@/utils/index";

const organization = usePage().props.organization;

const form = useForm({
  email: "",
  phoneNumber: "",
  organizationName: "",
  siret: "",
  siren: "",
  codeApe: "",
  licence: "",
  address: "",
  city: "",
  postalCode: "",
  country: "",
  fullAddress: "",
  lat: "",
  lng: "",
  googleMapUrl: "",
});

form.organizationName = organization.name;
form.phoneNumber = organization.phone_number;
form.email = organization.email;
form.siret = organization.siret;
form.siren = organization.siren;
form.codeApe = organization.code_ape;
form.licence = organization.licence;
if (organization.billing_address) {
  form.address = organization.billing_address.address;
  form.city = organization.billing_address.city;
  form.postalCode = organization.billing_address.postal_code;
  form.country = organization.billing_address.country;
  form.fullAddress = organization.billing_address.full_address;
  form.lat = organization.billing_address.lat;
  form.lng = organization.billing_address.lng;
  form.googleMapUrl = organization.billing_address.google_map_url;
}

const updateBillingAddress = () => {
  form.put(route("6dem.organization.update"), {
    preserveScroll: true,
    onSuccess: () => console.log(),
  });
};

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

const setOrganizationData = (organization) => {
  form.organizationName = organization.organizationName;
  form.siren = organization.siren;
  form.siret = organization.siret;
  form.codeApe = organization.codeApe;
  form.address = organization.address;
  form.city = organization.city;
  form.postalCode = organization.postalCode;
  form.country = organization.country;
  form.fullAddress = organization.fullAddress;
};

const getCompanyInformations = async (value) => {
  if (value.length >= 9) {
    try {
      const result = await axios.get(
        "https://suggestions.pappers.fr/v2/?q=" +
          value.replace(/\s/g, "") +
          "&cibles=siren,siret"
      );
      setOrganizationData(
        parseCompanyInformations(result.data.resultats_siren[0])
      );
    } catch (e) {
      console.log(e);
    }
  }
};
</script>