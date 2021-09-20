<template>
  <div id="home">
    <hero-section :content="home.hero" />
    <lineup-section :lineups="home.lineups" />
    <video-section :video="home.video" />
    <playlist-section :playlist="home.playlist" />
  </div>
</template>

<script>
import HeroSection from '@/components/home/Hero'
import LineupSection from '@/components/home/Lineup'
import VideoSection from '@/components/home/Video'
import PlaylistSection from '@/components/home/Playlist'

export default {
  name: 'Home',
  components: {
    HeroSection,
    LineupSection,
    VideoSection,
    PlaylistSection
  },
  data() {
    return {
      home: false,
      loading: false
    }
  },
  created() {
    this.getHome()
    this.setPageTitle('Home')
  },
  methods: {
    getHome() {
      this.loading = true
      this.appAxios({
        method: 'get',
        url: `${this.app.rest.theme}/home-page`
      })
        .then((response) => {
          console.log(response.data)
          this.home = response.data
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
