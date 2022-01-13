<template>
  <div class="lineup-full">
    <div class="content" v-html="app.lineup.full" />
    <div class="text-center mt-12">
      <router-link class="font-display font-bold text-2xl uppercase text-orange-light" :to="{ name: 'Past Line-Ups' }">Past Line-Up</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FullLineUps',
  created() {
    this.setPageTitle('Full Line-Up')
  }
}
</script>
