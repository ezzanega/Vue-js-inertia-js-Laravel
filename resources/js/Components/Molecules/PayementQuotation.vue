<template>
  <Modal :show="isModal_payment_quot_Open" >
    <div  class="flex min-h-0 flex-1 flex-col py-6 overflow-y-scroll">
      <div class="px-4 sm:px-6">
        <div class="flex items-start justify-between">
          <div class="space-y-1">
            <h2
              id="headlessui-dialog-title-15"
              data-headlessui-state="open"
              class="text-lg font-medium"
            >
              Enregistrer un paiement
            </h2>
          </div>
          <div class="ml-3 flex h-7 items-center">
            <button
              type="button"
              class="rounded-md bg-white text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-primary-500"
              tabindex="0"
              @click="closePayQuotModal()"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                aria-hidden="true"
                class="h-6 w-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <div class="px-4 sm:px-6">
        <div class="w-full py-3 flex flex-col space-y-2">
            <div class="my-6 space-y-5">
              <DefaultSelectInput
                name="type"
                label="Type de facture"
                :options="TypeFactureOption"
                :error="form.errors.type"
                v-model="form.type"
              />
            </div>
            <div class="my-6 space-y-5">
              <DefaultInput
                :required="true"
                type="date"
                name="date"
                label="Date du paiement"
                v-model="form.date"
                :error="form.errors.date"
              />
            </div>
            <div class="my-6  flex">
              <DefaultInput
                :required="true"
                type="text"
                name="montant"
                label="Montant"
                v-model="form.montant"
                :error="form.errors.montant"
                class="flex-grow mr-4"
              />
              <DefaultInput
                :required="true"
                type="text"
                name="reference"
                label="Référence du paiement"
                v-model="form.reference"
                :error="form.errors.reference"
                class="flex-grow"
              />
            </div>

            <div class="my-6 space-y-5">
              <DefaultSelectInput
                name="moyen"
                label="Moyen de paiement"
                :options="MoyenPayementOption"
                v-model="form.moyen_payment"
                :error="form.errors.moyen_payment"
              />
            </div>

            <div class="mt-6 flex justify-end space-x-4">
              <SecondaryButton @click="closePayQuotModal"> Annuler </SecondaryButton>
              <DefaultButton @click="SavePayment(props.selectedvalue)" class="w-32" buttontext="Enregistrer" />
            </div>
        </div>
      </div>

    </div>
  </Modal>
</template>


<script setup>
  import Modal from "@/Components/Modal.vue";
  import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";
  import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
  import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
  import SecondaryButton from "@/Components/SecondaryButton.vue";
  import { useForm } from "@inertiajs/vue3";

  const props = defineProps({
      isModal_payment_quot_Open : Boolean,
      selectedvalue: Number,
  });

  const emit = defineEmits(["closePayQuotModal"]);
  const TypeFactureOption = [
    { name: "Accompte", value: "advance" },
    { name: "Solde", value: "balance" }
  ];

  const MoyenPayementOption = [
    { name: "Virement", value: "Virement" },
    { name: "Check", value: "Check" },
    { name: "Carte bancaire", value: "Carte bancaire" },
    { name: "Mandat", value: "Mandat" },
    { name: "Espèce", value: "Espèce" },
  ];

  const form = useForm({
    type:"",
    date:"",
    montant: "",
    reference: "",
    moyen_payment: "",
  });

  const SavePayment = (id) => {
    form.put(route("6dem.documents.payment.quotation", {id: id}),
    {
      preserveScroll: true,
      replace: true,
      onSuccess: () => closePayQuotModal(),
    });
  };

  const closePayQuotModal = () => {
      emit("closePayQuotModal");
  };
</script>
