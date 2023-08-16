<template>
    <div v-if="showInput" class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
            <button type="submit" @click="addOption">
                <svg class="h-5 w-5 text-green-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </button>
        </div>
        <input type="text"  name="text" class="block w-full p-4 pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Entrez une option" required v-model="form.text">
    </div>

    <div class="flex flex-row space-x-2 justify-center mt-3">
        <button @click="toggleInputField" class="rounded-full p-0.5 bg-blue-200 text-blue-500 hover:text-blue-700">
            <svg v-if="!showInput" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"
                class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <svg v-else class="h-4 w-4 text-blue-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12" /></svg>
        </button>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    id_formulas:Number,
    type_formulas:String,
});
const emit=defineEmits("id_formulas","type_formulas");
const showInput = ref(false);

const toggleInputField = () => {
    showInput.value = !showInput.value;
};
const form = useForm({
    id_formulas: props.id_formulas,
    text : "",
    type :props.type_formulas,
});

const addOption = () => {
        form.post(route("6dem.settings.create"), {
            onSuccess: () => {form.text = ""; console.log('added');},
        });
};


</script>
