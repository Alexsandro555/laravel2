<template>
  <div class="VueCarousel-slide">
    <slot></slot>
  </div>
</template>

<script>
  export default {
    name: "alex-slide",
    data() {
      return {
        width: null,
      }
    }
  }
</script>

<style>
  .VueCarousel-slide {
    flex-basis: inherit;
    flex-grow: 0;
    flex-shrink: 0;
    align-items: center;
    justify-content: center;
    user-select: none;
  }
</style>
