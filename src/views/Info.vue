<template>
  <div id="info">
    <div class="container">
      <div class="flex flex-wrap -mx-4">
        <div class="info-sidebar">
          <affix relative-element-selector=".info-sidebar" :offset="{ top: 80, bottom: 80 }">
            <h1>Event Info</h1>
            <div v-for="(section, index) in sections" :key="index" class="mb-3">
              <a href="#" :data-section="`section-${index}`" v-html="section.name" @click.prevent="scrollToSection" />
            </div>
          </affix>
        </div>
        <div class="info-sections">
          <div v-for="(section, index) in sections" :key="index" :id="`section-${index}`" class="info-section">
            <h2 v-html="section.name" />
            <div class="content" v-html="section.content" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Affix } from 'vue-affix'

export default {
  name: 'Info',
  components: {
    Affix
  },
  data() {
    return {
      loading: false,
      sections: []
    }
  },
  created() {
    this.getInfo()
    this.setPageTitle('Info')
  },
  methods: {
    getInfo() {
      this.loading = true
      this.appAxios({
        method: 'get',
        url: `${this.app.rest.theme}/info-page`
      })
        .then((response) => {
          this.sections = response.data
        })
        .catch((error) => {
          console.log(error.response)
        })
        .finally(() => {
          this.loading = false
        })
    },
    scrollToSection(event) {
      const id = event.target.dataset.section
      const section = document.getElementById(id)
      const offset = section.offsetTop - 144
      window.scrollTo(0, offset)
    }
  }
}
</script>

<style lang="scss" scoped>
#info {
  background: -webkit-linear-gradient(90deg, theme('colors.blue.dark') 50%, theme('colors.blue.light') 50%);
  background: -o-linear-gradient(90deg, theme('colors.blue.dark') 50%, theme('colors.blue.light') 50%);
  background: -moz-linear-gradient(90deg, theme('colors.blue.dark') 50%, theme('colors.blue.light') 50%);
  background: linear-gradient(90deg, theme('colors.blue.dark') 50%, theme('colors.blue.light') 50%);
}

.info {
  &-sidebar,
  &-sections {
    min-height: calc(100vh - 4rem);
  
    @screen md {
      min-height: calc(100vh - 5rem);
    }
  }

  &-sidebar {
    @apply w-full md:w-1/4 px-4 py-16 bg-blue-dark text-white;

    h1 {
      @apply font-display font-bold text-2xl mb-6 uppercase;
    }

    a {
      @apply text-lg;
    }
  }

  &-sections {
    @apply w-full md:w-3/4 bg-blue-light px-4 md:pl-16 py-16 text-white;
  }

  &-section {
    @apply mb-16;

    h2 {
      @apply font-display font-bold text-2xl uppercase border-b border-white mb-4;
    }
  }
}
</style>
