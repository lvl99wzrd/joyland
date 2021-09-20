<template>
  <div class="home-lineup">
    <div class="container">
      <h1 class="font-display text-4xl text-creme-dark uppercase text-center font-bold mb-10">Line-Up</h1>
      <div v-if="lineups.length" class="flex flex-wrap items-center px-2 mb-10">
        <div v-for="(lineup, index) in lineups" :key="lineup.id" class="lineup">
          <img class="lineup__shadow" :src="require(`@/assets/img/lineup-shadow-${index+1}.svg`)">
          <div class="lineup__content">
            <div class="lineup__content__photo" :style="{ backgroundImage: `url(${lineup.photo})` }" />
            <router-link :to="{ name: 'Line-Ups', params: { area: lineup.area.slug, artist: lineup.slug } }" class="lineup__content__overlay">
              <span v-html="lineup.name" />
            </router-link>
          </div>
        </div>
      </div>
      <div class="text-center">
        <router-link :to="{ name: 'Line-Ups' }" class="text-xl text-creme-dark hover:text-white">
          See Full Line-Up
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomeLineup',
  props: {
    lineups: {
      type: Array,
      default() {
        return []
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.home-lineup {
  @apply bg-purple py-16;

  .lineup {
    @apply relative w-1/2 md:w-1/4 mb-6;

    @for $i from 1 through 4 {
      &:nth-child(4n + #{$i}) {
        .lineup__content {
          mask-image: url('~@/assets/img/lineup-mask-#{$i}.svg');
          mask-size: contain;
          mask-repeat: no-repeat;
          mask-position: center;
        }
      }
    }

    &__shadow {
      @apply transition-transform duration-300;
    }

    &__content {
      @apply absolute w-full h-full top-0 left-0;

      &__photo {
        @apply w-full h-full transition-transform duration-300 bg-cover bg-center bg-no-repeat;
      }

      &__overlay {
        @apply absolute inset-0 bg-blue-light bg-opacity-50 opacity-0 transition-opacity duration-300 flex items-center justify-center;

        span {
          @apply block transform translate-y-4 font-display font-bold text-2xl text-center w-1/2 transition-transform duration-300 text-white uppercase;
        }
      }
    }

    &:hover {
      .lineup__shadow {
        @apply transform translate-x-2 translate-y-2;
      }

      .lineup__content__photo {
        @apply transform scale-125;
      }

      .lineup__content__overlay {
        @apply opacity-100;

        span {
          @apply transform translate-y-0;
        }
      }
    }
  }
}
</style>
