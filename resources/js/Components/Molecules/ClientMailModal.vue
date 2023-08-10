<template>
    <Modal :show="isMailOpen" @close="closeMailModal">
      <div class="flex min-h-0 flex-1 flex-col py-6 overflow-y-scroll">
        <div class="px-4 sm:px-6">
          <div class="flex items-start justify-between">
            <div class="space-y-1">
              <h2
                id="headlessui-dialog-title-15"
                data-headlessui-state="open"
                class="text-lg font-medium"
              >
                Envoyer un mail
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
                    label="Selectionnez le mail à envoyer"
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

            <div class="mt-6 flex justify-between space-x-4">
              <button @click="sendMailWithGmail" type="button" class="w-full max-w-2xl font-bold shadow-sm rounded-lg py-2.5 bg-secondary text-gray-800 flex items-center justify-center transition-all duration-300 ease-in-out focus:outline-none hover:shadow focus:shadow-sm focus:shadow-outline"
              >
                <Gmail />
                <span class="ml-2">Evoyer avec Gmail </span>
              </button>
                <button @click="sendMailWithOutlook" type="button" class="w-full max-w-2xl font-bold shadow-sm rounded-lg py-2.5 bg-secondary text-gray-800 flex items-center justify-center transition-all duration-300 ease-in-out focus:outline-none hover:shadow focus:shadow-sm focus:shadow-outline"
              >
                <Outlook />
                <span class="ml-2">Evoyer avec Outlook </span>
              </button>
            </div>
          </div>
        </form>
      </div>
    </Modal>
</template>

<script setup>
  import Modal from "@/Components/Modal.vue";
  import { useForm,usePage } from "@inertiajs/vue3";
  import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";
  import TextArea from "@/Components/Atoms/TextArea.vue";
  import Gmail from "@/Components/Svg/Gmail.vue";
  import Outlook from "@/Components/Svg/Outlook.vue";
  import { ref,onMounted,watch} from "vue";


  const props = defineProps({
    client: Object,
    isMailOpen: Boolean,
  });

  const page = usePage();
  const mailsOptions = ref([]);
  const selectedMail = ref(null);

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
    selectedMail.value = page.props.mails.find(mail => mail.name === newValue.mail);
    if (selectedMail) {
      form.body = selectedMail.value ? replaceMailVariablesToValue(selectedMail.value?.body) : '';
    }
  });

  const closeMailModal = () => {
    form.reset();
    emit("closeMailModal");
  };

  const sendMailWithGmail = () => {
    const url = "https://mail.google.com/mail/u/0/?view=cm&fs=1&tf=1&to=" + props.client.email + "&su="+ encodeURI(selectedMail.value.subject) +"&body=" + encodeURI(form.body);
    window.open(
      url,
      "_blank"
    );
  }

  const sendMailWithOutlook = () => {
    const url = "https://outlook.live.com/owa/?path=/mail/action/compose&to=" + encodeURIComponent(props.client.email) + "&subject=" + encodeURIComponent(selectedMail.value.subject) + "&body=" + encodeURIComponent(form.body);
    window.open(
      url,
      "_blank"
    );
  };


  const replaceMailVariablesToValue = (content) => {
    let newContent = content;
    const replacements = {
      "[PrenomClient]": props.client.first_name,
      "[NomDuClient]": props.client.last_name,
      "[EmailClient]": props.client.email,
      "[AdresseClient]": props.client.address?.address,
    };

    for (let key in replacements) {
      content = content.replaceAll(key, replacements[key]);
    }
    return content;
}


</script>
