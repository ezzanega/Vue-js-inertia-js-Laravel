<template>
    <div v-if="currentAdditionalFields">
        <div v-for="item, index in currentAdditionalFields" :key="item">
            <div v-if="item.position === props.position">
                <div class="relative w-full flex items-center">
                    <div class="bg-gray-100 mb-2">
                        <DocumentFieldInput placeholder="Nouveau Champ" v-model="item.description"
                            :value="item.description" :fontBold="true"
                            @savingValue="saveField('description', item.id, item.description)" />
                    </div>
                    <div class="relative flex items-center justify-center">
                        <button @click="removeAdditionalRow(index)"
                            class="absolute top-1/2 right-0 transform translate-x-6 -translate-y-3 bg-red-200 rounded-full p-0.5 text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-for="item, index in options" :key="item">
        <div class="relative w-full flex items-center">
            <div class="bg-gray-100 mb-2">
                <DocumentFieldInput placeholder="Nouveau Champ" v-model="item.description" :value="item.description"
                    :fontBold="true" @savingValue="saveField('description', item.id, item.description)" />
            </div>
            <div class="relative flex items-center justify-center">
                <button @click="removeRow(index)"
                    class="absolute top-1/2 right-0 transform translate-x-6 -translate-y-3 bg-red-200 rounded-full p-0.5 text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <button @click="addRow" class="rounded-full p-0.5 bg-blue-200 text-blue-500 hover:text-blue-700">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"
            class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    </button>
</template>
    
<script setup>
import { reactive } from 'vue';
import { useForm, usePage } from "@inertiajs/vue3";
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";

const currentAdditionalFields = usePage().props.additionalFields;

const props = defineProps({
    movingjob: Number,
    position: String
});

const options = reactive([]);

const field = useForm({
    type: "movingjob-field",
    description: "",
    position: ""
});

const addRow = () => {
    field.position = props.position;
    axios.post(route("6dem.additionalFields.create", props.movingjob), field)
        .then(response => {
            options.push({ id: response.data, description: '' })
        })
        .catch(error => {
            // Handle the error
            console.error(error);
        }
    );
};

const removeRow = (index) => {
    options.splice(index, 1)
};

const removeAdditionalRow = (index) => {
    currentAdditionalFields.splice(index, 1)
};

const saveField = (additionalField, id, value) => {
    field[additionalField] = value;
    field.put(route("6dem.additionalFields.update", { id: id, field: additionalField }), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => console.log("saved"),
    });
};
</script>
    