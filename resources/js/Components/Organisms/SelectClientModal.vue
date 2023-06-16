<template>
    <div>
        <IconButton class="mt-6" text="Devis" @click="confirmDevisCreation" />
        <Modal :show="clientSelectionModal" @close="closeModal">
            <div class="w-full p-6 flex flex-col space-y-2">
                <div class="mt-2 border-b border-gray-200 divide-x">
                    <p class="text-lg ml-2 font-semibold leading-6 text-gray-900">
                        Créer un devis
                    </p>
                </div>
                <li class="flex gap-x-6">
                    <div class="hidden sm:flex sm:flex-col sm:items-end">
                        <div class="mt-3 flex items-center gap-x-1.5">
                            <div class="flex-none">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" @change="selectExisting()" class="sr-only peer"
                                        v-model="existingClient" />
                                    <div
                                        class="w-11 h-6 bg-secondary peer-focus:outline-none peer-focus:ring-0 peer-focus:ring-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-none after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                                    </div>
                                    <p class="text-sm ml-5 font-semibold leading-6 text-gray-900">
                                        Pour un client existant
                                    </p>
                                </label>
                            </div>
                        </div>
                    </div>
                </li>
                <div>
                    <DefaultInput :required="true" v-if="existingClient" name="client" class="shrink mt-1"
                        placeholder="Recherchez un nom de client" />
                </div>
                <li class="flex gap-x-6">
                    <div class="hidden sm:flex sm:flex-col sm:items-end">
                        <div class="mt-1 flex items-center gap-x-1.5">
                            <div class="flex-none">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" @change="selectNew()" class="sr-only peer" v-model="newClient" />
                                    <div
                                        class="w-11 h-6 bg-secondary peer-focus:outline-none peer-focus:ring-0 peer-focus:ring-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-none after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                                    </div>
                                    <p class="text-sm ml-5 font-semibold leading-6 text-gray-900">
                                        Pour un nouveau client
                                    </p>
                                </label>
                            </div>
                        </div>
                    </div>
                </li>
                <div>
                    <CreateClientForm v-if="newClient" />
                </div>
                <div class="mt-6 flex justify-end space-x-4">
                    <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>
                    <DefaultButton @click="createDocument('6dem.documents.devis')" class="w-32" buttontext="Valider" />
                </div>
            </div>
        </Modal>
    </div>
</template>
  
<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import IconButton from '@/Components/Atoms/IconButton.vue';
import { ref } from "vue";
import { router } from '@inertiajs/vue3'
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import CreateClientForm from "@/Components/Organisms/CreateClientForm.vue";

const emit = defineEmits(['choosingClient']);

const existingClient = ref(true);
const newClient = ref(false);
const clientSelectionModal = ref(false);

const closeModal = () => {
    clientSelectionModal.value = false;
};

const selectExisting = () => {
    newClient.value = false;
};

const selectNew = () => {
    existingClient.value = false;
};

const createDocument = (routeLink) => {
    router.get(route(routeLink));
};

const confirmDevisCreation = () => {
    clientSelectionModal.value = true;
    emit('choosingClient');
};
</script>