<template>
  <div class="home-video">
    <div class="container">
      <div v-if="video.source === 'youtube'" class="video-wrapper" v-html="video.youtube" />
      <div v-else class="video-wrapper">
        <video controls>
          <source :src="video.upload" type="video/mp4">
        </video>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomeVideo',
  props: {
    video: {
      type: Object,
      default() {
        return {
          source: 'youtube',
          upload: '',
          youtube: ''
        }
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.home-video {
  @apply bg-blue-light py-16 text-creme-light;
}
</style>
