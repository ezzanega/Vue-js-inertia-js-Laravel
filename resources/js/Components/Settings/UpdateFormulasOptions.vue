<template>
    <Modal :show="isUpModalopen">
      <div class="flex min-h-0 flex-1 flex-col py-6 overflow-y-scroll">
        <div class="px-4 sm:px-6">
          <div class="flex items-start justify-between">
            <div class="space-y-1">
              <h2
                id="headlessui-dialog-title-15"
                data-headlessui-state="open"
                class="text-lg font-medium"
              >
                Modifier le Formulas Options
              </h2>
              <span class="text-sm">
                <!-- Un mail contenant un lien d'invitation sera envoyé à l'utilisateur
                pour qu'il crée un compte. Le lien sera valable pendant 3 jours et
                sera invalidé après la création du compte. -->
              </span>
            </div>
            <div class="ml-3 flex h-7 items-center">
              <button
                type="button"
                class="rounded-md bg-white text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-primary-500"
                tabindex="0"
                @click="closeUpModal"
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
            <form>
                <div class="px-4 sm:px-6">
                    <div class="w-full py-3 flex flex-col space-y-2">
                        <div class="my-6 space-y-5">
                            <DefaultSelectInput
                                name="type"
                                label="Type"
                                :options="FormulasOption"
                                v-model="form.type"
                                :error="form.errors.type"
                            />
                            <DefaultInput
                                :required="true"
                                type="text"
                                name="text"
                                v-model="form.text"
                                :error="form.errors.text"
                                label="Text de formulas options"
                                placeholder="entrez l'option"
                            />

                        </div>

                        <div class="mt-6 flex justify-end space-x-4">
                        <SecondaryButton @click="closeUpModal"> Annuler </SecondaryButton>
                        <DefaultButton @click="updateFormulasOption(OptionData.id)" class="w-32" buttontext="Modifier" />
                        </div>
                    </div>
                </div>
            </form>
      </div>
    </Modal>

</template>
<script setup>
    import Modal from "@/Components/Modal.vue";
    import SecondaryButton from "@/Components/SecondaryButton.vue";
    import { useForm, usePage } from "@inertiajs/vue3";
    import { ref, onMounted } from "vue";
    import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
    import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
    import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";

const props = defineProps({
  isUpModalopen: Boolean,
  openUpModal:Function,
  OptionData: Object,
});

const FormulasOption = [
    { name: "À notre charge", value: "organization-side" },
    { name: "À la charge du client", value: "client-side" }
  ];

const emit = defineEmits(["closeUpModal"]);

    const form = useForm({
        type:props.OptionData.type,
        text: props.OptionData.text,
    });
    const updateFormulasOption = (id) => {
        form.put(route("6dem.formula.option.update", {id: id}),
        {
            preserveScroll: true,
            onSuccess: () => closeUpModal(),
        });
    };

    const closeUpModal = () => {
        form.reset();
        emit("closeUpModal");
    };



</script>
