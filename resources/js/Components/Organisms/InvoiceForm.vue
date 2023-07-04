 <template>
  <div>
    <div class="flex flex-col space-y-5 p-10">
      <div class="grid grid-cols-3 gap-4 justify-between">
        <UploadFile
          class="w-1/2"
          label="Déposez ou cliquez si vous souhaitez ajouter votre logo"
        />
      </div>

      <div class="grid grid-cols-2 gap-20 pb-5 justify-between">
        <div class="flex flex-col space-y-2">
          <div class="p-2 h-auto">
            <div class="mb-2">
              <DocumentFieldInput
                placeholder="Adresse de la société"
                :fontBold="true"
              />
            </div>
            <div class="mb-2">
              <DocumentFieldInput placeholder="Téléphone" :fontBold="true" />
            </div>
            <div class="mb-2">
              <DocumentFieldInput placeholder="Adresse mail" :fontBold="true" />
            </div>
            <DynamicHeaderFields />
          </div>
        </div>

        <div class="flex flex-col space-y-2">
          <DocumentFieldFrame>
            <DocumentFieldInput modelValue="Client" :fontBold="true" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput
                :modelValue="'Nom: ' + user.last_name"
                :fontBold="true"
              />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput
                :modelValue="'Prenom: ' + user.first_name"
                :fontBold="true"
              />
            </DocumentFieldFrame>
          </div>

          <DocumentFieldFrame>
            <DocumentFieldInput :modelValue="'Adresse: '" :fontBold="true" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput
                :modelValue="'Tel: ' + user.phone_number"
                :fontBold="true"
              />
            </DocumentFieldFrame>
            <DocumentFieldFrame>
              <DocumentFieldInput
                :modelValue="'Email: ' + user.email"
                :fontBold="true"
              />
            </DocumentFieldFrame>
          </div>
          <DynamicQuoteFields />
        </div>
      </div>

      <div class="grid grid-cols-3 gap-4 justify-between">
        <div class="mx-auto">
          <DocumentFieldInput modelValue="Facture de solde" :fontBold="true" />
        </div>
        <div class="mx-auto">
          <DocumentFieldInput modelValue="N° 2023-04-0023" :fontBold="true" />
        </div>
        <div class="mx-auto">
          <DocumentFieldInput modelValue="Date: 23/04/2023" :fontBold="true" />
        </div>
      </div>

      <div class="mt-4 space-y-2">
        <div class="flex flex-col mx-0 mt-8">
          <table class="min-w-full divide-y divide-secondary">
            <thead class="border border-secondary">
              <tr>
                <th
                  scope="col"
                  class="py-3 pl-4 pr-3 text-left text-md font-bold text-primary sm:pl-6 md:pl-0"
                >
                  Désignation
                </th>
                <th
                  scope="col"
                  class="py-3 px-3 text-right text-md font-bold text-primary sm:table-cell"
                >
                  Quantité
                </th>
                <th
                  scope="col"
                  class="py-3 px-3 text-right text-md font-bold text-primary sm:table-cell"
                >
                  Prix unitaire HT
                </th>
                <th
                  scope="col"
                  class="py-3 pr-3 text-right text-md font-bold text-primary sm:pr-6 md:pr-0"
                >
                  Prix Total HT
                </th>
              </tr>
            </thead>
            <tbody class="border border-secondary">
              <InvoiceOptionGroupFields
                v-for="(item, index) in invoiceData"
                :key="index"
                :fieldsValues="item"
                :activatedFields="activatedFields"
              />
            </tbody>
            <tfoot>
              <tr class="flex justify-end mx-auto">
                <button
                  @click="addRow"
                  class="rounded-full p-0.5 bg-blue-200 text-blue-500 hover:text-blue-700"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    aria-hidden="true"
                    class="w-4 h-4"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 4.5v15m7.5-7.5h-15"
                    />
                  </svg>
                </button>
              </tr>
              <tr class="flex justify-end text-center text-xs mt-5">
                <DocumentFieldInput
                  modelValue="Rappel des termes du contrat : Déménagement de 2900,00 € HT"
                  :fontBold="false"
                />
              </tr>
            </tfoot>
          </table>
        </div>

        <div class="flex justify-end">
          <table class="divide-y divide-secondary border border-secondary">
            <tbody class="border border-secondary">
              <tr class="text-sm text-slate-500">
                <td class="border border-secondary px-3 py-4">
                  Total Hors Taxes
                </td>
                <td class="border border-secondary px-3 py-4">2000 €</td>
              </tr>
              <tr class="text-sm text-slate-500">
                <td class="border border-secondary px-3 py-4">TVA(20%)</td>
                <td class="border border-secondary px-3 py-4">200 €</td>
              </tr>
              <tr class="text-sm text-slate-500">
                <td class="border border-secondary px-3 py-4">Total TTC</td>
                <td class="border border-secondary px-3 py-4">2200 €</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="flex justify-start">
        <DocumentFieldInput
          class="text-primary"
          placeholder="Informations complémentaires (IBAN, BIC...)"
          :fontBold="false"
        />
      </div>

      <div
        class="text-xs text-center mx-auto flex flex-col items-center space-y-1"
      >
        <DocumentFieldInput
          modelValue="L’Agence du Déménagement - 1 Rue Aristide Briand 94250 Gentilly
            Enseigne HD DEM SARL Au Capital de 5500 € SIREN 840 635 957 code APE déménagement : 4942Z"
          :fontBold="false"
        />
        <DocumentFieldInput
          modelValue="En cas de retard, une pénalité au taux annuel de 5 % sera appliquée, à laquelle s'ajoutera une indemnité forfaitaire pour frais de recouvrement de 40 €"
          :fontBold="false"
        />
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
import DynamicQuoteFields from "@/Components/Organisms/DynamicQuoteFields.vue";
import InvoiceOptionGroupFields from "@/Components/Molecules/InvoiceOptionGroupFields.vue";
import { reactive } from "vue";

const user = usePage().props.auth.user;
const invoiceData = reactive([
  {
    designation: [
      {
        placeholder: "Description prestation",
        value: "Prestation de service de déménagement solde",
      },
    ],
    quantity: "0",
    unitPrice: "0.00",
    totalPrice: "0.00",
  },
]);

const activatedFields = {
  designation: true,
  quantity: true,
  unitPrice: true,
  totalPrice: true,
};

const addRow = () => {
  console.log("addRow");
  invoiceData.push({
    designation: [
      {
        placeholder: "Description prestation",
        value: "",
      },
    ],
    quantity: "0",
    unitPrice: "0.00",
    totalPrice: "0.00",
  });
  console.log(invoiceData);
};
</script>