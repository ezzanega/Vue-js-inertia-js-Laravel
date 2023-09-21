<template>
    <Modal :show="openModal" @close="closeModal">
        <div class="flex min-h-0 flex-1 flex-col py-6 overflow-y-scroll">
            <div class="px-4 sm:px-6">
                <div class="flex items-start justify-between">
                    <div class="flex space-x-1 my-auto">
                        <span class="my-auto w-5 h-5 rounded-full" :style="{ 'background-color': event.color }"></span>
                        <h2 class="my-auto text-lg font-medium">{{ event.title }}</h2>
                    </div>
                    <div class="ml-3 flex h-7 items-center">
                        <button @click="closeModal" tabindex="0" type="button" class="rounded-md bg-white text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    </div>
                </div>
            </div>
            <div class="px-4 sm:px-6">
                <div class="w-full py-3 flex flex-col space-y-2">
                    <div class="my-6 space-y-5">
                        <div class="flex space-x-2 bg-secondary rounded-md p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div v-if="event.all_day">
                                Toute la journée du <span class="underline">{{ formatDate(event.start) }}</span>
                            </div>
                            <div v-else class="flex space-x-2">
                                <div>Le <span class="underline">{{ formatDate(event.start) }}</span></div>
                                <div>De <span class="font-bold underline">{{ formatTime(event.start) }}</span></div>
                                <div>À <span class="font-bold underline">{{ formatTime(event.end) }}</span></div>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-1 bg-secondary rounded-md p-2 text-sm">
                            <div class="flex justify-between">
                                <span class="flex font-bold">Détails:</span>
                                <svg class="h-5 w-5 text-black cursor-pointer"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            <div class="flex flex-col space-y-2" v-html="detailsTextForHTML"></div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-4">
                        <SecondaryButton @click="closeModal"> Fermer </SecondaryButton>
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { formatDate, formatTime } from "@/utils/index";
import { computed } from 'vue';

const emit = defineEmits(["closeModal"]);
const props = defineProps({
  openModal: Boolean,
  event: Object,
});

const detailsTextForHTML = computed(() => {
  const replacedText = props.event?.details?.replace(/\\n/g, '<br>') || '';
  return replacedText;
});

const closeModal = () => {
    emit("closeModal");
};
</script>
