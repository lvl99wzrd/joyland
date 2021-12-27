<template>
  <div id="gallery">
    <div v-if="gallery" class="gallery">
      <h1 class="gallery__name" v-html="gallery.title" />
      <div v-if="gallery.gallery.length" class="gallery__images">
        <div v-swiper:mySwiper="swiperOptions">
          <div class="swiper-wrapper">
            <div class="swiper-slide" v-for="(image, index) in gallery.gallery" :key="index">
              <img :src="image.url">
            </div>
          </div>
          <button type="button" class="swiper-prev">
            <unicon name="joy-arrow-left" fill="currentColor" width="1.75rem" height="1.75rem" />
          </button>
          <button type="button" class="swiper-next">
            <unicon name="joy-arrow-right" fill="currentColor" width="1.75rem" height="1.75rem" />
          </button>
        </div>
      </div>
      <div class="content" v-html="gallery.description" />
    </div>
  </div>
</template>

<script>
import { directive } from 'vue-awesome-swiper'
import 'swiper/css/swiper.css'

export default {
  name: 'Gallery',
  directives: {
    swiper: directive
  },
  data() {
    return {
      loading: true,
      gallery: false,
      swiperOptions: {
        loop: false,
        slidesPerView: 1,
        centeredSlides: true,
        spaceBetween: 15,
        simulateTouch: false,
        speed: 500,
        navigation: {
          nextEl: '.swiper-next',
          prevEl: '.swiper-prev'
        }
      }
    }
  },
  created() {
    this.getGallery()
  },
  methods: {
    getGallery() {
      this.loading = true
      this.appAxios({
        method: 'get',
        url: `${this.app.rest.wp}/galleries`,
        params: {
          app: true,
          slug: this.$route.params.slug
        }
      })
        .then((response) => {
          this.gallery = response.data[0]
          this.setPageTitle(`${this.gallery.title} Gallery`)
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
#gallery {
  @apply bg-yellow overflow-x-hidden;
  min-height: calc(100vh - 12rem);
}

.gallery {
  @apply py-12 md:py-20 text-white;

  &__images {
    @apply max-w-3xl mx-auto mb-8 px-4 md:px-0 overflow-visible;
  }

  &__name {
    @apply font-display text-center uppercase text-3xl md:text-5xl max-w-3xl mx-auto mb-8 px-7 md:px-3;
  }

  &__lineup {
    @apply relative inline-flex py-2 px-4 items-center justify-center font-display uppercase text-white;
    border: 0.5rem solid transparent;
    border-image: url('~@/assets/img/brush-blue-light.svg') 20% stretch;

    span {
      z-index: 1;
    }
    
    &::before {
      content: '';
      z-index: 0;
      @apply absolute -inset-1 bg-blue-light;
    }
  }

  .content {
    @apply max-w-3xl mx-auto px-7 md:px-3;
  }
}

.swiper {
  &-container {
    @apply overflow-visible relative;
  }

  &-slide {
    @apply max-w-3xl transform scale-90 opacity-50 transition-all duration-500;
    border: 1.5rem solid transparent;
    border-image: url('~@/assets/img/border-brush-1.svg') 8 stretch;

    &-active {
      @apply opacity-100 scale-100;
    }
  }

  &-next,
  &-prev {
    @apply absolute top-1/2 -mt-3.5 w-7 h-7 flex items-center justify-center z-10 text-orange-light cursor-pointer focus:outline-none transform scale-75 md:scale-100;

    &:hover {
      @apply text-orange-dark;
    }

    &.swiper-button-disabled {
      @apply opacity-50 pointer-events-none;
    }
  }

  &-prev {
    @apply left-4;
  }

  &-next {
    @apply right-4;
  }
}
</style>
