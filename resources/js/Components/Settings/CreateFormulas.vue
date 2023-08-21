<template>
    <Modal :show="is_add_formula_Modalopen">
      <div class="flex min-h-0 flex-1 flex-col py-6 overflow-y-scroll">
        <div class="px-4 sm:px-6">
          <div class="flex items-start justify-between">
            <div class="space-y-1">
              <h2
                id="headlessui-dialog-title-15"
                data-headlessui-state="open"
                class="text-lg font-medium"
              >
                Nouvelle  Formule & Option
              </h2>

            </div>
            <div class="ml-3 flex h-7 items-center">
              <button
                type="button"
                class="rounded-md bg-white text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-primary-500"
                tabindex="0"
                @click="closeFormulaModal"
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
                            <div class="flex items-center">
                                <DefaultInput
                                    :required="true"
                                    type="text"
                                    name="title"
                                    label="Titre de Formule"
                                    v-model="form.title"
                                    :error="form.errors.title"
                                    placeholder="Entrez le titre"
                                    class="w-full mr-2"
                                    @input="generateSlug"
                                />
                                <button @click="addOptionRow" class="rounded-full p-0.5 bg-blue-200 text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                            </div>
                            <input type="hidden" class="mt-1 text-sm text-gray-500 dark:text-gray-400" name="slug_formula"
                            v-model="form.slug" readonly />
                        </div>

                        <div v-if="Row" v-for="item,index in form.options" :key="item">
                            <div class="flex items-center space-x-2">
                                <DefaultInput
                                    :required="true"
                                    type="text"
                                    name="option"
                                    placeholder="Entrez une option"
                                    v-model="item.option"

                                    :error="form.errors.options && form.errors.options[index]?.option ? form.errors.options[index]?.option : '' "
                                    class="flex-grow mt-2"
                                />

                                <DefaultSelectInput
                                    name="type"
                                    :options="FormulasOption"
                                    v-model="item.type"
                                    :error="form.errors.options && form.errors.options[index]?.type ? form.errors.options[index]?.type : '' "
                                    class="w-1/3"
                                />

                                <button @click="removeOptionRow(index)" class="rounded-full p-0.5 bg-red-200 text-red-500 hover:text-red-700">
                                    <svg class="h-6 w-6 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>

                                </button>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-4">
                        <SecondaryButton @click="closeFormulaModal"> Annuler </SecondaryButton>
                        <DefaultButton class="w-32" buttontext="Enregistrer" @click="SaveFormula" />
                        </div>
                    </div>
            </div>
      </div>
    </Modal>

</template>
<script setup>
    import Modal from "@/Components/Modal.vue";
    import SecondaryButton from "@/Components/SecondaryButton.vue";
    import { useForm, usePage } from "@inertiajs/vue3";
    import { ref,reactive, onMounted,watch } from "vue";
    import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
    import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
    import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";
   import slugify from 'slugify';



const props = defineProps({
  is_add_formula_Modalopen: Boolean,
  openFormulaModal:Function,
  closeFormulaModal:Function,
});

const FormulasOption = [
    { name: "À notre charge", value: "organization-side" },
    { name: "À la charge du client", value: "client-side" }
  ];

const Row=ref(false);

const form = useForm({
  title: '',
  slug: '',
  options: []
}, {
  rules: {
    title: 'required|min:3',
  },
  options: {
    '*': {
      option: 'required|min:3',
      type: 'required'
    }
  }
});

const addOptionRow = () => {
    Row.value = true;
    if (form.options.length < 3) {
        form.options.push({ option: '', type: '' });
    }
};

// Remove an option row by index
const removeOptionRow = (index) => {
    form.options.splice(index, 1);
    form.errors.options = [];
};
const SaveFormula = () => {
    const optionsData = form.options.map(option => {
        return {
            option: option.option,
            type: option.type
        };
    });
    const formulaData = {
        title: form.title,
        slug:form.slug,
        options: optionsData
    };

    if (!form.title) {
        form.errors.title = 'Veuillez remplir ce champ, il est obligatoire.';
        return;
    }
      // Initialize options errors
  form.errors.options = [];

  for (let i = 0; i < form.options.length; i++) {
    const option = form.options[i];
    if (!option.option || !option.type) {
      form.errors.options[i] = {
        option: !option.option ? 'Veuillez remplir ce champ, il est obligatoire.' : '',
        type: !option.type ? 'Veuillez sélectionner un type.' : ''
      };
      return;
    }
  }
    console.log(formulaData);
    try {
        const response = form.post(route("6dem.formula.create"), formulaData, {
            preserveScroll: true
        });
        //console.log('Formula saved successfully:', response.data);
        props.closeFormulaModal();
    } catch (error) {
        // Handle the error response
        console.error('Error saving formula:', error);
    }
};

const generateSlug = () => {
    form.slug = slugify(form.title, { lower: true });
};

watch(form.title, generateSlug);

</script>
