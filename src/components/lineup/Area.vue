<template>
  <div v-if="area" class="lineup-area">
    <div v-if="lineups.length" class="flex flex-wrap -mx-2 mb-4">
      <div v-for="lineup in lineups" :key="lineup.id" class="w-1/2 md:w-1/4 px-2 mb-4">
        <router-link :to="{ name: 'Line-Ups', params: { area: lineup.area.slug, artist: lineup.slug } }" class="lineup">
          <div class="lineup__photo" :style="{ backgroundImage: `url(${lineup.photo})` }" />
          <div class="lineup__overlay">
            <span v-html="lineup.name" />
          </div>
        </router-link>
      </div>
    </div>
    <div v-if="!area.complete" class="text-center font-display text-orange-light text-2xl uppercase">More Coming Soon</div>
  </div>
</template>

<script>
import { sortBy } from 'lodash'

export default {
  name: 'AreaLineup',
  data() {
    return {
      loading: false,
      area: false
    }
  },
  computed: {
    lineups() {
      if (this.alphabetical)
        return sortBy(this.area.lineups, ['name'])
      else
        return this.area.lineups
    }
  },
  watch: {
    '$route': function() {
      if (this.$route.params.area)
        this.getArea()
    }
  },
  created() {
    if (this.$route.params.area)
      this.getArea()
  },
  methods: {
    getArea() {
      this.loading = true
      this.appAxios({
        method: 'get',
        url: `${this.app.rest.wp}/areas`,
        params: {
          slug: this.$route.params.area,
          app: true,
          include_lineups: true
        }
      })
        .then((response) => {
          this.area = response.data[0]
          this.setPageTitle(`${this.area.name} Line-Ups`)
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
.lineup {
  @apply relative block w-full h-0 overflow-hidden;
  padding-top: 100%;

  &__photo {
    @apply absolute inset-0 bg-cover bg-center bg-no-repeat transition-transform duration-300;
  }

  &__overlay {
    @apply absolute w-full h-full top-0 left-0 transform scale-0 transition-transform duration-300 bg-black bg-opacity-50  flex items-center justify-center text-white font-display uppercase font-bold text-2xl text-center p-4;
  }

  &:hover {
    .lineup {
      &__photo {
        @apply transform scale-125;
      }

      &__overlay {
        @apply transform scale-100;
      }
    }
  }
}
</style>
