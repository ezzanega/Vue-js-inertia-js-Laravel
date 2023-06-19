<template>
  <div>
    <div class="flex flex-col space-y-5 p-10">
      <div class="grid grid-cols-3 gap-4 justify-between">
        <UploadFile class="w-1/2" label="Déposez ou cliquez si vous souhaitez ajouter votre logo" />
        <div class="p-2 h-auto">
          <div class="mb-2">
            <DocumentFieldInput placeholder="Adresse de la société" :fontBold="true" />
          </div>
          <div class="mb-2">
            <DocumentFieldInput placeholder="Téléphone" :fontBold="true" />
          </div>
          <div class="mb-2">
            <DocumentFieldInput placeholder="Adresse mail" :fontBold="true" />
          </div>
          <DynamicHeaderFields />
        </div>
        <div class="p-2 h-auto">
          <div class="mb-2">
            <DocumentFieldInput placeholder="SIREN" :fontBold="true" />
          </div>
          <div class="mb-2">
            <DocumentFieldInput placeholder="CODE APE" :fontBold="true" />
          </div>
          <div class="mb-2">
            <DocumentFieldInput placeholder="LICENCE N°" :fontBold="true" />
          </div>
          <DynamicHeaderFields />
        </div>
      </div>
      <div class="grid grid-cols-2 gap-20 pb-5 justify-between">
        <div class="flex flex-col space-y-2">
          <DocumentFieldFrame>
            <DocumentFieldInput modelValue="DEVIS N° 050623001" :fontBold="true" />
          </DocumentFieldFrame>
          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Conseiller: ' + user.first_name + ' ' + user.last_name
                " :fontBold="true" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Tél: ' + user.phone_number" :fontBold="true" />
            </DocumentFieldFrame>
          </div>

          <DocumentFieldFrame :removable="true">
            <DocumentFieldInput modelValue="Validité devis : 7 jours " :fontBold="true" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Volume: '" :fontBold="true" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Catégorie: '" :fontBold="true" />
            </DocumentFieldFrame>
          </div>
        </div>

        <div class="flex flex-col space-y-2">
          <DocumentFieldFrame>
            <DocumentFieldInput modelValue="Client" :fontBold="true" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Nom: ' + user.last_name" :fontBold="true" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Prenom: ' + user.first_name" :fontBold="true" />
            </DocumentFieldFrame>
          </div>

          <DocumentFieldFrame>
            <DocumentFieldInput :modelValue="'Adresse: '" :fontBold="true" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Tel: ' + user.phone_number" :fontBold="true" />
            </DocumentFieldFrame>
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Email: ' + user.email" :fontBold="true" />
            </DocumentFieldFrame>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-20 justify-between">
        <div class="flex flex-col space-y-2">
          <DocumentLabel name="CHARGEMENT" color="#438A7A" />

          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Date ou période" :fontBold="true" />
          </DocumentFieldFrame>

          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Adresse" :fontBold="true" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="CP" :fontBold="true" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Ville" :fontBold="true" />
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Étage" :fontBold="true" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Ascenseur" :fontBold="true" />
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Portage" :fontBold="true" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Détails" :fontBold="true" />
            </DocumentFieldFrame>
          </div>
        </div>

        <div class="flex flex-col space-y-2">
          <DocumentLabel name="LIVRAISON" color="#438A7A" />

          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Date ou période" :fontBold="true" />
          </DocumentFieldFrame>

          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Adresse" :fontBold="true" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="CP" :fontBold="true" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Ville" :fontBold="true" />
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Étage" :fontBold="true" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Ascenseur" :fontBold="true" />
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Portage" :fontBold="true" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Détails" :fontBold="true" />
            </DocumentFieldFrame>
          </div>
        </div>
      </div>
      <div class="flex flex-col mt-4 space-y-2">
        <DocumentLabel name="OPTIONS" color="#438A7A" />
      </div>
      <div class="flex flex-col space-y-2">
        <DynamicFields />
      </div>
      <div class="flex flex-col mt-4 space-y-5">
        <DocumentLabel name="FINALISATION DU DEVIS" color="#438A7A" />
        <div class="flex space-x-2">
          <span class="w-2/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Assurance contractuelle : '" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Valeur max par objet : '" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Franchise : '" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant HT" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant TTC" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
        </div>
        <div class="flex space-x-2">
          <span class="w-2/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Assurance contractuelle : '" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Valeur max par objet : '" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Franchise : '" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant HT" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/6 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant TTC" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
        </div>
        <div class="flex space-x-2">
          <span class="w-1/4 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Tarification'" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/4 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant HT" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/4 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant TTC" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/4 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Remise en %" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
        </div>
        <div class="flex space-x-2">
          <span class="w-1/2 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput :modelValue="'Modalités de règlement'" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/4 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Acompte en %" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
          <span class="w-1/4 p-1">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Solde en %" :fontBold="true" />
            </DocumentFieldFrame>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import UploadFile from "@/Components/Atoms/UploadFile.vue";
import DocumentFieldFrame from "@/Components/Atoms/DocumentFieldFrame.vue";
import DynamicHeaderFields from "@/Components/Organisms/DynamicHeaderFields.vue";
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";
import DocumentLabel from "@/Components/Atoms/DocumentLabel.vue";
import DynamicFields from "@/Components/Organisms/DynamicFields.vue";

const user = usePage().props.auth.user;
</script>