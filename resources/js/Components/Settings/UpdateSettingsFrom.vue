<template>
  <div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <h3 class="text-lg font-medium leading-6 text-neutral-900">
          Paramètres
        </h3>
        <p class="mt-1 text-sm text-neutral-600">
          Mettez à jour les paramètres de votre compte.
        </p>
      </div>
      <div class="mt-5 md:col-span-2 md:mt-0">
        <form @submit.prevent="updateSettings">
          <div class="card bg-white ring-1 ring-neutral-600 ring-opacity-5 rounded-lg shadow overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
              <Message v-show="$page.props.status === 'settings-updated'" status="success"
                message="Vos paramètres ont été mis à jour" />
              <div class="w-full pt-3 flex flex-col mb-2 space-y-2">
                <DefaultInput name="quotation_validity_duratation" label="Durée de validité de devis par défaut"
                  placeholder="1 semaine, 1 mois, 1 an, ..." v-model="form.quotation_validity_duratation"
                  :error="form.errors.quotation_validity_duratation" />

                <div class="py-6 flex flex-col space-y-5">
                  <ColorPicker name="ducuments_primary_color" label="Couleur primaire documents"
                    :color="form.ducuments_primary_color" v-model="form.ducuments_primary_color" />
                  <ColorPicker name="ducuments_secondary_color" label="Couleur secondaire documents"
                    :color="form.ducuments_secondary_color" v-model="form.ducuments_secondary_color" />
                </div>

                <TextArea name="ducuments_general_conditions" label="Conditions générales documents"
                  v-model="form.ducuments_general_conditions" :error="form.errors.ducuments_general_conditions" />

                <TextArea name="legal_notice" label="Mentions légales" v-model="form.legal_notice"
                  :error="form.errors.legal_notice" />

                <DefaultInput name="quotation_validity_duratation" type="number" label="TVA (en %)"
                  v-model="form.vat" :error="form.errors.vat" />

                <DefaultSelectInput
                  name="paiement-process"
                  label="Modalités de règlement par défaut"
                  v-model="form.paiement_process"
                  :options="paiementProcessOPtions"
                  :error="form.errors.paiementProcess"
                />

                <DefaultInput name="invoice_iban" type="text" label="IBAN (à afficher sur la facture)"
                  v-model="form.iban" :error="form.errors.iban" />

                <DefaultInput name="invoice_bic" type="text" label="BIC (à afficher sur la facture))"
                  v-model="form.bic" :error="form.errors.bic" />
              </div>
            </div>
            <div class="bg-neutral-50 px-4 py-4 sm:px-6">
              <div class="flex justify-end">
                <DefaultButton type="submit" buttontext="Mise à jour des paramètres" />
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
  
<script setup>
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import TextArea from "@/Components/Atoms/TextArea.vue";
import ColorPicker from "@/Components/Atoms/ColorPicker.vue";
import Message from "@/Components/Atoms/Message.vue";
import { usePage, useForm } from "@inertiajs/vue3";

const settings = usePage().props.settings;

const form = useForm({
  quotation_validity_duratation: "",
  ducuments_general_conditions: "",
  ducuments_primary_color: "",
  ducuments_secondary_color: "",
  legal_notice: "",
  paiement_process: "",
  vat: "",
  iban: "",
  bic: ""
});

const paiementProcessOPtions = [
  {
    name:"Accompte/Solde 20%/80%",
    value:'20-80'
  },

  {
    name:"Accompte/Solde 30%/70%",
    value:'30-70'
  },
  {
    name:"Accompte/Solde 40%/60%",
    value:'40-60'
  },
  {
    name:"Accompte/Solde 50%/50%",
    value:'50-50'
  },
  {
    name:"Accompte/Solde 60%/40%",
    value:'50-50'
  },
  {
    name:"Règlement en 1 fois",
    value:'100'
  },
  {
    name:"Autres",
    value:'Others'
  }
]

form.quotation_validity_duratation = settings.quotation_validity_duratation;
form.ducuments_general_conditions = settings.ducuments_general_conditions;
form.ducuments_primary_color = settings.ducuments_primary_color;
form.ducuments_secondary_color = settings.ducuments_secondary_color;
form.legal_notice = settings.legal_notice;
form.paiement_process = settings.paiement_process;
form.vat = settings.vat;
form.iban = settings.iban;
form.bic = settings.bic;

const updateSettings = () => {
  form.put(route("6dem.settings.update"), {
    preserveScroll: true,
    onSuccess: (resp) => console.log(resp),
  });
};
</script>
  