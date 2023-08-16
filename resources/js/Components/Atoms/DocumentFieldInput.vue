<template>
  <div class="col-span-12 h-full">
    <div class="flex" :class="classText">
      <span
        contenteditable="true"
        class="editable prevent-line-break"
        :class="[fontBold ? 'font-bold' : '']"
        :placeholder="placeholder"
        @input="handleInput"
        @focusout="$emit('savingValue')"
        ref="editableSpan"
      >
        {{ value }}
      </span>
    </div>
  </div>
</template>
    
<script setup>
import { ref, nextTick, onMounted, watch } from "vue";
const emit = defineEmits(["update:modelValue","savingValue"]);
const props = defineProps({
  value: {
    type: String,
    required: true,
  },

  className: {
    type: String
  },

  name: {
    type: String,
    default: "",
  },

  type: {
    type: String,
    default: "text",
  },

  required: {
    type: Boolean,
    default: false,
  },

  disabled: {
    type: Boolean,
    default: false,
  },

  label: {
    type: String,
    default: "",
  },

  placeholder: {
    type: String,
    default: "",
  },

  fontBold: {
    type: Boolean,
    default: false,
  },
});

const classText = ref(props.className);
// const inputValue = ref(props.modelValue);
const editableSpan = ref(null);

// watch(inputValue, (newValue) => {
//   emit("update:modelValue", newValue);
// });

const handleInput = () => {
  emit("update:modelValue", editableSpan.value.innerText);
};
</script>
  
  <style scoped>
[contenteditable="true"]:empty {
  color: #bbb;
}
.editable {
  display: inline-block;
  padding: 3px 2px;
  outline: none;
  cursor: text;
  background-color: #edf3f1;
}

[contenteditable="true"]:empty:before {
  content: attr(placeholder);
}
.editable.prevent-line-break br {
    display: none
}
</style>
  