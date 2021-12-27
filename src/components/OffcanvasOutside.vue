<template>
  <div :class="['offcanvas-outside', { 'offcanvas-shown': offcanvas }]" @click="toggleOffcanvas(false)" />
</template>

<script>
export default {
  name: 'OffcanvasOutside'
}
</script>

<style lang="scss" scoped>
.offcanvas-outside {
  @apply fixed top-0 left-0 bg-black opacity-0 w-full h-full z-50 pointer-events-none;
  transition: all 600ms cubic-bezier(0.770, 0.000, 0.175, 1.000); /* easeInOutQuart */
  transition-timing-function: cubic-bezier(0.770, 0.000, 0.175, 1.000); /* easeInOutQuart */
  
  &.offcanvas-shown {
    @apply opacity-50 pointer-events-auto;
    transform: translateX(13rem);
  }
}
</style>
