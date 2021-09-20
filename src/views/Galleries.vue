<template>
  <div id="galleries">
    <div class="galleries">
      <div v-for="(gallery, index) in galleries" :key="index" class="gallery">
        <router-link :to="{ name: 'Gallery', params: { slug: gallery.slug } }">
          <div class="gallery__mask">
            <div v-if="gallery.thumbnail" class="gallery__thumbnail" :style="{ backgroundImage: `url(${gallery.thumbnail})` }" />
            <div class="gallery__content">
              <h1 class="text-center" v-html="gallery.title" />
            </div>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Galleries',
  data() {
    return {
      loading: true,
      galleries: []
    }
  },
  created() {
    this.setPageTitle('Gallery')
    this.getGalleries()
  },
  methods: {
    getGalleries() {
      this.loading = true
      this.appAxios({
        method: 'get',
        url: `${this.app.rest.wp}/galleries`,
        params: {
          app: true,
          per_page: 9,
          offset: 0
        }
      })
        .then((response) => {
          console.log(response.data)
          this.galleries = response.data
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
#galleries {
  @apply bg-yellow text-white;
  min-height: calc(100vh - 6rem);
    
  @screen md {
    min-height: calc(100vh - 8rem);
  }
}

.galleries {
  @apply max-w-6xl mx-auto flex flex-wrap items-center justify-center py-12 md:py-20;
}

.gallery {
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
      .gallery__mask {
        mask-image: url('~@/assets/img/area-mask-#{$i}.svg');
        mask-size: contain;
        mask-repeat: no-repeat;
        mask-position: center;
      }
    }
  }

  &:hover {
    .gallery__thumbnail {
      @apply opacity-50;
    }

    .gallery__mask {
      @apply bg-blue-light;
    }
  }
}
</style>
