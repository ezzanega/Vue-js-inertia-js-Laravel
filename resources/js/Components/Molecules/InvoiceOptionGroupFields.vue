<template>
  <tr class="border-b border-slate-200">
    <td
      v-if="activatedFields.designation"
      class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0"
    >
      <div
        v-for="(designation, index) in fieldsValues.designation"
        :key="index"
        class="font-medium text-primary space-y-1"
      >
        <DocumentFieldInput :modelValue="designation" />
        <DynamicHeaderFields class="flex mx-auto justify-center text-sm" />
      </div>
    </td>
    <td
      v-if="activatedFields.quantity"
      class="table-cell px-3 py-4 text-sm text-slate-500"
    >
      <DocumentFieldInput
        class="flex justify-end"
        :modelValue="fieldsValues.quantity"
      />
    </td>
    <td
      v-if="activatedFields.unitPrice"
      class="table-cell px-3 py-4 text-sm text-slate-500"
    >
      <DocumentFieldInput
        class="flex justify-end"
        :modelValue="fieldsValues.unitPrice"
      />
    </td>
    <td
      v-if="activatedFields.totalPrice"
      class="table-cell px-3 py-4 text-sm text-slate-500"
    >
      <DocumentFieldInput
        class="flex justify-end"
        :modelValue="fieldsValues.totalPrice"
      />
    </td>
  </tr>
</template>

<script setup>
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";
import DynamicHeaderFields from "@/Components/Organisms/DynamicHeaderFields.vue";

const props = defineProps({
  activatedFields: {
    designation: Boolean,
    quantity: Boolean,
    unitPrice: Boolean,
    totalPrice: Boolean,
  },
  fieldsValues: {
    designation: Array < String > [],
    quantity: String,
    unitPrice: String,
    totalPrice: String,
  },
});
</script>