<template>
    <div v-for="item, index in options" :key="item">
        <div class="flex space-x-2">
            <span class="border border-gray-700 w-1/4 p-1">
                <DocumentFieldInput :modelValue="'Description : ' + item.description" :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/4 p-1">
                <DocumentFieldInput :modelValue="'Quantité : ' + item.qty" :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/4 p-1">
                <DocumentFieldInput :modelValue="'Tarif HT : ' + item.priceHT" :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/4 p-1">
                <DocumentFieldInput :modelValue="'Tarif TTC : ' + item.priceTTC" :fontBold="true" />
            </span>
        </div>
        <div class="flex flex-row space-x-2 justify-center mt-3">
            <Dropdown placement="bottom-end">
                <AddButton />
                <template #popper>
                    <SettingsAddButtonPopperContent @addingOption="addRow" />
                </template>
            </Dropdown>
            <RemoveButton @click="removeRow(index)" />
        </div>
    </div>
</template>

<script setup>
import { reactive } from 'vue'
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";
import SettingsAddButtonPopperContent from "@/Components/Atoms/SettingsAddButtonPopperContent.vue";
import AddButton from "@/Components/Atoms/AddButton.vue";
import RemoveButton from "@/Components/Atoms/RemoveButton.vue";
import { Dropdown } from "floating-vue";

const options = reactive([
    { description: '', qty: 0, priceHT: 0, priceTTC: 0 }
])

const addRow = () => {
    options.push({ description: '', qty: 0, priceHT: 0, priceTTC: 0 })
}

const removeRow = (index) => {
    if (options.length > 1) {
        options.splice(index, 1)
    }
}

const saveItem = () => {
}

</script>