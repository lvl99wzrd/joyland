<template>
  <div id="areas">
    <div v-if="areas.length" class="areas">
      <router-link :to="{ name: 'Area', params: { slug: area.slug } }" v-for="(area, index) in areas" :key="index" class="area">
        <div class="area__mask">
          <div v-if="area.thumbnail" class="area__thumbnail" :style="{ backgroundImage: `url(${area.thumbnail})` }" />
          <div class="area__content">
            <h1 class="text-center" v-html="area.name" />
          </div>
        </div>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Areas',
  data() {
    return {
      areas: []
    }
  },
  created() {
    this.getAreas()
    this.setPageTitle('Areas')
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
  }
}
</script>

<style lang="scss" scoped>
#areas {
  @apply bg-lime;
  min-height: calc(100vh - 12rem);
}

.areas {
  @apply max-w-6xl mx-auto flex flex-wrap items-center justify-center py-12 md:py-20;
}

.area {
  @apply w-full md:w-1/3 mx-4 mb-4 md:mx-0 md:mb-0;

  &__mask {
    @apply relative w-full h-0 transition-all duration-500;
    padding-top: 66.6666%;
    background-color: #313c62;
  }

  &__thumbnail {
    @apply absolute inset-0 bg-cover bg-center bg-no-repeat opacity-0 pointer-events-none transition-opacity duration-500;
  }

  &__content {
    @apply absolute inset-0 p-10 md:p-20 flex flex-col justify-center;

    h1 {
      @apply font-display text-2xl md:text-4xl text-white;
    }
  }

  @for $i from 1 through 6 {
    &:nth-child(6n + #{$i}) {
      .area__mask {
        mask-image: url('~@/assets/img/area-mask-#{$i}.svg');
        mask-size: contain;
        mask-repeat: no-repeat;
        mask-position: center;
      }
    }
  }

  &:hover {
    .area__thumbnail {
      @apply opacity-50;
    }

    .area__mask {
      @apply bg-blue-light;
    }
  }
}
</style>
