<template>
  <Head title="Agenda" />
  <DemLayout>
    <Calendar />
  </DemLayout>
</template>
            
<script setup>
import DemLayout from "@/Layouts/DemLayout.vue";
import Calendar from "@/Components/Calendar/Calendar.vue";
import { Head, usePage } from "@inertiajs/vue3";
const user = usePage().props.auth.user;
const organization = usePage().props.auth.organization;
const taskproUrl = `https://taskpro.sysdem.fr/project/${organization.taskpro_organization_id}/calendar?token=${user.taskpro_token}`;
</script>

<style scoped>
#main {
  height: 100%;
  margin: 0;
  padding: 0;
  overflow: hidden; /* optional to hide scrollbars */
}
.full-screen-iframe {
  height: 100vh;
  width: 100%;
  border: none; /* optional to hide the iframe border */
}
</style>
