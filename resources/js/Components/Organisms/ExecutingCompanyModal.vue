<template>
    <Modal :show="showModal">
        <form @submit.prevent="createExecutingCompany" class="w-full p-6 flex flex-col space-y-2">
            <div class="mt-2 border-b border-gray-200 divide-x">
                <p class="text-lg ml-2 font-semibold leading-6 text-gray-900">
                    Compléter les information du prestataire
                </p>
            </div>
            <div class="w-full flex flex-col space-y-2">

                <DefaultInput
                    v-model="form.siren"
                    :error="form.errors.siren"
                    @update:modelValue="getCompanyInformations"
                    name="siren"
                    label="Veuillez renseigner le numéro SIREN ou SIRET (Remplissage automatique)"
                />
                    
                <DefaultInput :required="true" v-model="form.name" :error="form.errors.name" name="name"
                    label="Nom de la société" />

                <LocationAutocomplete :value="form.address" :error="form.errors.address" name="address"
                    label="Adresse" placeholder="Adresse de la société" @place_changed="setAddressData" />

                <div class="w-full flex space-x-2">
                    <DefaultInput class="w-1/3" v-model="form.city" :error="form.errors.city" name="city"
                        label="Ville" />
                    <DefaultInput class="w-1/3" :required="false" v-model="form.postalCode" :error="form.errors.postalCode"
                        name="postalCode" label="Code postal" />

                    <DefaultInput class="w-1/3" :required="false" v-model="form.country" :error="form.errors.country"
                        name="country" label="Pays" />
                </div>

                <div class="w-full flex space-x-2">
                    <DefaultInput class="w-1/2" v-model="form.phone_number"
                        :error="form.errors.phone_number" name="phone" label="Téléphone" />
                    <DefaultInput class="w-1/2" v-model="form.email" :error="form.errors.email"
                        name="email" label="Email" />
                </div>

                <DefaultInput v-model="form.field" :error="form.errors.field" name="field"
                    label="Domaine d'activité" />
            </div>
            <div class="shrink-0 py-4">
                <div class="flex flex-wrap justify-end space-x-3 sm:flex-nowrap">
                    <SecondaryButton @click="closeUpModal"> Annuler </SecondaryButton>
                    <DefaultButton type="submit" buttontext="Enregistrer" />
                </div>
            </div>
        </form>
    </Modal>
</template>
  
<script setup>
import Modal from "@/Components/Modal.vue";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import LocationAutocomplete from "@/Components/Atoms/LocationAutocomplete.vue";
import { useForm, usePage, router } from "@inertiajs/vue3";
import axios from "axios";
import { parseCompanyInformations } from "@/utils/index";

const emit = defineEmits(["close"]);

defineProps({
    showModal: Boolean,
});

const executingCompany = usePage().props.executingCompany;

const form = useForm({
    name: "",
    phone_number: "",
    email: "",
    siret: "",
    siren: "",
    codeApe: "",
    address: "",
    field: "",
    city: "",
    postalCode: "",
    country: "",
    fullAddress: "",
    lat: "",
    lng: "",
    googleMapUrl: "",
});

form.name = executingCompany ? executingCompany.name : "";
form.phone_number = executingCompany ? executingCompany.phone_number : "";
form.email = executingCompany ? executingCompany.email : "";
form.siret = executingCompany ? executingCompany.siret : "";
form.siren = executingCompany ? executingCompany.siren : "";
form.field = executingCompany ? executingCompany.field : "";
form.address = executingCompany ? executingCompany.address.address  : "";
form.city = executingCompany ? executingCompany.address.city  : "";
form.postalCode = executingCompany ? executingCompany.address.postal_code  : "";
form.country = executingCompany ? executingCompany.address.country  : "";
form.fullAddress = executingCompany ? executingCompany.address.full_address  : "";
form.lat = executingCompany ? executingCompany.address.lat  : "";
form.lng = executingCompany ? executingCompany.address.lng  : "";
form.googleMapUrl = executingCompany ? executingCompany.address.google_map_url  : "";

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

const setExecutingCompanyData = (executingCompany) => {
    form.name = executingCompany.organizationName;
    form.siren = executingCompany.siren;
    form.siret = executingCompany.siret;
    form.address = executingCompany.address;
    form.city = executingCompany.city;
    form.postalCode = executingCompany.postalCode;
    form.country = executingCompany.country;
    form.codeApe = executingCompany.codeApe;
    form.fullAddress = executingCompany.fullAddress;
};

const createExecutingCompany = () => {
    form.post(route("6dem.create.executingCompany"), {
        replace: true,
        onSuccess: () => closeUpModal(),
    });
};

const closeUpModal = () => {
    form.reset();
    emit("close");
  };

const getCompanyInformations = async (value) => {
    if (value.length >= 9) {
        try {
            const result = await axios.get(
                "https://suggestions.pappers.fr/v2/?q=" +
                value.replace(/\s/g, "") +
                "&cibles=siren,siret"
            );
            setExecutingCompanyData(
                parseCompanyInformations(result.data.resultats_siren[0])
            );
        } catch (e) {
            console.log(e);
        }
    }
};
</script>