<template>
  <Head title="Templates de mail" />
  <DemLayout>
    <div class="mb-4 text-sm text-gray-600">
      <MailTemplatesList v-if="templates" :templates="templates" />
      <ListEmptyMessage
        v-else
        message-title="Ajouter des modèles de mail"
        message-content="Commencez par ajouter des modèles de mail à envoyer plus tard"
      >
        <IconButton
          @click="openCreateMailTemplateModal"
          class="mt-6"
          text="Ajouter un modèle de mail"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2.2"
            stroke="currentColor"
            aria-hidden="true"
            class="pointer-events-none shrink-0 w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 4.5v15m7.5-7.5h-15"
            />
          </svg>
        </IconButton>

        <CreateMailTemplateModal
          :openModal="inviteUserModal"
          @closeModal="closeModal"
        />
      </ListEmptyMessage>
    </div>
  </DemLayout>
</template>
    
<script setup>
import DemLayout from "@/Layouts/DemLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import ListEmptyMessage from "@/Components/Organisms/ListEmptyMessage.vue";
import MailTemplatesList from "@/Components/Templates/MailTemplatesList.vue";
import IconButton from "@/Components/Atoms/IconButton.vue";
import CreateMailTemplateModal from "@/Components/Templates/CreateMailTemplateModal.vue";
import { ref } from "vue";

router.reload({ only: ["templates"] });

defineProps({
  templates: Array,
});

const inviteUserModal = ref(false);

const openCreateMailTemplateModal = () => {
  inviteUserModal.value = true;
};

const closeModal = () => {
  inviteUserModal.value = false;
};
</script>