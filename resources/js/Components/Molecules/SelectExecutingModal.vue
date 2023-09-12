<template>
    <Modal :show="openModal" @close="closeModal">
        <div class="flex min-h-0 flex-1 flex-col py-6 overflow-y-scroll">
            <div class="px-4 sm:px-6">
                <div class="flex items-start justify-between">
                    <div class="space-y-1">
                        <h2 id="headlessui-dialog-title-15" data-headlessui-state="open" class="text-lg font-medium">
                            Générer la lettre de voiture
                        </h2>
                    </div>
                    <div class="ml-3 flex h-7 items-center">
                        <button type="button"
                            class="rounded-md bg-white text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-primary-500"
                            tabindex="0" @click="closeModal">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="px-4 sm:px-6">
                <div class="w-full py-3 flex flex-col space-y-2">
                    <ToggleButton v-model:checked="toggleExecuting" name="toggle-executing"
                        label="Déménagement effectué par un prestataire ?" />
                    <div v-show="toggleExecuting" class="my-6 space-y-5">
                        <p class="mt-1 text-sm text-neutral-600">
                            Vous pouvez ajouter des prestataires au sei ndes réglages de votre compte.
                        </p>
                        <DefaultSelectInput name="executingCompany" label="Société Exécutante"
                            v-model="form.executingCompany" :options="executingCompaniesOptions"
                            :error="form.errors.executingCompany" />
                    </div>

                    <div class="mt-6 flex justify-end space-x-4">
                        <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>
                        <DefaultButton @click="createQuotation" class="w-32" buttontext="Valider" />
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>
  
<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ToggleButton from "@/Components/Atoms/ToggleButton.vue";
import { usePage, useForm } from "@inertiajs/vue3";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";
import { ref, onMounted } from "vue";

const props = defineProps({
    quotation: Object,
    openModal: Boolean,
});

const currentExecutingCompanies = usePage().props.executingCompanies;

const executingCompaniesOptions = ref([]);
const toggleExecuting = ref(false);
onMounted(() => {
    currentExecutingCompanies.forEach((executingCompany) => {
        executingCompaniesOptions.value.push({
            name: executingCompany.name,
            value: executingCompany.id,
        });
    });
});
const emit = defineEmits(["closeModal"]);

const form = useForm({
    executingCompany: "",
});

const closeModal = () => {
    form.reset();
    emit("closeModal");
};

const createQuotation = () => {
    form.post(route("6dem.documents.waybill.quotation.preview", props.quotation.id), { replace: true });
};
</script>
  