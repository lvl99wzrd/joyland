<template>
  <component :is="theComponent" />
</template>

<script>
export default {
  name: 'Lineup',
  components: {
    areas: () => import('@/components/lineup/Area.vue'),
    detail: () => import('@/components/lineup/Detail.vue')
  },
  computed: {
    theComponent() {
      if (this.$route.params.artist)
        return 'detail'

      return 'areas'
    }
  }
}
</script>
