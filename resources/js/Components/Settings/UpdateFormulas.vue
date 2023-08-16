<template>
    <div class="mt-10 sm:mt-0">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <h3 class="text-lg font-medium leading-6 text-neutral-900">
            Formules de déménagement
            <button class="bg-primary hover:bg-green-700 text-white text-sm py-1 px-3 rounded shadow">
                New
            </button>
          </h3>
          <p class="mt-1 text-sm text-neutral-600">
            Paramètrage des formules de déménagement pour les particuliers.
          </p>
        </div>
        <div v-if="usePage().props.formulas.length" class="mt-5 md:col-span-2 md:mt-0 flex flex-col space-y-3">
          <div
            v-for="(formula, index) in usePage().props.formulas"
            :key="index"
            class="p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6"
          >
            <div v-if="show_input_formulas === index">
                <div>
                    <input
                      type="text"
                      name="title_formula"
                      autofocus
                      class="block bg-gray-40 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-700 focus:border-green-700 block p-2 "
                      required
                      @blur="onInputBlur(index),updateFormulas(formula.id)"
                      v-model="formFormulas.title_formula"
                      @input="generateSlug"
                    />
                    <p class=" ml-2 mb-3  text-sm text-gray-500 dark:text-gray-400">Slug :
                        <input type="label" class="mt-1 text-sm text-gray-500 dark:text-gray-400" name="slug_formula" v-model="formFormulas.slug_formula" readonly />
                    </p>
                </div>
            </div>
            <h5 v-else class="flex justify-between items-center mb-3 text-base font-semibold text-gray-900 md:text-xl">
                <div>
                  {{ formula.name }}
                  <button @click="toggleInputFormulasField(index)">
                    <svg class="h-4 w-5 ml-1 text-gray-300 hover:text-green-700 transition-colors duration-200"
                      fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                  </button>
                </div>
                <button>
                  <svg class="h-6 w-6 text-black hover:text-red-700"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                  </svg>
                </button>
              </h5>

            <div class="space-x-2 xl:flex">
              <div class="w-auto xl:w-1/2">
                <p class="text-sm font-normal text-gray-500">À notre charge</p>
                <ul class="my-4 space-y-3">
                  <li
                    v-for="(option, index) in getOptionByType(
                      formula.options,
                      'organization-side'
                    )"
                    :key="index"
                  >
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
                      <div class="flex justify-end gap-4">
                        <Dropdown placement="bottom-end">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-6 w-6 cursor-pointer"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"
                            />
                          </svg>
                          <template #popper>
                            <OptionsPopperContent :openUpModal="openUpModal"  :OptionData="option"
                            :deleteOption="deleteOption" :opendelModal="opendelModal" />
                          </template>
                        </Dropdown>
                      </div>
                    </a>
                  </li>
                </ul>
                <input type="hidden" :value="formula.id">
                <DynamicOptionFields :id_formulas="formula.id" :type_formulas="'organization-side'"/>
              </div>
              <div class="w-auto xl:w-1/2">
                <p class="text-sm font-normal text-gray-500">
                  À la charge du client
                </p>
                <ul class="my-4 space-y-3">
                  <li
                    v-for="(option, index) in getOptionByType(
                      formula.options,
                      'client-side'
                    )"
                    :key="index"
                  >
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
                      <div class="flex justify-end gap-4">
                        <Dropdown placement="bottom-end">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-6 w-6 cursor-pointer"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"
                            />
                          </svg>
                          <template #popper>
                            <OptionsPopperContent
                            :openUpModal="openUpModal" :OptionData="option"
                            :deleteOption="deleteOption" :opendelModal="opendelModal"/>
                          </template>
                        </Dropdown>
                      </div>
                    </a>
                  </li>
                </ul>
                <input type="hidden" :value="formula.id">
                <DynamicOptionFields :id_formulas="formula.id" :type_formulas="'client-side'"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  <script setup>
  import { Dropdown } from "floating-vue";
  import slugify from 'slugify';
  import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
  import OptionsPopperContent from "@/Components/Settings/OptionsPopperContent.vue";
  import DynamicOptionFields from "@/Components/Organisms/DynamicOptionFields.vue";
  import { usePage,useForm } from "@inertiajs/vue3";
  import { ref, watch } from 'vue';


  const props = defineProps({
      openUpModal:Function,
      OptionData: Object,
      deleteOption:Function,
      opendelModal:Function,
  });
   const emit = defineEmits(["deleteOption"]);

  const formulas = usePage().props.formulas;

  const getOptionByType = (options, type) => {
    return options.filter((obj) => {
      return obj.type === type;
    });
  };
  const deleteOption = () => {
      emit("deleteOption");
    };


const show_input_formulas = ref(null);

const formFormulas = useForm({
    title_formula:ref(''),
    slug_formula: ref(''),
    });
// const title_formula = ref('');
// const slug_formula = ref('');

const toggleInputFormulasField = (index) => {
  show_input_formulas.value=index;
  if (index !== null) {
    formFormulas.title_formula = usePage().props.formulas[index].name;
    formFormulas.slug_formula = usePage().props.formulas[index].slug;
    generateSlug();
  }
};

const onInputBlur = (id) => {
  show_input_formulas.value=null;
};

const updateFormulas = (id) => {
        console.log('the id    : ',id);
        console.log("title_formula   : ",formFormulas.title_formula.value);
        console.log("slug_formula   : ",formFormulas.slug_formula.value);
        formFormulas.put(route("6dem.formula.update", {id: id}),
        {
            preserveScroll: true,
            onSuccess: () => {
                console.log('Formulas updated succefully');
                formFormulas.title_formula.value = '';
                formFormulas.slug_formula.value = '';
            },
        });
};

const generateSlug = () => {
    formFormulas.slug_formula = slugify(formFormulas.title_formula, { lower: true });
};

watch(formFormulas.title_formula, generateSlug);
  </script>
