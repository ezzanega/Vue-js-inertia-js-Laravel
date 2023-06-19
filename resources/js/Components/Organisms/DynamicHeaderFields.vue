<template>
    <div v-for="item, index in options" :key="item">
        <div class="relative w-full flex items-center">
            <div class="bg-gray-100 mb-2">
                <DocumentFieldInput placeholder="Nouveau Champ" :modelValue="item.value" :fontBold="true" />
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
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";

const options = reactive([]);

const addRow = () => {
    options.push({ value: '' })
};

const removeRow = (index) => {
    options.splice(index, 1)
};

const saveItem = () => {
};

</script>
    