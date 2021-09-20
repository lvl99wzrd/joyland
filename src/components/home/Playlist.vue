<template>
  <div class="home-playlist">
    <div class="container">
      <h1 class="font-display text-4xl text-creme-dark uppercase text-center font-bold mb-10">Joyland Playlist</h1>
      <div class="playlist-wrapper">
        <iframe v-if="playlist" :src="playlist" frameborder="0" allowtransparency="true" allow="encrypted-media" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomePlaylist',
  props: {
    playlist: {
      type: String,
      default: ''
    }
  }
}
</script>

<style lang="scss" scoped>
.home-playlist {
  @apply bg-lime py-16;

  .playlist-wrapper {
    @apply relative w-full h-0;
    padding-top: 50vh;

    iframe {
      @apply absolute w-full h-full top-0 left-0;
    }
  }
}
</style>
