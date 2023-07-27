<template>
  <Head title="Tâches" />
  <DemLayout>
    <main class="relative flex-1 focus:outline-none overflow-y-auto" id="main">
      <iframe
        class="full-screen-iframe"
        src="http://ec2-15-237-84-62.eu-west-3.compute.amazonaws.com:5000/project/64c251728a31c83711ab50fd/board"
      >
        <p>Your browser does not support iframes.</p>
      </iframe>
    </main>
  </DemLayout>
</template>
              
      <script setup>
import DemLayout from "@/Layouts/DemLayout.vue";
import { Head } from "@inertiajs/vue3";
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
  