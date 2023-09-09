<template>
    <Modal :show="openModal" @close="closeModal">
        <div class="flex min-h-0 flex-1 flex-col py-6 overflow-y-scroll">
            <div class="px-4 sm:px-6">
                <div class="flex items-start justify-between">
                    <div class="space-y-1">
                        <h2 class="text-lg font-medium">Céer un événement</h2>
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
                        <ColorPicker
                            label="Couleur d'affichage dans le calendrier"
                            :color="form.color"
                            v-model="form.color"
                        />
                        <DefaultInput type="text" name="title" label="Ajouter un titre" v-model="form.title" :error="form.errors.title"/>
                        <DefaultSelectInput name="eventType" label="Selectionner le type" v-model="form.type" :options="eventTypesOptions" :error="form.errors.type" @update:modelValue="eventTypeChanged"/>
                        <TextArea name="details" label="Ajouter des détails"
                            v-model="form.details" :error="form.errors.details" />
                    </div>
        
                    <div class="mt-6 flex justify-end space-x-4">
                        <SecondaryButton @click="closeModal" class="w-1/3"> Annuler </SecondaryButton>
                        <DefaultButton @click="createEvent" class="w-2/3" buttontext="Enregistrer"/>
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
import TextArea from "@/Components/Atoms/TextArea.vue";
import ColorPicker from "@/Components/Atoms/ColorPicker.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { formatDate, formatTime } from "@/utils/index";

const settings = usePage().props.settings;
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
    type: '',
    color: "#438A7A",
});

const createEvent = () => {
    axios.post(route("6dem.calendar.create.events"), {
        start: props.event.start,
        end: props.event.end,
        all_day: props.event.all_day,
        title: form.title,
        details: form.details,
        type: form.type,
        color: form.color,
    }).then(response => {
        emit("createEvent", {
            id: response.data.id,
            start: props.event.start,
            end: props.event.end,
            all_day: props.event.all_day,
            title: form.title,
            details: form.details,
            type: form.type,
            color: form.color,
        });
        form.reset();
    });
}

const closeModal = () => {
    form.reset();
    emit("closeModal");
};

const eventTypeChanged = () => {
    console.log(form.type)
    switch(form.type) {
        case 'meeting':
            form.color = settings.calendar_meeting_color
            break;
        case 'moving':
            form.color = settings.calendar_moving_color
            break;
        case 'others':
            form.color = settings.calendar_others_color
            break;
        case 'cartons-delivery':
            form.color = settings.calendar_cartons_delivery_color
            break;
        default:
            form.color = settings.calendar_meeting_color
    }
};
</script>
