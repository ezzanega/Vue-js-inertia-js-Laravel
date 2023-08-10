<template>
    <div v-for="item, index in options" :key="item">
        <div class="flex space-x-2">
            <span class="w-1/5 p-1 flex-none">
                <DocumentFieldFrame>
                    <DocumentFieldInput v-model="item.description" placeholder="Description" :fontBold="true" @savingValue="saveField('designation', item.id, item.description)"/>
                </DocumentFieldFrame>
            </span>
            <span class="w-1/5 p-1">
                <DocumentFieldFrame>
                    <DocumentFieldInput v-model="item.qty" placeholder="Quantité" :fontBold="true" @savingValue="saveField('quantity', item.id, item.qty)"/>
                </DocumentFieldFrame>
            </span>
            <span class="w-1/5 p-1">
                <DocumentSelectInput v-model="item.selectedMeasurement" :value="item.selectedMeasurement" @change="() => saveField('unit', item.id, item.selectedMeasurement)" :options="measurementOptions" default-text="Unité"/>
            </span>
            <span class="w-1/5 p-1">
                <DocumentFieldFrame>
                    <DocumentFieldInput class="w-full" v-model="item.priceHT" placeholder="Tarif HT" :fontBold="true" @savingValue="saveField('price_ht', item.id, item.priceHT)"/>
                </DocumentFieldFrame>
            </span>
            <span class="w-1/5 p-1">
                <DocumentFieldFrame>
                    <DocumentFieldInput placeholder="Tarif TTC" :fontBold="true" />
                </DocumentFieldFrame>
            </span>
            <span class="flex items-center">
                <Dropdown placement="bottom-end">
                    <AddOptionButton />
                    <template #popper>
                        <SettingsAddButtonPopperContent @addingElevator="addRowElevator" @addingPiano="addRowPiano" @addingWarehouse="addRowWarehouse" @addingNew="addRow" />
                    </template>
                </Dropdown>
                <RemoveButton @click="removeRow(index, item.id)" />
            </span>
        </div>
    </div>
</template>

<script setup>
import { reactive } from 'vue';
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from 'vue';
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";
import SettingsAddButtonPopperContent from "@/Components/Atoms/SettingsAddButtonPopperContent.vue";
import DocumentFieldFrame from "@/Components/Atoms/DocumentFieldFrame.vue";
import AddOptionButton from "@/Components/Atoms/AddOptionButton.vue";
import RemoveButton from "@/Components/Atoms/RemoveButton.vue";
import DocumentSelectInput from "@/Components/Atoms/DocumentSelectInput.vue";
import { Dropdown } from "floating-vue";

const currentOptions = usePage().props.options;

const measurementOptions = [
    { name: 'Unité', value: 0 },
    { name: 'Forfaitaire', value: 1 },
    { name: 'm³', value: 2 },
    { name: 'tonne', value: 3 },
    { name: 'kg', value: 4 },
    { name: 'g', value: 5 },
    { name: 'm', value: 6 },
    { name: 'jour(s)', value: 7 },
    { name: 'heure(s)', value: 8 },
    { name: 'bonhomme(s)', value: 9 },
];

const props = defineProps({
    movingjob: Number
});

const id = ref(null);
const option = useForm({
  type: "other-option",
  designation: "",
  quantity: "",
  unit: 0,
  price_ht: ""
});

const options = reactive(currentOptions.map(function(option){
    return { id: option.id, description: option.designation, qty: option.quantity, priceHT: option.price_ht, priceTTC: option.price_ht, selectedMeasurement: option.unit }
    })
)

const addRow = () => {
    axios.post(route("6dem.option.create", props.movingjob), option)
        .then(response => {
            options.push({ id: response.data, description: '', qty: '', priceHT: '', priceTTC: '', selectedMeasurement:0 })
        })
        .catch(error => {
            // Handle the error
            console.error(error);
        }
    );
};

const addRowWarehouse = () => {
    option.type = "warehouse-option";
    option.unit = 7;
    axios.post(route("6dem.option.create", props.movingjob), option)
        .then(response => {
            options.push({ id: response.data, description: 'Stockage en garde meuble', qty: '', priceHT: '', priceTTC: '', selectedMeasurement:7 })
        })
        .catch(error => {
            // Handle the error
            console.error(error);
        }
    );  
};

const addRowElevator = () => {
    option.type = "elevator-option";
    option.unit = 8;
    axios.post(route("6dem.option.create", props.movingjob), option)
        .then(response => {
            options.push({ id: response.data, description: 'Monte meuble', qty: 0, priceHT: 0, priceTTC: 0, selectedMeasurement:8 })
        })
        .catch(error => {
            // Handle the error
            console.error(error);
        }
    );
};

const addRowPiano = () => {
    option.type = "piano-option";
    option.unit = 4;
    axios.post(route("6dem.option.create", props.movingjob), option)
        .then(response => {
            options.push({ id: response.data, description: 'Transport de piano', qty: 0, priceHT: 0, priceTTC: 0, selectedMeasurement:4 })
        })
        .catch(error => {
            // Handle the error
            console.error(error);
        }
    );
};


const removeRow = (index, id) => {
    axios.delete(route("6dem.option.delete", id))
        .then(response => {
            if (options.length > 1) {
                options.splice(index, 1)
            }
        })
        .catch(error => {
            // Handle the error
            console.error(error);
        }
    );
};

const saveField = (field, id, value) => {
    option[field] = value;
    option.put(route("6dem.option.update", {id : id, field: field}), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => console.log("saved"),
        onError: (errors) => console.log(errors),
    });
};

</script>