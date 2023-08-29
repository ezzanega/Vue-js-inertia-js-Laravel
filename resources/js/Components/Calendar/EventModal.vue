<template>
    <Modal :show="openModal" @close="closeModal">
        <div class="flex min-h-0 flex-1 flex-col py-6 overflow-y-scroll">
            <div class="px-4 sm:px-6">
                <div class="flex items-start justify-between">
                    <div class="space-y-1">
                        <h2 class="text-lg font-medium">Détails</h2>
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
                        <ColorPicker
                            label="Couleur"
                            :color="form.color"
                            v-model="form.color"
                        />
                        <DefaultInput type="text" name="title" label="Titre" v-model="form.title" :error="form.errors.title"/>
                        <DefaultSelectInput name="eventType" label="Type" v-model="form.eventType" :options="eventTypesOptions" :error="form.errors.eventType"/>
                        <TextArea name="details" label="Conditions générales documents"
                            v-model="form.details" :error="form.errors.details" />
                        <vue3-colorpicker v-model="form.color"></vue3-colorpicker>
                    </div>
        
                    <div class="mt-6 flex justify-end space-x-4">
                        <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>
                        <DefaultButton @click="createEvent" class="w-32" buttontext="Enregistrer"/>
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import TextArea from "@/Components/Atoms/TextArea.vue";
import ColorPicker from "@/Components/Atoms/ColorPicker.vue";
import { useForm } from "@inertiajs/vue3";

const emit = defineEmits(["closeModal", "createEvent"]);

const props = defineProps({
  openModal: Boolean,
  event: Object,
});

const eventTypesOptions = [
  {
    name: "Déménagement",
    value: "moving"
  },
  {
    name: "Rendez-vous",
    value: "meeting"
  },
  {
    name: "Livraison de cartons",
    value: "cartons-delivery"
  },
  {
    name: "Autres",
    value: "others"
  },
];

const form = useForm({
    title: '',
    details: '',
    eventType: '',
    color: "#3788d8",
});

const createEvent = () => {
    const eventData = {
        start: props.event.start,
        end: props.event.end,
        all_day: props.event.all_day,
        title: form.title,
        details: form.details,
        type: form.eventType,
        color: form.color,
    };

    axios.post(route("6dem.calendar.create.events"), eventData).then(response => {
        emit("createEvent", {
            id: response.data.id,
            title: response.data.title,
            details: response.data.details,
            start: response.data.start,
            end: response.data.end,
            allDay: response.data.all_day
        });
    });
}

const closeModal = () => {
    form.reset();
    emit("closeModal");
};
</script>
