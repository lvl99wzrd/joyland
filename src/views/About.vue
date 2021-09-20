<template>
  <div id="about">
    <div v-if="about" class="container py-16">
      <div class="content max-w-xl mx-auto" v-html="about.content" />
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'About',
  data() {
    return {
      loading: false,
      about: false
    }
  },
  created() {
    this.getAbout()
  },
  methods: {
    getAbout() {
      this.loading = true
      axios({
        method: 'get',
        url: `${this.app.rest.theme}/about-page`,
      })
        .then((response) => {
          this.about = response.data
        })
        .catch((error) => {
          console.log(error.response)
        })
        .finally(() => {
          this.loading = false
        })
    }
  }
}
</script>

<style lang="scss" scoped>
#about {
  @apply relative bg-orange-light;
  min-height: calc(100vh - 4rem);

  @screen md {
    min-height: calc(100vh - 5rem);
  }
}
</style>
