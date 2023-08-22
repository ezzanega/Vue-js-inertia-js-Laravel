<template>
    <Modal :show="isModal_dup_quot_Open" >
        <div  v-if="formulas" class="flex min-h-0 flex-1 flex-col py-6 overflow-y-scroll">
          <div class="px-4 sm:px-6">
            <div class="flex items-start justify-between">
              <div class="space-y-1">
                <h2
                  id="headlessui-dialog-title-15"
                  data-headlessui-state="open"
                  class="text-lg font-medium"
                >
                  Dupliquer dans une autre formule
                </h2>
                <span class="text-sm">
                    dupliquer dans une autre formule
                </span>
              </div>
              <div class="ml-3 flex h-7 items-center">
                <button
                  type="button"
                  class="rounded-md bg-white text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-primary-500"
                  tabindex="0"
                  @click="closeDupQuotModal()"
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

          <!-- <form > -->
            <div class="px-4 sm:px-6">
                <div class="w-full py-3 flex flex-col space-y-2">
                    <div class="my-6 space-y-5">
                        <DefaultSelectInput
                            v-model="selectedFormule"
                            name="formule"
                            label="Formule"
                            :options="FormuleOptions"
                        />
                    </div>
                    <div class="space-x-2 xl:flex">
                        <div class="w-auto xl:w-1/2">
                          <p v-if="organizationSideOptions.length>0" class="text-sm font-normal text-gray-500">
                            <u> À notre charge</u>
                           </p>
                          <ul class="my-4 space-y-3">
                            <li v-for="(option, index) in organizationSideOptions" :key="index">
                              <a
                                href="#"
                                class="flex items-center p-3 text-sm font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow"
                              >
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="currentColor"
                                  class="w-6 h-6"
                                >
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                  />
                                </svg>

                                <span class="flex-1 ml-3">{{ option.text }}
                                  <input type="hidden" :value="option.id">
                                </span>
                              </a>
                            </li>
                          </ul>
                        </div>

                        <div class="w-auto xl:w-1/2">
                          <p  v-if="clientSideOptions.length>0" class="text-sm font-normal text-gray-500">
                            <u> À la charge du client</u>
                          </p>
                          <ul class="my-4 space-y-3">
                            <li v-for="(option, index) in clientSideOptions" :key="index">
                              <a
                                href="#"
                                class="flex items-center p-3 text-sm font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow"
                              >
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="currentColor"
                                  class="w-6 h-6"
                                >
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                  />
                                </svg>

                                <span class="flex-1 ml-3">{{ option.text }}
                                  <input type="hidden" :value="option.id">
                                </span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    <p class="text-sm text-center text-gray-500">
                        Pour modifier les formules de déménagement, rendez-vous dans la section <span class="text-primary font-bold">Réglages.</span>
                    </p>

                    <div class="mt-6 flex justify-end space-x-4">
                    <SecondaryButton @click="closeDupQuotModal"> Annuler </SecondaryButton>
                    <DefaultButton @click="DupQuotation(selectedFormule)" class="w-32" buttontext="Dupliquer" />
                    </div>
                </div>
            </div>
        <!-- </form> -->

        </div>
    </Modal>
</template>


<script setup>
    import Modal from "@/Components/Modal.vue";
    import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";
    import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
    import SecondaryButton from "@/Components/SecondaryButton.vue";
    import { useForm,usePage } from "@inertiajs/vue3";
    import { ref,onMounted,watch} from "vue";
    import { options } from "floating-vue";
    import { router } from "@inertiajs/vue3";

    const props = defineProps({
        isModal_dup_quot_Open : Boolean,
        selectedvalue:Number,
    });
    const emit = defineEmits(["closeDupQuotModal"]);
    //Displaying List Of Formules
    const page = usePage();
    const formulas = page.props.movingJobFormulas;
    const FormuleOptions = ref([]);
    const selectedFormule = ref(null);


    onMounted(() => {
        page.props.movingJobFormulas.forEach((formule) => {
            FormuleOptions.value.push({
                name: formule.name,
                value: formule.id,
            });
        });

        console.log('Formule Options:', FormuleOptions.value);
    });

    const getOptionByType = (options, type) => {
        return options.filter((obj) => {
        return obj.type === type;
        });
    };
    const organizationSideOptions = ref([]);
    const clientSideOptions = ref([]);
    watch(selectedFormule, (newSelectedFormule) => {
        const selectedFormula = formulas.find(formula => formula.id === parseInt(newSelectedFormule));
        
        if (selectedFormula) {
            const selectedOptions = selectedFormula.options.filter(option => option.moving_job_formula_id === parseInt(newSelectedFormule));
            organizationSideOptions.value = getOptionByType(selectedOptions, 'organization-side');

            clientSideOptions.value = getOptionByType(selectedOptions, 'client-side');;

        } else {
            organizationSideOptions.value = [];
            clientSideOptions.value = [];
        }
    });

    const DupQuotation = (selectedFormule) => {
      const selectedvalue = props.selectedvalue;
      const routeParams = {
        id: selectedvalue,
        id_formule: selectedFormule,
      };
      console.log('selectedvalue   '+selectedvalue)
      router.visit(route("6dem.documents.quotation.duplicate", routeParams), {
        method: "get",
      });
    };


    const closeDupQuotModal = () => {
        emit("closeDupQuotModal");
    };


</script>
