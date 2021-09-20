<template>
  <div id="area">
    <div v-if="area" class="area">
      <h1 class="area__name" v-html="area.name" />
      <div v-if="area.gallery.length" class="area__gallery">
        <div v-swiper:mySwiper="swiperOptions">
          <div class="swiper-wrapper">
            <div class="swiper-slide" v-for="(image, index) in area.gallery" :key="index">
              <img :src="image">
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
      <div class="content" v-html="area.description" />
      <div class="text-center mt-8">
        <router-link class="btn btn-lg btn-brush btn-brush-blue-light px-4" :to="{ name: 'Line-Ups', params: { area: area.slug } }">
          <span v-html="`${area.name} Line-Up`" />
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { directive } from 'vue-awesome-swiper'
import 'swiper/css/swiper.css'

export default {
  name: 'Area',
  directives: {
    swiper: directive
  },
  data() {
    return {
      loading: true,
      area: false,
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
    this.getArea()
  },
  methods: {
    getArea() {
      this.loading = true
      this.appAxios({
        method: 'get',
        url: `${this.app.rest.wp}/areas`,
        params: {
          app: true,
          slug: this.$route.params.slug
        }
      })
        .then((response) => {
          this.area = response.data[0]
          this.setPageTitle(`${this.area.name} Area`)
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
#area {
  @apply bg-lime overflow-x-hidden;
  min-height: calc(100vh - 12rem);
}

.area {
  @apply py-12 md:py-20 text-white;

  &__gallery {
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
