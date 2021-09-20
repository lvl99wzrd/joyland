<template>
  <div id="page">
    <div v-if="!loading" class="page" :style="{ color: page.style.color, backgroundColor: page.style.bg_color }">
      <div class="max-w-xl mx-auto py-16">
        <h1 v-if="!page.hide_title" v-html="page.title" class="page-title" />
        <div class="content" v-html="page.content" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Page',
  data() {
    return {
      loading: false,
      page: false
    }
  },
  watch: {
    '$route': function() {
      this.getPage()
    }
  },
  created() {
    this.getPage()
  },
  methods: {
    getPage() {
      this.loading = true

      this.appAxios({
        method: 'get',
        url: `${this.app.rest.wp}/pages`,
        params: {
          slug: this.$route.params.slug,
          app: true
        }
      })
        .then((response) => {
          this.page = response.data[0]
          this.setPageTitle(this.page.title)
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
.page {
  min-height: calc(100vh - 4rem);

  @screen md {
    min-height: calc(100vh - 5rem);
  }

  &-title {
    @apply font-display font-bold uppercase text-4xl text-center mb-12;
  }
}
</style>
