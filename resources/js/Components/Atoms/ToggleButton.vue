<template>
    <div>
        <input 
            type="checkbox" 
            v-model="proxyChecked"
            :value="value" 
            id="hs-basic-usage" 
            class="relative w-[3.25rem] h-7 bg-gray-100 checked:bg-none checked:bg-primary 
            rounded-full cursor-pointer transition-colors ease-in-out duration-200 
            border border-transparent ring-1 ring-transparent focus:border-primary focus:ring-0
            ring-offset-white focus:outline-none appearance-none
            before:inline-block before:w-6 before:h-6 before:bg-white 
            checked:before:bg-white before:translate-x-0 checked:before:translate-x-full before:shadow 
            before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200">
        <label for="hs-basic-usage" class="ml-2 text-xs">{{ label }}</label>
    </div>
</template>

<script setup>

import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    label: {
        required: true,
    },
    value: {
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>