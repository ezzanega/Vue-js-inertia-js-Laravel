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

                <div class="flex flex-col py-2">
                  <h2 class="text-lg underline">Couleurs par défaut dans les documents</h2>
                  <div class="grid grid-cols-2 gap-4 mt-2">
                    <ColorPicker name="ducuments_primary_color" label="Couleur primaire documents"
                      :color="form.ducuments_primary_color" v-model="form.ducuments_primary_color" />
                    <ColorPicker name="ducuments_secondary_color" label="Couleur secondaire documents"
                      :color="form.ducuments_secondary_color" v-model="form.ducuments_secondary_color" />
                  </div>
                </div>
                <div class="flex flex-col py-2">
                  <h2 class="text-lg underline">Couleurs par défaut dans l'agenda</h2>
                  <div class="grid grid-cols-2 gap-4 mt-2">
                    <ColorPicker name="calendar_meeting_color" label="Rendez-vous"
                      :color="form.calendar_meeting_color" v-model="form.calendar_meeting_color" />
                    <ColorPicker name="calendar_moving_color" label="Déménagement"
                      :color="form.calendar_moving_color" v-model="form.calendar_moving_color" />
                    <ColorPicker name="calendar_cartons_delivery_color" label="Livraison de cartons"
                      :color="form.calendar_cartons_delivery_color" v-model="form.calendar_cartons_delivery_color" />
                    <ColorPicker name="calendar_others_color" label="Autres"
                      :color="form.calendar_others_color" v-model="form.calendar_others_color" />
                  </div>
                </div>
                
                <div class="py-6">
                  <span>Conditions générales documents (dans le devis)</span>
                  <div class="max-h-96 overflow-auto">
                    <ckeditor :editor="editor" v-model="form.ducuments_general_conditions" :config="editorConfig"></ckeditor>
                  </div>
                </div>

                <DefaultInput name="vat" type="number" label="TVA (en %)"
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
                <DefaultButton type="submit" buttontext="Valider" />
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
import ColorPicker from "@/Components/Atoms/ColorPicker.vue";
import Message from "@/Components/Atoms/Message.vue";
import { usePage, useForm } from "@inertiajs/vue3";
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import '@ckeditor/ckeditor5-build-classic/build/translations/fr';

const editor = ClassicEditor
const editorConfig = {
  language: 'fr',
  toolbar: [
    'undo', 'redo', 
    '|', 
    'bold', 'italic', 'underline', 
    '|', 
    'link', 
    '|', 
    'fontSize', 'fontColor', 
    '|', 
    'alignment', 
    '|', 
    'bulletedList', 'numberedList'
  ]
}

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
  bic: "",
  calendar_meeting_color: "",
  calendar_moving_color: "",
  calendar_cartons_delivery_color: "",
  calendar_others_color: "",
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
form.calendar_meeting_color = settings.calendar_meeting_color;
form.calendar_moving_color = settings.calendar_moving_color;
form.calendar_cartons_delivery_color = settings.calendar_cartons_delivery_color;
form.calendar_others_color = settings.calendar_others_color;

const updateSettings = () => {
  form.put(route("6dem.settings.update"), {
    preserveScroll: true,
    onSuccess: (resp) => console.log(resp),
  });
};
</script>
  