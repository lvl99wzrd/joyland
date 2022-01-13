<template>
  <div>
    <div v-if="content.background.horizontal || content.background.vertical" class="home-hero">
      <img :src="content.background.horizontal" class="absolute top-0 left-0 object-cover object-center w-full h-full z-0 hidden md:block">
      <img :src="content.background.vertical" class="absolute top-0 left-0 object-cover object-center w-full h-full z-0 md:hidden">
      <div class="relative container pointer-events-none h-full z-10">
        <div class="flex items-center justify-center w-full h-full">
          <div class="w-2/3 md:w-1/3">
            <div class="w-full text-white">
              <app-logo />
              <div class="font-display text-4xl uppercase text-center text-white mt-4" v-html="content.event_date" />
              <div class="font-display text-xl text-center text-white mt-2" v-html="content.event_location" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else ref="heroLand" class="home-hero home-hero__default-bg" @mousemove="hoverParallax">
      <div ref="heroDots" class="home-hero__dots hero-bg-part" />
      <div ref="heroPlanets" class="home-hero__planets hero-bg-part" />
      <div ref="heroStars" class="home-hero__stars hero-bg-part" />
      <div ref="heroPlantsLeft" class="home-hero__plantsLeft hero-bg-part bg-no-repeat" />
      <div ref="heroPlantsRight" class="home-hero__plantsRight hero-bg-part bg-no-repeat" />
      <div ref="heroOrangutan" class="home-hero__orangutan hero-bg-part bg-no-repeat" />
      <div ref="heroBunny" class="home-hero__bunny hero-bg-part bg-no-repeat" />
      <div ref="heroPlants" class="home-hero__plants hero-bg-part bg-repeat-x" />
      <div class="container pointer-events-none h-full z-10">
        <div class="flex items-center justify-center w-full h-full">
          <div class="w-2/3 md:w-1/3">
            <div class="w-full text-white">
              <app-logo />
              <div class="font-display text-4xl uppercase text-center text-white mt-4" v-html="content.event_date" />
              <div class="font-display text-xl text-center text-white mt-2" v-html="content.event_location" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AppLogo from '@/components/AppLogo'

export default {
  name: 'HomeHero',
  components: {
    AppLogo
  },
  props: {
    content: {
      type: Object,
      default() {
        return {
          background: {
            horizontal: null,
            vertical: null
          },
          event_date: '',
          event_location: ''
        }
      }
    }
  },
  methods: {
    hoverParallax(e) {
      const rect = e.target.getBoundingClientRect()
      const x = ((e.x - Math.floor(rect.x)) / rect.width) * 100
      const y = ((e.y - Math.floor(rect.y)) / rect.height) * 100
      const xPos = 50+(x*0.1)
      const yPos = 50+(y*0.1)
      this.$refs.heroDots.style.backgroundPosition = xPos + '% ' + yPos + '%'
      this.$refs.heroPlanets.style.backgroundPosition = xPos*1.05 + '% ' + yPos*1.05 + '%'
      this.$refs.heroLand.style.backgroundPosition = xPos*1.25 + '% ' + yPos*1.25 + '%'
      this.$refs.heroStars.style.backgroundPosition = xPos*1.75 + '% ' + yPos*1.75 + '%'
      this.$refs.heroPlants.style.backgroundPosition = 50-(x*0.075) + '% 100%'
      this.$refs.heroPlantsLeft.style.backgroundPosition = '0% ' + yPos*1.25 + '%'
      this.$refs.heroPlantsRight.style.backgroundPosition = '100% ' + yPos*1.25 + '%'
    }
  }
}
</script>

<style lang="scss" scoped>
.home-hero {
  @apply relative w-full bg-gray-300 z-10 bg-cover bg-no-repeat bg-center;
  height: calc(100vh - 4rem);

  &__default-bg {
    background-image: url('~@/assets/img/hero-far.png');
  }

  @screen md {
    height: calc(100vh - 5rem);
  }

  .hero-bg-part {
    @apply absolute inset-0;
    z-index: -1;
  }

  &__dots,
  &__planets,
  &__stars {
    background-position: 50% 50%;
    background-size: auto 105%;
    background-repeat: no-repeat;
  }

  &__dots {
    background-image: url('~@/assets/img/hero-dots-alt.png');
  }

  &__planets {
    background-image: url('~@/assets/img/hero-planets.png');
  }

  &__stars {
    background-image: url('~@/assets/img/hero-stars.png');
  }

  &__plants {
    background-image: url('~@/assets/img/hero-plants.png');
    background-position: 50% 100%;
    background-size: 50%;
  }

  &__plantsLeft {
    background-image: url('~@/assets/img/hero-plantsLeft.png');
    background-position: 0% 50%;
    background-size: auto 105%;
  }

  &__plantsRight {
    background-image: url('~@/assets/img/hero-plantsRight.png');
    background-position: 100% 50%;
    background-size: auto 105%;
  }

  &__orangutan {
    background-image: url('~@/assets/img/hero-orangutan.png');
    background-position: 105% 110%;
  }

  &__bunny {
    background-image: url('~@/assets/img/hero-bunny.png');
    background-position: -5% 110%;
  }

  &__orangutan,
  &__bunny {
    background-size: 45%;

    @screen md {
      background-size: 35%;
    }

    @screen lg {
      background-size: 30%;
    }
  }
}
</style>
