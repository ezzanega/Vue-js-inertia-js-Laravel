<template>
    <Modal :show="openModal" @close="closeModal">
        <div class="w-full p-6 flex flex-col space-y-2">
            <div class="mt-2 border-b border-gray-200 divide-x">
                <p class="text-lg ml-2 font-semibold leading-6 text-gray-900">
                    Modifier la facture
                </p>
            </div>

            <div class="my-6 space-y-5">
                <DefaultSelectInput
                    name="type"
                    label="Type de facture"
                    v-model="form.type"
                    :options="typesOptions"
                    :error="form.errors.type"
                />
                <DefaultInput
                  :required="true"
                  type="date"
                  name="date"
                  label="Date de la Facture"
                  v-model="form.date"
                  :error="form.errors.date"
                  class="flex-grow mr-4"
                />
                <DefaultInput
                    :required="true"
                    type="text"
                    name="amount_ht"
                    v-model="form.amount"
                    :error="form.errors.amount"
                    @keydown.space.prevent
                    label="Montant de la facture (HT)"
                    placeholder="Montant de la facture (HT)"
                />
            </div>
            <div class="my-6  flex">
                <DefaultInput
                  :required="true"
                  type="text"
                  name="amount_htt"
                  label="Montant de la facture (TTC)"
                  v-model="form.amount_ttc"
                  :error="form.errors.amount_ttc"
                  class="flex-grow mr-4"
                  :disabled="true"
                />
                <DefaultInput
                  :required="true"
                  type="text"
                  name="amount_ht"
                  label="Montant de la facture (TVA)"
                  v-model="form.amount_tva"
                  :error="form.errors.amount_tva"
                  class="flex-grow"
                  :disabled="true"
                />
              </div>

            <div class="w-full">
                <div class="mt-5 pt-8 flex justify-end space-x-4">
                    <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>
                    <DefaultButton @click="UpdateInvoice" class="w-32"
                    buttontext="Valider" />
                </div>
            </div>
        </div>
        </Modal>
</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { ref, watch } from "vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import { useForm , usePage } from "@inertiajs/vue3";


const props = defineProps({
    invoice: Object,
    openModal: Boolean,
});
const emit = defineEmits(["closeModal"]);

const closeModal = () => {
    form.reset();
    emit("closeModal");
};
const page = usePage();
console.log(page.props.settings.vat)
const typesOptions = [
    {
        name: "Acompte",
        value: "advance"
    },
    {
        name: "Solde",
        value: "balance"
    }
];

const form = useForm({
    type: props.invoice.type,
    amount: props.invoice.amount_ht,
    amount_ttc:props.invoice.amount_ttc,
    amount_tva:props.invoice.amount_tva,
    date: props.invoice.date,
  });

// Create a watcher to calculate amount_ttc and amount_tva when amount_ht changes
watch(() => form.amount, (newAmount, oldAmount) => {
    // Ensure the newAmount is a valid number
    if (!isNaN(newAmount)) {
        const vatPercentage = page.props.settings.vat;
        const amountHt = parseFloat(newAmount);

        // Calculate amount_ttc and amount_tva
        const amountTtc = (amountHt + (amountHt * vatPercentage / 100)).toFixed(2);
        const amountTva = ((amountHt * vatPercentage) / 100).toFixed(2);

        // Update the form values
        form.amount_ttc = amountTtc;
        form.amount_tva = amountTva;
    }
});

const UpdateInvoice = () => {

    form.put(route("6dem.invoice.updateAmountsInvoice", props.invoice.id),{
        preserveScroll: true,
        preserveState: true,
        replace: true,
        onSuccess: () => {
            // watchEffect(() => {
            //     if (props.searchingInvoice) {
            //         props.searchInvoice();
            //         //console.log(props.searchingWaybill);
            //     };
            // });
            closeModal();
        },
        onError: (errors) => console.log(errors)
    });
};
</script>
