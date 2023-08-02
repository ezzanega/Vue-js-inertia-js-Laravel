<template>
  <Head title="Agenda" />
  <DemLayout>
    <main class="relative flex-1 focus:outline-none overflow-y-auto" id="main">
      <iframe class="full-screen-iframe" :src="taskproUrl">
        <p>Your browser does not support iframes.</p>
      </iframe>
    </main>
  </DemLayout>
</template>
            
    <script setup>
import DemLayout from "@/Layouts/DemLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
const user = usePage().props.auth.user;
const organization = usePage().props.auth.organization;
const taskproUrl = `http://ec2-15-237-84-62.eu-west-3.compute.amazonaws.com:5000/project/${organization.taskpro_organization_id}/calendar?token=${user.taskpro_token}`;
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
