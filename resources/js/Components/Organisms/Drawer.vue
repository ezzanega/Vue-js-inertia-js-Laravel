<template>
  <div>
    <div
      class="drawer"
      :class="{ 'is-open': isOpen, 'is-visible': isVisible }"
    >
      <div
        class="drawer__overlay"
        :style="{ transitionDuration: `${speed}ms` }"
      />
      <div
        v-click-away="closeDrawer"
        class="drawer__content"
        :style="{
          maxWidth: maxWidth,
          transitionDuration: `${speed}ms`,
          backgroundColor: backgroundColor,
        }"
      >
        <slot />
      </div>
    </div>
  </div>
</template>
  
<script setup>
    import { onMounted, watch, ref } from 'vue';

    const props =  defineProps({
        isOpen: {
            type: Boolean,
            required: false,
            default: false,
        },

        maxWidth: {
            type: String,
            required: false,
            default: "400px",
        },

        speed: {
            type: Number,
            required: false,
            default: 300,
        },

        backgroundColor: {
            type: String,
            required: false,
            default: "#fafafa",
        },

    });

    let isVisible = ref(false)
    let isTransitioning = ref(false)

    onMounted(() => isVisible.value  = props.isOpen);

    const emit = defineEmits(['close']);

    watch(
        () => props.isOpen,
        (val) => {
            isTransitioning.value = true
            if (val) {
            toggleBackgroundScrolling(true);
            isVisible.value = true;
            } else {
            toggleBackgroundScrolling(false);
            setTimeout(() => (isVisible.value = false), props.speed);
            }
    
            setTimeout(() => (isTransitioning.value = false), props.speed);
        },
    );


    const closeDrawer = () => {
        console.log("closeDrawer");
        if (!isTransitioning.value) {
            emit('close');
        }
    };

    const toggleBackgroundScrolling = (enable) => {
        const body = document.querySelector("body");
        body.style.overflow = enable ? "hidden" : null;
    };
</script>
  
<style scoped>
.drawer {
    visibility: hidden;
}
.drawer.is-visible {
    visibility: visible;
}
.drawer.is-open .drawer__overlay {
    opacity: 0.5;
}
.drawer.is-open .drawer__content {
    transform: translateX(0);
}
.drawer__overlay {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    z-index: 200;
    opacity: 0;
    transition-property: opacity;
    background-color: #000;
    user-select: none;
}
.drawer__content {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    height: 100%;
    width: 100%;
    z-index: 9999;
    overflow: auto;
    transition-property: transform;
    display: flex;
    flex-direction: column;
    transform: translateX(100%);
    box-shadow: 0 2px 6px #777;
}
 
</style>