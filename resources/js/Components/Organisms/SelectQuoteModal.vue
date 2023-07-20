<template>
    <div>
        <IconButton @click="confirmWaybillCreation" class="mt-6" text="Ajouter une lettre de voiture">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"
                aria-hidden="true" class="pointer-events-none shrink-0 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </IconButton>
        <Modal :show="quoteSelectionModal" @close="closeModal">
            <div class="w-full p-6 flex flex-col space-y-2">
                <div class="mt-2 border-b border-gray-200 divide-x">
                    <p class="text-lg ml-2 font-semibold leading-6 text-gray-900">
                        Créer une lettre de voiture
                    </p>
                </div>
                <div class="w-full pt-3 flex space-x-2">
                    <SelectableButton text="Pour un devis existant" value="existing"
                        :selected="quotationType === 'existing'" @selected="quotationTypeChange" />
                    <SelectableButton text="Pour un nouveau client" value="new" :selected="quotationType === 'new'"
                        @selected="quotationTypeChange" />
                </div>

                <span class="mt-5 border-b border-gray-200 divide-x"></span>

                <div class="w-full" v-if="quotationType === 'existing'">
                    <div>
                        <Dropdown :triggers="[]" :shown="searchingQuotation" :autoHide="false" placement="bottom">
                            <SearchBar :required="true" name="waybill" v-model="searchQuotationQuery" class="shrink mt-1"
                                placeholder="Recherchez un numéro de devis" />
                            <template #popper>
                                <div class="w-full" style="width: 624px">
                                    <div class="bg-white rounded-md w-full">
                                        <ul class="max-h-80 overflow-y-auto" role="listbox">
                                            <li v-for="(quotation, index) in searchQuotationResults" role="option"
                                                :key="index">
                                                <a href="#" @click="selectQuotation(quotation)"
                                                    class="group block px-4 py-2 text-sm text-neutral-700 hover:bg-secondary hover:text-neutral-900">
                                                    <div class="flex flex-col">
                                                        <span class="">N° devis : {{ quotation.number }}</span>
                                                        <span class="">Client : {{ quotation.moving_job.client.first_name +
                                                            " " + quotation.moving_job.client.last_name }}</span>
                                                        <span class="">Date de chargement : {{
                                                            quotation.moving_job.loading_date }}</span>
                                                        <span class="">Adresse de chargement : {{
                                                            quotation.moving_job.loading_address }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li v-if="!searchQuotationResults.length">
                                                <span href="#"
                                                    class="group block px-4 py-2 text-sm text-neutral-700 hover:bg-secondary hover:text-neutral-900">
                                                    Aucun devis ne correspond à vos critères de recherche
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </template>
                        </Dropdown>
                    </div>

                    <div v-if="selectedQuotation" class="mt-2">
                        <a
                            class="group block px-4 py-2 text-sm text-neutral-700 rounded-md bg-secondary hover:text-neutral-900">
                            <div class="flex flex-col">
                                <span class="">N° devis : {{ selectedQuotation.number }}</span>
                                <span class="">Client : {{ selectedQuotation.moving_job.client.first_name + " " +
                                    selectedQuotation.moving_job.client.last_name }}</span>
                                <span class="">Date de chargement : {{ selectedQuotation.moving_job.loading_date }}</span>
                                <span class="">Adresse de chargement : {{ selectedQuotation.moving_job.loading_address }}</span>
                            </div>
                        </a>
                    </div>

                    <div class="mt-5 pt-16 flex justify-end space-x-4">
                        <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>
                        <DefaultButton @click="initWaybill" class="w-32" :disabled="selectedQuotation == null"
                            buttontext="Valider" />
                    </div>
                </div>
                <div v-else>
                    <div class="w-full px-6 flex flex-col space-y-2">
                        <CreateClientForm @created="" />
                    </div>
                </div>
            </div>
        </Modal>
    </div>
</template>
  
<script setup>
import Modal from "@/Components/Modal.vue";
import SelectableButton from "@/Components/Atoms/SelectableButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import IconButton from '@/Components/Atoms/IconButton.vue';
import { ref, watch } from "vue";
import { router } from '@inertiajs/vue3'
import { usePage } from "@inertiajs/vue3";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import SearchBar from "@/Components/Atoms/SearchBar.vue";
import CreateClientForm from "@/Components/Organisms/CreateClientForm.vue";
import { Dropdown } from "floating-vue";
import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import debounce from "lodash/debounce";

const quoteSelectionModal = ref(false);

const searchQuotationQuery = ref("");
const searchQuotationResults = ref([]);
const searchingQuotation = ref(false);

const selectedQuotation = ref(null);
const quotationType = ref("existing");

const props = usePage().props;

const closeModal = () => {
    quoteSelectionModal.value = false;
};

const confirmWaybillCreation = () => {
    quoteSelectionModal.value = true;
};

const quotationTypeChange = (value) => {
    quotationType.value = value;
};

const selectQuotation = async (quotation) => {
    selectedQuotation.value = quotation;
    searchingQuotation.value = false;
    searchQuotationResults.value = [];
};

watch(searchQuotationQuery, (newQuery) => {
    debouncedFetchQuotationResults(newQuery);
});

const searchQuotation = async () => {
    searchingQuotation.value = true;
    try {
        const result = await axios.get(
            route("6dem.search.quotation") + "?search_text=" + searchQuotationQuery.value
        );
        searchQuotationResults.value = result.data;
    } catch (e) {
        console.log(e);
    }
};

const debouncedFetchQuotationResults = debounce(searchQuotation, 300);

const initWaybill = () => {
    router.visit(
        route("6dem.documents.waybill.init", selectedQuotation.value.id),
        {
            method: "post",
        }
    );
};
</script>