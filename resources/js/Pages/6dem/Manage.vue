<template>
  <Head title="Gestion de l'équipe" />
  <DemLayout>
    <TeamMembersList :teamMembres="teamMembres" />
    <!-- <ListEmptyMessage
      message-title="Inviter vos collaborateurs"
      message-content="Commencez par ajouter un nouveau collaborateur"
    >
      <IconButton
        @click="openInviteUserModal"
        class="mt-6"
        text="Inviter un collaborateur"
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

      <InviteUserForm
        :roles="roles"
        :openModal="inviteUserModal"
        @closeModal="closeModal"
      />
    </ListEmptyMessage> -->
  </DemLayout>
</template>

<script setup>
import { ref } from "vue";
import { usePage, Head, router } from "@inertiajs/vue3";
import DemLayout from "@/Layouts/DemLayout.vue";
import ListEmptyMessage from "@/Components/Organisms/ListEmptyMessage.vue";
import IconButton from "@/Components/Atoms/IconButton.vue";
import InviteUserForm from "@/Components/Organisms/InviteUserForm.vue";
import TeamMembersList from "@/Components/Organisms/TeamMembersList.vue";

router.reload({ only: ["teamMembres"] });

const props = defineProps({
  roles: Array,
  permissions: Array,
  teamMembres: Array,
});

const inviteUserModal = ref(false);

const openInviteUserModal = () => {
  inviteUserModal.value = true;
};

const closeModal = () => {
  inviteUserModal.value = false;
};
</script>