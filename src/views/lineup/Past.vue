<template>
  <div class="lineup-past">
    <div class="content" v-html="app.lineup.past" />
  </div>
</template>

<script>
export default {
  name: 'PastLineUps',
  created() {
    this.setPageTitle('Past Line-Up')
  }
}
</script>
