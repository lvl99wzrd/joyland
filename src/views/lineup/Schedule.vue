<template>
  <div class="lineup-schedule">
    <div class="lineup-schedule__poster" />
  </div>
</template>

<script>
export default {
  name: 'Schedule',
  created() {
    this.setPageTitle('Schedule')
  }
}
</script>

<style lang="scss" scoped>
.lineup-schedule {
  &__poster {
    @apply bg-gray-400 w-full h-0;
    padding-top: 125%;
  }
}
</style>
