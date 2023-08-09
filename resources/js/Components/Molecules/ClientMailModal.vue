<template>
    <Modal :show="isMailopen" @close="closeMailModal">
      <div class="flex min-h-0 flex-1 flex-col py-6 overflow-y-scroll">
        <div class="px-4 sm:px-6">
          <div class="flex items-start justify-between">
            <div class="space-y-1">
              <h2
                id="headlessui-dialog-title-15"
                data-headlessui-state="open"
                class="text-lg font-medium"
              >
                Envoyer un modèle de mail
              </h2>
            </div>
            <div class="ml-3 flex h-7 items-center">
              <button
                type="button"
                class="rounded-md bg-white text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-primary-500"
                tabindex="0"
                @click="closeMailModal"
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
        <form class="px-4 sm:px-6">
          <div class="w-full py-3 flex flex-col space-y-2 ">
            <div class="my-1 space-y-2">
                <DefaultSelectInput
                    name="mails"
                    label="Liste des Emails"
                    v-model="form.mail"
                    :options="mailsOptions"
                    :error="form.errors.mails"
                />

                <TextArea
                v-if="form.mail"
                    :required="true"
                    type="Contenu du mail"
                    name="body"
                    v-model="form.body"
                    :error="form.errors.body"
                    label="Contenu du mail"
                    placeholder="Contenu du mail"
                    :value="form.body"
                />
            </div>

            <div class="py-3">
              <div>
                <p class="text-gray-500">
                  Vous avez maintenant la possibilité d'ajouter des variables
                  personnalisées à vos modèles de mail pour rendre vos messages
                  plus personnels et adaptés à chaque destinataire.
                </p>
              </div>
            </div>

            <div class="mt-6 flex justify-end space-x-4">
              <SecondaryButton @click="closeMailModal"> Annuler </SecondaryButton>
              <DefaultButton type="submit" class="w-32" buttontext="Modifier" />
            </div>
          </div>
        </form>
      </div>
    </Modal>
</template>

<script setup>
  import Modal from "@/Components/Modal.vue";
  import SecondaryButton from "@/Components/SecondaryButton.vue";
  import { useForm,usePage } from "@inertiajs/vue3";
  import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
  import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";
  import TextArea from "@/Components/Atoms/TextArea.vue";
  import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
  import { ref,onMounted,watch} from "vue";


  const props = defineProps({
    mails:Array,
    isMailopen: Boolean,
    });

  const page=usePage();
  const mailsOptions = ref([]);

  const emit = defineEmits(["closeMailModal"]);
  onMounted(() => {
    page.props.mails.forEach((mail) => {
    mailsOptions.value.push({
      name: mail.subject,
      value: mail.name,
    });
  });
});

  const form = useForm({
    mail: "",
    body: "",
  });
  watch(form, (newValue) => {
        const selectedMail = page.props.mails.find(mail => mail.name === newValue.mail);
        if (selectedMail) {
            form.body = selectedMail.body;
        }
    });
  const closeMailModal = () => {
    form.reset();
    emit("closeMailModal");
  };

  </script>
