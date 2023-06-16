<template>
  <div>
    <div class="flex flex-col space-y-5 p-10">
      <div class="grid grid-cols-3 gap-4 justify-between">
        <UploadFile class="w-1/2" label="Déposez ou cliquez si vous souhaitez ajouter votre logo" />
        <div class="p-2 h-auto">
          <DocumentFieldInput placeholder="Adresse de la société" :fontBold="true" />
          <DocumentFieldInput placeholder="Téléphone" :fontBold="true" />
          <DocumentFieldInput placeholder="Adresse mail" :fontBold="true" />
        </div>
        <div class="p-2 h-auto">
          <DocumentFieldInput placeholder="SIREN" :fontBold="true" />
          <DocumentFieldInput placeholder="CODE APE" :fontBold="true" />
          <DocumentFieldInput placeholder="LICENCE N°" :fontBold="true" />
        </div>
        <!-- <div class="flex flex-col items-end">
          <img
            class="w-1/2"
            :src="'/img/label-qualite.jpeg'"
            alt="label qualite"
          />
        </div> -->
      </div>
      <div class="grid grid-cols-2 gap-20 pb-5 justify-between">
        <div class="flex flex-col space-y-2">
          <span class="border border-gray-700 w-full p-1">
            <DocumentFieldInput modelValue="DEVIS N° 050623001" :fontBold="true" />
          </span>
          <div class="flex space-x-2">
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="
                'Conseiller: ' + user.first_name + ' ' + user.last_name
              " :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Tél: ' + user.phone_number" :fontBold="true" />
            </span>
          </div>

          <span class="border border-gray-700 w-full p-1">
            <DocumentFieldInput modelValue="Validité devis : 7 jours " :fontBold="true" />
          </span>
          <div class="flex space-x-2">
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Volume: '" :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Catégorie: '" :fontBold="true" />
            </span>
          </div>
        </div>

        <div class="flex flex-col space-y-2">
          <span class="border border-gray-700 w-full p-1">
            <DocumentFieldInput modelValue="Client" :fontBold="true" />
          </span>
          <div class="flex space-x-2">
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="
                'Nom: ' + user.last_name
              " :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Prenom: ' + user.first_name" :fontBold="true" />
            </span>
          </div>

          <span class="border border-gray-700 w-full p-1">
            <DocumentFieldInput :modelValue="'Adresse: '" :fontBold="true" />
          </span>
          <div class="flex space-x-2">
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Tel: ' + user.phone_number" :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Email: ' + user.email" :fontBold="true" />
            </span>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-20 justify-between">
        <div class="flex flex-col space-y-2">
          <DocumentLabel name="CHARGEMENT" color="#438A7A" />
          <div class="flex space-x-2">
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Date ou période'" :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput placeholder="Date" :fontBold="true" />
            </span>
          </div>
          <div class="flex space-x-2">
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Adresse'" :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput placeholder="Adresse" :fontBold="true" />
            </span>
          </div>

          <div class="flex space-x-2">
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'CP : '" :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Ville : '" :fontBold="true" />
            </span>
          </div>

          <div class="flex space-x-2">
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Étage : '" :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Ascenseur : '" :fontBold="true" />
            </span>
          </div>

          <div class="flex space-x-2">
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Portage : '" :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Détails : '" :fontBold="true" />
            </span>
          </div>
        </div>

        <div class="flex flex-col space-y-2">
          <DocumentLabel name="LIVRAISON" color="#438A7A" />
          <div class="flex space-x-2">
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Date ou période'" :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput placeholder="Date" :fontBold="true" />
            </span>
          </div>
          <div class="flex space-x-2">
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Adresse'" :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput placeholder="Adresse" :fontBold="true" />
            </span>
          </div>

          <div class="flex space-x-2">
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'CP : '" :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Ville : '" :fontBold="true" />
            </span>
          </div>

          <div class="flex space-x-2">
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Étage : '" :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Ascenseur : '" :fontBold="true" />
            </span>
          </div>

          <div class="flex space-x-2">
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Portage : '" :fontBold="true" />
            </span>
            <span class="border border-gray-700 w-1/2 p-1">
              <DocumentFieldInput :modelValue="'Détails : '" :fontBold="true" />
            </span>
          </div>
        </div>
      </div>
      <div class="flex flex-col space-y-2">
        <DocumentLabel name="OPTIONS" color="#438A7A" />
      </div>
      <div class="flex flex-col space-y-2">
        <DynamicFields />
      </div>
      <div class="flex flex-col space-y-5">
        <DocumentLabel name="FINALISATION DU DEVIS" color="#438A7A" />
        <div class="flex space-x-2">
          <span class="border border-gray-700 w-2/6 p-1">
            <DocumentFieldInput :modelValue="'Assurance contractuelle : '" :fontBold="true" />
          </span>
          <span class="border border-gray-700 w-1/6 p-1">
            <DocumentFieldInput :modelValue="'Valeur max par objet : '" :fontBold="true" />
          </span>
          <span class="border border-gray-700 w-1/6 p-1">
            <DocumentFieldInput :modelValue="'Franchise : '" :fontBold="true" />
          </span>
          <span class="border border-gray-700 w-1/6 p-1">
            <DocumentFieldInput placeholder="Montant HT" :fontBold="true" />
          </span>
          <span class="border border-gray-700 w-1/6 p-1">
            <DocumentFieldInput placeholder="Montant TTC" :fontBold="true" />
          </span>
        </div>
        <div class="flex space-x-2">
          <span class="border border-gray-700 w-2/6 p-1">
            <DocumentFieldInput :modelValue="'Assurance contractuelle : '" :fontBold="true" />
          </span>
          <span class="border border-gray-700 w-1/6 p-1">
            <DocumentFieldInput :modelValue="'Valeur max par objet : '" :fontBold="true" />
          </span>
          <span class="border border-gray-700 w-1/6 p-1">
            <DocumentFieldInput :modelValue="'Franchise : '" :fontBold="true" />
          </span>
          <span class="border border-gray-700 w-1/6 p-1">
            <DocumentFieldInput placeholder="Montant HT" :fontBold="true" />
          </span>
          <span class="border border-gray-700 w-1/6 p-1">
            <DocumentFieldInput placeholder="Montant TTC" :fontBold="true" />
          </span>
        </div>
        <div class="flex space-x-2">
          <span class="border border-gray-700 w-1/4 p-1">
            <DocumentFieldInput :modelValue="'Tarification'" :fontBold="true" />
          </span>
          <span class="border border-gray-700 w-1/4 p-1">
            <DocumentFieldInput placeholder="Montant HT" :fontBold="true" />
          </span>
          <span class="border border-gray-700 w-1/4 p-1">
            <DocumentFieldInput placeholder="Montant TTC" :fontBold="true" />
          </span>
          <span class="border border-gray-700 w-1/4 p-1">
            <DocumentFieldInput placeholder="Remise en %" :fontBold="true" />
          </span>
        </div>
        <div class="flex space-x-2">
          <span class="border border-gray-700 w-1/2 p-1">
            <DocumentFieldInput :modelValue="'Modalités de règlement'" :fontBold="true" />
          </span>
          <span class="border border-gray-700 w-1/4 p-1">
            <DocumentFieldInput placeholder="Acompte en %" :fontBold="true" />
          </span>
          <span class="border border-gray-700 w-1/4 p-1">
            <DocumentFieldInput placeholder="Solde en %" :fontBold="true" />
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import UploadFile from "@/Components/Atoms/UploadFile.vue";
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";
import DocumentLabel from "@/Components/Atoms/DocumentLabel.vue";
import DynamicFields from "@/Components/Organisms/DynamicFields.vue";

const user = usePage().props.auth.user;
</script>