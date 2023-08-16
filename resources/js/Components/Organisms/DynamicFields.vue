<template>
    <div class="flex flex-col space-y-2">
        <div class="flex space-x-2  p-1 border border-gray-200 rounded-md bg-gray-100 flex-grow">
            <span class="w-full text-left p-1">Désignation</span>
            <span class="w-full text-left p-1">Quantité</span>
            <span class="w-full text-left p-1">Unité</span>
            <span class="w-full text-left p-1">Prix unitaire HT</span>
            <span class="w-full text-left p-1">Prix total HT</span>
        </div>
        <div v-for="item, index in options" :key="item">
            <div class="flex space-x-2">
                <span class="w-1/5 flex-none">
                    <DocumentFieldFrame>
                        <DocumentFieldInput :value="item.description" v-model="item.description" placeholder="Description" :fontBold="true" @savingValue="saveField('designation', item.id, item.description)"/>
                    </DocumentFieldFrame>
                </span>
                <span class="w-1/5">
                    <DocumentFieldFrame>
                        <DocumentFieldInput :value="item.qty" v-model="item.qty" placeholder="Quantité" :fontBold="true" @savingValue="saveField('quantity', item.id, item.qty)"/>
                    </DocumentFieldFrame>
                </span>
                <span class="w-1/5">
                    <DocumentSelectInput v-model="item.selectedMeasurement" :value="item.selectedMeasurement" @change="() => saveField('unit', item.id, item.selectedMeasurement)" :options="measurementOptions" default-text="Choisir une unité"/>
                </span>
                <span class="w-1/5">
                    <DocumentFieldFrame>
                        <DocumentFieldInput :value="item.priceHT" class="w-full" v-model="item.priceHT" placeholder="Prix unitaire HT" :fontBold="true" @savingValue="saveField('unit_price_ht', item.id, item.priceHT)"/>
                    </DocumentFieldFrame>
                </span>
                <span class="w-1/5">
                    <DocumentFieldFrame>
                        <!-- <DocumentFieldInput :value="item.totalPriceHT" placeholder="Prix total TTC" :fontBold="true" /> -->
                        <div class="font-bold p-0.5">{{ item.totalPriceHT + ' €' }}</div>
                    </DocumentFieldFrame>
                </span>
                <span class="flex items-center">
                    <RemoveButton @click="removeRow(index, item.id)" />
                </span>
            </div>
        </div>
        <span class="flex items-center mx-auto">
            <Menu placement="bottom">
                <AddOptionButton />
                <template #popper>
                    <SettingsAddButtonPopperContent @addingElevator="addRowElevator" @addingPiano="addRowPiano" @addingWarehouse="addRowWarehouse" @addingNew="addRow" />
                </template>
            </Menu>
        </span>
    </div>
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { ref, reactive, watch } from 'vue';
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";
import SettingsAddButtonPopperContent from "@/Components/Atoms/SettingsAddButtonPopperContent.vue";
import DocumentFieldFrame from "@/Components/Atoms/DocumentFieldFrame.vue";
import AddOptionButton from "@/Components/Atoms/AddOptionButton.vue";
import RemoveButton from "@/Components/Atoms/RemoveButton.vue";
import DocumentSelectInput from "@/Components/Atoms/DocumentSelectInput.vue";
import { Menu } from "floating-vue";

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

const option = useForm({
  type: "other-option",
  designation: "",
  quantity: 0,
  unit: null,
  unit_price_ht: 0,
  total_price_ht: 0,
});

const options = reactive(
    currentOptions.map(function(option){
        return { 
            id: option.id, 
            description: option.designation, 
            qty: option.quantity,
            priceHT: option.unit_price_ht, 
            totalPriceHT: option.unit_price_ht ? parseFloat(option.unit_price_ht*option.quantity).toFixed(2) : 0.00,
            selectedMeasurement: option.unit 
        }
    })
)

watch(options, (newOptions) => {
    newOptions.forEach((item) => {
        item.totalPriceHT = parseFloat(item.priceHT * item.qty).toFixed(2); 
    });
}, { deep: true });


const addRow = () => {
    axios.post(route("6dem.option.create", props.movingjob), option)
        .then(response => {
            options.push({ id: response.data, description: '', qty: '', priceHT: '', totalPriceHT: '', selectedMeasurement:0 })
        })
        .catch(error => {
            console.error(error);
        }
    );
};

const addRowWarehouse = () => {
    option.type = "warehouse-option";
    option.unit = 7;
    option.designation = 'Stockage en garde meuble';
    axios.post(route("6dem.option.create", props.movingjob), option)
        .then(response => {
            options.push({ id: response.data, description: 'Stockage en garde meuble', qty: '', priceHT: '', totalPriceHT: '', selectedMeasurement:7 })
        })
        .catch(error => {
            console.error(error);
        }
    );  
};

const addRowElevator = () => {
    option.type = "elevator-option";
    option.unit = 8;
    option.designation = 'Monte meuble';
    axios.post(route("6dem.option.create", props.movingjob), option)
        .then(response => {
            options.push({ id: response.data, description: 'Monte meuble', qty: 0, priceHT: 0, totalPriceHT: 0.00, selectedMeasurement:8 })
        })
        .catch(error => {
            console.error(error);
        }
    );
};

const addRowPiano = () => {
    option.type = "piano-option";
    option.unit = 4;
    option.designation = 'Transport de piano';
    axios.post(route("6dem.option.create", props.movingjob), option)
        .then(response => {
            options.push({ id: response.data, description: 'Transport de piano', qty: 0, priceHT: 0, totalPriceHT: 0.00, selectedMeasurement:4 })
        })
        .catch(error => {
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