<template>
    <div v-for="item, index in options" :key="item">
        <div class="flex space-x-2">
            <span class="w-1/4 p-1 flex-none">
                <DocumentFieldFrame>
                    <DocumentFieldInput :modelValue="'Description : ' + item.description" :fontBold="true" />
                </DocumentFieldFrame>
            </span>
            <span class="w-1/4 p-1">
                <DocumentFieldFrame>
                    <DocumentFieldInput :modelValue="'Quantité : ' + item.qty" :fontBold="true" />
                </DocumentFieldFrame>
            </span>
            <span class="w-1/4 p-1 grid grid-cols-2 items-center">
                <DocumentFieldFrame>
                    <DocumentFieldInput :modelValue="'Tarif HT : ' + item.priceHT" :fontBold="true" />
                </DocumentFieldFrame>
                <SelectMeasurement class="p-1"/>
            </span>
            <span class="w-1/4 p-1">
                <DocumentFieldFrame>
                    <DocumentFieldInput :modelValue="'Tarif TTC : ' + item.priceTTC" :fontBold="true" />
                </DocumentFieldFrame>
            </span>
            <span class="grid grid-cols-2 items-center">
                <Dropdown placement="bottom-end">
                    <AddOptionButton />
                    <template #popper>
                        <SettingsAddButtonPopperContent @addingOption="addRow" />
                    </template>
                </Dropdown>
                <RemoveButton @click="removeRow(index)" />
            </span>
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
import SelectMeasurement from "@/Components/Atoms/SelectMeasurement.vue";
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