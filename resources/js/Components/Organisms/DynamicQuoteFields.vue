<template>
    <div v-for="item, index in options" :key="item">
        <DocumentFieldFrame  @removingField="removeRow(index)" :removable="true">
            <DocumentFieldInput placeholder="Nouveau Champ" :fontBold="true" />
        </DocumentFieldFrame>
    </div>
    <div class="flex flex-row space-x-2 justify-center mt-3">
        <button @click="addRow" class="rounded-full p-0.5 bg-blue-200 text-blue-500 hover:text-blue-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"
                class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </button>
    </div>
</template>
    
<script setup>
import { reactive } from 'vue';
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";
import DocumentFieldFrame from "@/Components/Atoms/DocumentFieldFrame.vue";

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
    