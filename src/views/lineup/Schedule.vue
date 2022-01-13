<template>
  <div class="lineup-schedule">
    <div class="content" v-html="app.lineup.schedule" />
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
