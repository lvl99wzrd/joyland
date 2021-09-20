<template>
  <div class="lineup-detail">
    <div v-if="lineup" class="lineup">
      <div class="flex -mx-2 mb-8">
        <div class="w-40 md:w-52 px-2">
          <div class="lineup__photo" :style="{ backgroundImage: `url(${lineup.photo})` }" />
        </div>
        <div class="flex-grow px-2">
          <h1 class="font-display text-2xl md:text-4xl mb-2" v-html="lineup.name" />
          <span class="font-bold" v-html="lineup.area.name" /> - <span v-html="schedule" />
          <div class="border-b mt-4 border-white" />
        </div>
      </div>
      <div class="content mb-8" v-html="lineup.content" />
      <div v-if="lineup.playlist" class="playlist-wrapper">
        <iframe :src="lineup.playlist" frameborder="0" allowtransparency="true" allow="encrypted-media" />
      </div>
    </div>
  </div>
</template>

<script>
import { DateTime } from 'luxon'

export default {
  name: 'LineupDetail',
  data() {
    return {
      loading: false,
      lineup: false
    }
  },
  computed: {
    schedule() {
      if (this.lineup && this.lineup.schedule.date_gmt) {
        const dt = DateTime.fromISO(this.lineup.schedule.date_gmt).setZone(this.app.site.timezone).setLocale('id')
        return dt.toFormat('fff')
      }

      return null
    }
  },
  created() {
    this.getLineup()
  },
  methods: {
    getLineup() {
      this.loading = true
      this.appAxios({
        method: 'get',
        url: `${this.app.rest.wp}/lineup`,
        params: {
          app: true,
          slug: this.$route.params.artist
        }
      })
        .then((response) => {
          console.log(response.data)
          this.lineup = response.data[0]
          this.setPageTitle(`${this.lineup.area.name} - ${this.lineup.name}`)
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
  &__photo {
    @apply relative w-full h-0 bg-cover bg-center bg-no-repeat;
    padding-top: 100%;
  }
}

.playlist-wrapper {
  @apply relative w-full h-0;
  padding-top: 40vh;

  iframe {
    @apply absolute w-full h-full top-0 left-0;
  }
}
</style>
