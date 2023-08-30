<template>
    <Modal :show="showModal" @close="$emit('close')">
        <div class="w-full p-6 flex flex-col space-y-5">
            <div class="mt-2 border-b border-gray-200 divide-x">
                <p class="text-lg ml-2 font-semibold leading-6 text-gray-900">
                Compléter les information de votre société
                </p>
            </div>
            <div class="flex space-x-2 bg-secondary rounded-md p-2">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                </div>
                <span>
                    Veuillez compléter vos informations de réglages afin de profiter pleinement de l'expérience offerte par notre système CRM. <br>
                    Nous vous encourageons vivement à prendre quelques instants pour saisir ces détails cruciaux, 
                    ce qui ouvrira la voie à une expérience personnalisée et efficace au sein de notre CRM. <br>
                    Notre équipe reste à votre disposition pour toute assistance que vous pourriez nécessiter lors de ce processus.
                    <div class="underline">
                        Vous pouvez nous contacter au 0601418010
                    </div>
                </span>
            </div>
            <div class="shrink-0 py-4">
                <div class="flex flex-wrap justify-end space-x-3 sm:flex-nowrap">
                    <DefaultButton buttontext="Commencer" @click="router.visit(route('6dem.settings'))" />
                </div>
            </div>
        </div>
    </Modal>
</template>
  
<script setup>
import Modal from "@/Components/Modal.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import { router } from "@inertiajs/vue3";
const emit = defineEmits(["close"]);
defineProps({
    showModal: Boolean,
});
</script>