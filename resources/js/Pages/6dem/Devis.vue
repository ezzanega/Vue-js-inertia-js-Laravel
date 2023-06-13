<template>
    <Head title="Nouveau Devis" />
    <DemLayout>
        <SettingsBar />
    </DemLayout>
</template>
    
<script setup>
import DemLayout from '@/Layouts/DemLayout.vue';
import { Head } from '@inertiajs/vue3';
import SettingsBar from '@/Components/Organisms/SettingsBar.vue';
import SelectClientModal from '@/Components/Organisms/SelectClientModal.vue';
import { ref } from 'vue';

</script>