<template>
    <Modal :show="openModal" @close="closeModal">
        <div class="flex min-h-0 flex-1 flex-col py-6 overflow-y-scroll">
            <div class="px-4 sm:px-6">
                <div class="flex items-start justify-between">
                    <div class="space-y-1">
                        <h2 id="headlessui-dialog-title-15" data-headlessui-state="open" class="text-lg font-medium">
                            Changer le statut du devis
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
                    <div class="my-6 space-y-5">
                        <DefaultSelectInput name="status" label="Statuts" v-model="form.status" :options="quotationStatus"
                            :error="form.errors.status" />
                    </div>

                    <div class="mt-6 flex justify-end space-x-4">
                        <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>
                        <DefaultButton @click="updateStatus" class="w-32" buttontext="Changer le statut du devis" />
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>
  
<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    quotation: Object,
    openModal: Boolean,
});

const quotationStatus = [
    {
        name: "Brouillon",
        value: "Brouillon"
    },
    {
        name: "Accepté(Signé)",
        value: "Accepté"
    },
    {
        name: "Envoyé",
        value: "Envoyé"
    },
    {
        name: "Refusé",
        value: "Refusé"
    },
    {
        name: "Expiré",
        value: "Expiré"
    },
];
const emit = defineEmits(["closeModal"]);
const form = useForm({
    status: props.quotation.status
});

const closeModal = () => {
    form.reset();
    emit("closeModal");
};

const updateStatus = () => {
    form.put(route("6dem.quotation.update", { id: props.quotation.id, field: "status" }), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => console.log("quotation.update"),
        onError: (errors) => console.log(errors)
    });
};
</script>
  