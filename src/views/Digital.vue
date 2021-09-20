<template>
  <div id="digital">
    <div v-if="!loading && items.length">
      <div class="digital">
        <div v-for="(item, index) in items" :key="index" class="digital__item">
          <div class="digital__item-thumbnail">
            <h1>
              <a :href="item.link.url" :target="item.link.target" v-html="item.name" />
            </h1>
            <a :href="item.link.url" :target="item.link.target" class="digital__item-image">
              <img :src="item.image">
            </a>
          </div>
          <div class="digital__item-description" v-html="item.description" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Digital',
  data() {
    return {
      items: [],
      loading: true
    }
  },
  created() {
    this.getDigital()
    this.setPageTitle('Digital')
  },
  methods: {
    getDigital() {
      this.loading = true
      this.appAxios({
        method: 'get',
        url: `${this.app.rest.theme}/digital-page`
      })
        .then((response) => {
          this.items = response.data
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
#digital {
  @apply bg-purple;
  min-height: calc(100vh - 6rem);
    
  @screen md {
    min-height: calc(100vh - 8rem);
  }
}

.digital {
  @apply max-w-3xl mx-auto py-16 px-4 md:px-0;

  &__item {
    @apply mb-20 text-creme-dark;

    &-thumbnail {
      @apply relative block z-0;

      h1 {
        @apply font-display text-2xl mb-6 px-2 uppercase font-bold text-center;
      }
    }

    &-description {
      @apply px-2;
    }

    &-image {
      @apply relative block w-full z-0 mb-4;
      border: 1.5rem solid transparent;
      border-image-slice: 8;
      border-image-repeat: stretch;
    }

    @for $i from 1 through 4 {
      &:nth-child(4n + #{$i}) {
        .digital__item-image {
          border-image-source: url('~@/assets/img/border-brush-#{$i}.svg');
        }
      }
    }
  }
}
</style>
