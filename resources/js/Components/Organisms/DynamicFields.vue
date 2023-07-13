<template>
    <div v-for="item, index in options" :key="item">
        <div class="flex space-x-2">
            <span class="w-1/4 p-1 flex-none">
                <DocumentFieldFrame>
                    <DocumentFieldInput v-model="item.description" placeholder="Description" :fontBold="true" @savingValue="saveField('designation', item.id, item.description)"/>
                </DocumentFieldFrame>
            </span>
            <span class="w-1/4 p-1 grid grid-cols-2 items-center">
                <DocumentFieldFrame>
                    <DocumentFieldInput v-model="item.qty" placeholder="Quantité" :fontBold="true" @savingValue="saveField('quantity', item.id, item.qty)"/>
                </DocumentFieldFrame>
                <SelectMeasurement :selected="item.selectedMeasurement" class="p-1" @savingMeasurement="(measurement) => saveField('unit', item.id, measurement)"/>
            </span>
            <span class="w-1/4 p-1">
                <DocumentFieldFrame>
                    <DocumentFieldInput v-model="item.priceHT" placeholder="Tarif HT" :fontBold="true" @savingValue="saveField('price_ht', item.id, item.priceHT)"/>
                </DocumentFieldFrame>
            </span>
            <span class="w-1/4 p-1">
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
                <RemoveButton @click="removeRow(index)" />
            </span>
        </div>
    </div>
</template>

<script setup>
import { reactive } from 'vue';
import { useForm } from "@inertiajs/vue3";
import { ref } from 'vue';
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";
import SettingsAddButtonPopperContent from "@/Components/Atoms/SettingsAddButtonPopperContent.vue";
import DocumentFieldFrame from "@/Components/Atoms/DocumentFieldFrame.vue";
import AddOptionButton from "@/Components/Atoms/AddOptionButton.vue";
import RemoveButton from "@/Components/Atoms/RemoveButton.vue";
import SelectMeasurement from "@/Components/Atoms/SelectMeasurement.vue";
import { Dropdown } from "floating-vue";

const props = defineProps({
    option_id: Number,
    movingjob: Number
});

const id = ref(null);
const option = useForm({
  type: "other-option",
  designation: "",
  quantity: "",
  unit: "",
  price_ht: ""
});

const options = reactive([
    { id:props.option_id, description: '', qty: '', priceHT: '', priceTTC: '', selectedMeasurement:0 }
]);

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
    option.unit = "jours(s)";
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
    option.unit = "heure(s)";
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
    option.unit = "kg";
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


const removeRow = (index) => {
    if (options.length > 1) {
        options.splice(index, 1)
    }
};

const saveField = (field, id, value) => {
    option[field] = value
    option.put(route("6dem.option.update", {id : id, field: field}), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => console.log("saved"),
    });
};

</script>