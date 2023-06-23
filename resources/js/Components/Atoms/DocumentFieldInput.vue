<template>
  <div class="col-span-12">
    <div class="flex">
      <span
        contenteditable="true"
        class="editable"
        :class="[fontBold ? 'font-bold' : '']"
        :placeholder="placeholder"
        @input="handleInput"
        ref="editableSpan"
      >
        {{ inputValue }}
      </span>
    </div>
  </div>
</template>
    
  <script setup>
import { ref, nextTick, onMounted, watch } from "vue";
const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
  modelValue: {
    type: String,
    required: true,
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

const inputValue = ref(props.modelValue);
const editableSpan = ref(null);

watch(inputValue, (newValue) => {
  console.log(inputValue.value);
  emit("update:modelValue", newValue);
});

const handleInput = () => {
  inputValue.value = editableSpan.value.innerText;
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
  white-space: nowrap;
  overflow: hidden;
}

[contenteditable="true"]:empty:before {
  content: attr(placeholder);
}
</style>
  