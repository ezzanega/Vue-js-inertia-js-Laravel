<template>
    <div>
        <IconButton
            @click="confirmDevisCreation"
            class="mt-6"
            text="Ajouter un devis"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="2.2"
              stroke="currentColor"
              aria-hidden="true"
              class="pointer-events-none shrink-0 w-6 h-6"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15"
              />
            </svg>
          </IconButton>
        <Modal :show="quoteSelectionModal" @close="closeModal">
            <div class="w-full p-6 flex flex-col space-y-2">
                <div class="mt-2 border-b border-gray-200 divide-x">
                    <p class="text-lg ml-2 font-semibold leading-6 text-gray-900">
                        Créer une lettre de voiture
                    </p>
                </div>
                <li class="flex gap-x-6">
                    <div class="hidden sm:flex sm:flex-col sm:items-end">
                        <div class="mt-3 flex items-center gap-x-1.5">
                            <div class="flex-none">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" @change="selectExisting()" class="sr-only peer"
                                        v-model="existingQuote" />
                                    <div
                                        class="w-11 h-6 bg-secondary peer-focus:outline-none peer-focus:ring-0 peer-focus:ring-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-none after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                                    </div>
                                    <p class="text-sm ml-5 font-semibold leading-6 text-gray-900">
                                        En utilisant un devis existant comme base
                                    </p>
                                </label>
                            </div>
                        </div>
                    </div>
                </li>
                <div>
                    <DefaultInput :required="true" v-if="existingQuote" name="client" class="shrink mt-1"
                        placeholder="Recherchez un devis" />
                </div>
                <li class="flex gap-x-6">
                    <div class="hidden sm:flex sm:flex-col sm:items-end">
                        <div class="mt-1 flex items-center gap-x-1.5">
                            <div class="flex-none">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" @change="selectNew()" class="sr-only peer" v-model="newQuote" />
                                    <div
                                        class="w-11 h-6 bg-secondary peer-focus:outline-none peer-focus:ring-0 peer-focus:ring-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-none after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                                    </div>
                                    <p class="text-sm ml-5 font-semibold leading-6 text-gray-900">
                                        En n'utilisant pas de devis comme base
                                    </p>
                                </label>
                            </div>
                        </div>
                    </div>
                </li>
                <div class="mt-6 flex justify-end space-x-4">
                    <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>
                    <DefaultButton @click="createDocument('6dem.documents.lettreVoiture')" class="w-32" buttontext="Valider" />
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

const existingQuote = ref(true);
const newQuote = ref(false);
const quoteSelectionModal = ref(false);

const closeModal = () => {
    quoteSelectionModal.value = false;
};

const selectExisting = () => {
    newQuote.value = false;
};

const selectNew = () => {
    existingQuote.value = false;
};

const createDocument = (routeLink) => {
    router.get(route(routeLink));
};

const confirmDevisCreation = () => {
    quoteSelectionModal.value = true;
};
</script>