<template >
  <Head title="Réglages" />
  <DemLayout>
    <main class="relative flex-1 focus:outline-none overflow-y-auto" id="main" >
      <div class="py-6">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
          <div class="sm:py-4">
            <div class="">
              <div class="m-auto max-w-7xl">
                <UpdateSettingsFrom />

                <div class="hidden sm:block" aria-hidden="true">
                  <div class="py-5">
                    <div class="border-t border-neutral-200"></div>
                  </div>
                </div>

                <UpdateInsurances />

                <div class="hidden sm:block" aria-hidden="true">
                  <div class="py-5">
                    <div class="border-t border-neutral-200"></div>
                  </div>
                </div>

                <UpdateExecutingCompanies />

                <div class="hidden sm:block" aria-hidden="true">
                  <div class="py-5">
                    <div class="border-t border-neutral-200"></div>
                  </div>
                </div>


                <UpdateFormulas :openUpModal="openUpModal" :OptionData="selectedOption" @closeUpModal="closeUpModal"
                :deleteOption="deleteOption" :deleteFormula="deleteFormula" :opendelModal="opendelModal"
                :openFormulaModal="openFormulaModal"
                />

                <!-- Pour la creation de formula -->
                <CreateFormulas v-if="is_add_formula_Modalopen" :is_add_formula_Modalopen="is_add_formula_Modalopen"  :closeFormulaModal="closeFormulaModal"/>

                <!-- Pour la modification -->
                <UpdateFormulasOptions v-if="isUpModalopen && selectedOption" :isUpModalopen="isUpModalopen" :OptionData="selectedOption" @closeUpModal="closeUpModal"/>

                <!-- Pour la suppression -->
                <DeleteFormModal :isModaldelOpen="isModaldelOpen"
                @closedelModal="closedelModal()"
                @deleteFunction="Deletedtype === 'option' ?
                deleteOption(selectedOption) : deleteFormula(selectedOption)"
                />
                <!-- <DeleteFormModal  v-if="Deletedtype === 'formula'" :isModaldelOpen="isModaldelOpen"
                @closedelModal="closedelModal()"
                @deleteFunction="deleteFormula(selectedOption)"
                />
                <DeleteFormModal v-if="Deletedtype === 'option'" :isModaldelOpen="isModaldelOpen"
                @closedelModal="closedelModal()"
                @deleteFunction="deleteOption(selectedOption)"
                /> -->

                <div class="hidden sm:block" aria-hidden="true">
                  <div class="py-5">
                    <div class="border-t border-neutral-200"></div>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </DemLayout>
</template>

<script setup>
import DeleteFormModal from "@/Components/Atoms/DeleteFormModal.vue";
import DemLayout from "@/Layouts/DemLayout.vue";
import { Head, usePage, router } from "@inertiajs/vue3";
import { ref } from "vue";
import UpdateSettingsFrom from "@/Components/Settings/UpdateSettingsFrom.vue";
import UpdateFormulas from "@/Components/Settings/UpdateFormulas.vue";
import CreateFormulas from "@/Components/Settings/CreateFormulas.vue";
CreateFormulas
import UpdateInsurances from "@/Components/Settings/UpdateInsurances.vue";
import UpdateFormulasOptions from "@/Components/Settings/UpdateFormulasOptions.vue";
import UpdateExecutingCompanies from "@/Components/Settings/UpdateExecutingCompanies.vue";


 const props=defineProps({
    formulas: Object,
 })


//début Open  et Close
const isUpModalopen = ref(false);
const selectedOption = ref(null);

const openUpModal = (option) => {
  isUpModalopen.value = true;
  selectedOption.value = option;

};

const closeUpModal = () => {
    isUpModalopen.value = false;
};
//fin Open  et Close

//début Open  et Close
const is_add_formula_Modalopen = ref(false);

const openFormulaModal = (option) => {
  is_add_formula_Modalopen.value = true;

};

const closeFormulaModal = () => {
    is_add_formula_Modalopen.value = false;
};
//fin Open  et Close




//delete formula
function deleteFormula(id) {
    router.delete(`/6dem/formula/delete/${id}`, {
        onBefore: () => opendelModal(),
        onSuccess:() => closedelModal()
    });
}
//début Open  et Close de formulaire de suppression Option
function deleteOption(id) {
    router.delete(`/6dem/formula/option/delete/${id}`, {
        onBefore: () => opendelModal(),
        onSuccess:() => closedelModal()
    });
}
//début Open et Close Pop-up
const isModaldelOpen=ref(false);
const Deletedtype = ref(null);

const opendelModal = (id,deleted) => {
    isModaldelOpen.value = true;
    selectedOption.value = id;
    Deletedtype.value = deleted;
};

const closedelModal = () => {
    isModaldelOpen.value = false;
};
//fin Open et Close Pop-up
</script>
