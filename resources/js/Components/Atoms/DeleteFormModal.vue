<template>
    <Modal :show="isModaldelOpen" @close="closedelModal">
        <div class="text-center p-3 flex-auto justify-center leading-6">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-16 h-16 flex items-center text-primary mx-auto"
            viewBox="0 0 20 20"
            fill="currentColor"
            >
            <path
            fill-rule="evenodd"
             d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
            clip-rule="evenodd"
            />
            </svg>
            <h2 class="text-2xl font-bold py-4"> Êtes vous sûr ?</h2>
            <p class="text-md text-gray-500 px-8">
                Êtes vous sûr de vouloir continuer votre suppression?
            </p>
        </div>
        <div class="p-3 mt-2 text-center space-x-4 md:block">
            <button
            @click="deleteFunction"
            class="mb-2 md:mb-0 bg-red-500 text-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-white rounded-md hover:shadow-lg hover:bg-red-600 hover:text-white"
            >
                Supprimer
            </button>
            <button
            @click="closedelModal"
            class="mb-2 md:mb-0 bg-green-500 border border-primary-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-md hover:shadow-lg hover:bg-green-600"
            >
                Annuler
            </button>
        </div>
    </Modal>
  </template>

<script setup>
  import Modal from "@/Components/Modal.vue";
  const props = defineProps({
    isModaldelOpen: Boolean,
    });

const emit = defineEmits(["closedelModal"]);

const closedelModal = () => {
    emit("closedelModal");
};

const deleteFunction = () => {
    emit("deleteFunction");
};

</script>
