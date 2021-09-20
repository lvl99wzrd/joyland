<template>
  <div id="lineup" :class="{ 'is-detail': this.$route.params.artist }">
    <div class="lineup-areas">
      <div class="container">
        <div v-if="areas" class="flex flex-wrap items-center justify-center -mx-2">
          <div v-for="area in areas" :key="area.id" class="px-2 my-4 text-white">
            <router-link :to="{ name: 'Line-Ups', params: { area: area.slug } }">
              <span v-html="area.name" />
            </router-link>
          </div>
          <div class="px-2 my-4 text-white">
            <a href="#" :class="['reorder', { alphabetical }]" @click.prevent="reorder">
              <span>A-Z</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="flex flex-wrap -mx-4">
        <div class="lineup-sidebar">
          <div class="mb-4">
            <router-link :to="{ name: 'Full Line-Ups' }">Full Line-Up</router-link>
          </div>
          <div class="mb-4">
            <router-link :to="{ name: 'Schedule' }">Schedule</router-link>
          </div>
        </div>
        <div class="lineup-view">
          <router-view />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Lineup',
  data() {
    return {
      loading: false,
      areas: false
    }
  },
  watch: {
    '$route': function(route) {
      if (route.path === '/lineup' || route.params.name === 'Line-Ups')
        this.getAreas()
    }
  },
  created() {
    this.getAreas()
  },
  methods: {
    getAreas() {
      this.loading = true
      this.appAxios({
        method: 'get',
        url: `${this.app.rest.wp}/areas`,
        params: {
          app: true
        }
      })
        .then((response) => {
          this.areas = response.data
          if (this.$route.path === '/lineup' && !this.$route.params.area) {
            this.$router.push({ name: 'Line-Ups', params: { area: this.areas[0].slug } })
          }
        })
        .catch((error) => {
          console.log(error.response)
        })
        .finally(() => {
          this.loading = false
        })
    },
    reorder() {
      this.$store.commit( 'setAlphabetical', !this.alphabetical )
    }
  }
}
</script>

<style lang="scss" scoped>
#lineup {
  @apply relative;
  background: -webkit-linear-gradient(90deg, theme('colors.creme.dark') 50%, theme('colors.creme.light') 50%);
  background: -o-linear-gradient(90deg, theme('colors.creme.dark') 50%, theme('colors.creme.light') 50%);
  background: -moz-linear-gradient(90deg, theme('colors.creme.dark') 50%, theme('colors.creme.light') 50%);
  background: linear-gradient(90deg, theme('colors.creme.dark') 50%, theme('colors.creme.light') 50%);

  .lineup {
    &-areas {
      @apply bg-orange-light;

      a {
        @apply relative flex items-center justify-center text-xs font-display uppercase text-white;

        span {
          z-index: 1;
        }

        &:not(.reorder) {
          border: 0.5rem solid transparent;
          border-image: url('~@/assets/img/brush-blue-light.svg') 20% stretch;
        }
        
        &:not(.reorder)::before {
          content: '';
          z-index: 0;
          @apply absolute -inset-1 bg-blue-light;
        }

        &.reorder {
          &.alphabetical {
            @apply underline;
          }
        }

        &.is-active {
          @apply text-blue-light;
          border-image: url('~@/assets/img/brush-white.svg') 20% stretch;

          &::before {
            @apply bg-white;
          }
        }
      }
    }

    &-sidebar,
    &-view {
      min-height: calc(100vh - 4rem);
    
      @screen md {
        min-height: calc(100vh - 5rem);
      }
    }

    &-sidebar {
      @apply w-full md:w-1/4 px-4 py-16 bg-creme-dark text-gray-600;

      a {
        @apply font-display font-bold text-2xl uppercase;

        &.is-exact {
          @apply text-orange-light;
        }
      }
    }

    &-view {
      @apply w-full md:w-3/4 bg-creme-light px-4 md:pl-16 py-16;
    }
  }
  
  &.is-detail {
    background: -webkit-linear-gradient(90deg, theme('colors.blue.dark') 50%, theme('colors.blue.light') 50%);
    background: -o-linear-gradient(90deg, theme('colors.blue.dark') 50%, theme('colors.blue.light') 50%);
    background: -moz-linear-gradient(90deg, theme('colors.blue.dark') 50%, theme('colors.blue.light') 50%);
    background: linear-gradient(90deg, theme('colors.blue.dark') 50%, theme('colors.blue.light') 50%);

    .lineup {
      &-sidebar {
        @apply bg-blue-dark text-white;
      }

      &-view {
        @apply bg-blue-light text-white;
      }
    }
  }
}
</style>
