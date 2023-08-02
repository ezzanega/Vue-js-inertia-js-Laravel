<template>
    <Modal :show="openModal" @close="closeModal">
      <div class="flex min-h-0 flex-1 flex-col py-6 overflow-y-scroll">
        <div class="px-4 sm:px-6">
          <div class="flex items-start justify-between">
            <div class="space-y-1">
              <h2
                id="headlessui-dialog-title-15"
                data-headlessui-state="open"
                class="text-lg font-medium"
              >
                Modifier un modèle de mail
              </h2>
              <span class="text-sm">
                Nous avons intégré cette fonctionnalité qui vous permet d'ajouter
                des modèles d'emails personnalisables à votre compte, afin que
                vous puissiez les utiliser à tout moment pour assurer la cohérence
                de vos communications
              </span>
            </div>
            <div class="ml-3 flex h-7 items-center">
              <button
                type="button"
                class="rounded-md bg-white text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-primary-500"
                tabindex="0"
                @click="closeModal"
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
          <div class="w-full py-3 flex flex-col space-y-2">
            <div class="my-1 space-y-2">
              <DefaultInput
                :required="true"
                type="Objet du mail"
                name="subject"
                v-model="form.subject"
                :error="form.errors.subject"
                label="Objet du mail"
                placeholder="Objet du mail"
              />

              <TextArea
                :required="true"
                type="Contenu du mail"
                name="body"
                v-model="form.body"
                :error="form.errors.body"
                label="Contenu du mail"
                placeholder="Contenu du mail"
              />
            </div>
                Bonjour Modal
            <div class="mt-6 flex justify-end space-x-4">
              <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>
              <DefaultButton type="submit" class="w-32" buttontext="Créer" />
            </div>
          </div>
        </form>
      </div>
    </Modal>
</template>

<script setup>

  import Modal from "@/Components/Modal.vue";
  import SecondaryButton from "@/Components/SecondaryButton.vue";
  import { useForm } from "@inertiajs/vue3";
  import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
  import TextArea from "@/Components/Atoms/TextArea.vue";
  import DefaultButton from "@/Components/Atoms/DefaultButton.vue";

  const props = defineProps({
    openModal: Boolean,
  });
  
  const emit = defineEmits(["closeModal"]);

  const closeModal = () => {
    form.reset();
    emit("closeModal");
  };
</script>

