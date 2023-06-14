<template>
    <div>
       <color-picker v-model:pureColor="pureColor" v-model:gradientColor="gradientColor"/>
    </div>
  </template>
  
  <script setup lang="ts">
    import { ref } from "vue";
    import tinycolor from "tinycolor2";
  
    const color = tinycolor("#438A7A");
    const pureColor = ref(color);
    const gradientColor = ref("linear-gradient(0deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 1) 100%)");
  </script>