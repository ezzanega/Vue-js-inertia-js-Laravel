<template>
    <div v-for="item, index in options" :key="item">
        <div class="flex space-x-2">
            <span class="w-1/4 p-1">
                <DocumentFieldFrame>
                    <DocumentFieldInput :modelValue="'Description : ' + item.description" :fontBold="true" />
                </DocumentFieldFrame>
            </span>
            <span class="w-1/4 p-1">
                <DocumentFieldFrame>
                    <DocumentFieldInput :modelValue="'Quantité : ' + item.qty" :fontBold="true" />
                </DocumentFieldFrame>
            </span>
            <span class="w-1/4 p-1">
                <DocumentFieldFrame>
                    <DocumentFieldInput :modelValue="'Tarif HT : ' + item.priceHT" :fontBold="true" />
                </DocumentFieldFrame>
            </span>
            <span class="w-1/4 p-1">
                <DocumentFieldFrame>
                    <DocumentFieldInput :modelValue="'Tarif TTC : ' + item.priceTTC" :fontBold="true" />
                </DocumentFieldFrame>
            </span>
        </div>
        <div class="flex flex-row space-x-2 justify-center mt-3">
            <Dropdown placement="bottom-end">
                <AddOptionButton />
                <template #popper>
                    <SettingsAddButtonPopperContent @addingOption="addRow" />
                </template>
            </Dropdown>
            <RemoveButton @click="removeRow(index)" />
        </div>
    </div>
</template>

<script setup>
import { reactive } from 'vue';
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";
import SettingsAddButtonPopperContent from "@/Components/Atoms/SettingsAddButtonPopperContent.vue";
import DocumentFieldFrame from "@/Components/Atoms/DocumentFieldFrame.vue";
import AddOptionButton from "@/Components/Atoms/AddOptionButton.vue";
import RemoveButton from "@/Components/Atoms/RemoveButton.vue";
import { Dropdown } from "floating-vue";

const options = reactive([
    { description: '', qty: 0, priceHT: 0, priceTTC: 0 }
]);

const addRow = () => {
    options.push({ description: '', qty: 0, priceHT: 0, priceTTC: 0 })
};

const removeRow = (index) => {
    if (options.length > 1) {
        options.splice(index, 1)
    }
};

const saveItem = () => {
};

</script>