<template>
  <div :class="['app-nav', { 'is-visible': offcanvas }]">
    <div class="app-menu">
      <router-link v-if="app.header.show_lineup" to="/lineup">
        Line-Up
      </router-link>
      <router-link v-if="app.header.show_areas" to="/area">
        Areas
      </router-link>
      <router-link v-if="app.header.show_info" to="/info">
        Info
      </router-link>
      <router-link v-if="app.header.show_gallery" to="/gallery">
        Gallery
      </router-link>
      <a v-if="app.header.shop" :href="app.header.shop" target="_blank">Shop</a>
      <router-link v-if="app.header.show_digital" to="/digital">
        Digital
      </router-link>
    </div>
    <div class="app-social">
      <a v-if="app.header.youtube" :href="app.header.youtube" target="_blank">
        <unicon name="youtube" fill="currentColor" width="1.5rem" height="1.5rem" />
      </a>
      <a v-if="app.header.instagram" :href="app.header.instagram" target="_blank">
        <unicon name="instagram-alt" fill="currentColor" width="1.5rem" height="1.5rem" />
      </a>
      <a v-if="app.header.spotify" :href="app.header.spotify" target="_blank">
        <unicon name="joy-spotify" fill="currentColor" width="1.5rem" height="1.5rem" />
      </a>
      <a v-if="app.header.plainsong" :href="app.header.plainsong" target="_blank">
        <unicon name="joy-plainsong" fill="currentColor" width="1.5rem" height="1.5rem" />
      </a>
    </div>
    <button type="button" class="app-nav-close" @click="toggleOffcanvas(false)">
      <unicon name="times" fill="currentColor" width="2rem" height="2rem" />
    </button>
  </div>
</template>

<script>
export default {
  name: 'AppNav'
}
</script>

<style lang="scss" scoped>
.app-nav {
  @apply fixed top-0 right-full w-52 h-screen flex flex-col flex-wrap items-center justify-center px-4 bg-blue-light md:bg-transparent z-50 transition-all duration-500 ease-in-out;

  @screen md {
    @apply relative flex-row w-full h-auto right-auto;
  }

  &-close {
    @apply md:hidden absolute top-4 right-4 w-8 h-8 flex items-center justify-center text-orange-light focus:outline-none;
  }

  &.is-visible {
    box-shadow: 4px 0 6px rgba(0,0,0,.15);
  }
}

.app-menu {
  @apply flex flex-col md:flex-row items-center justify-center mr-auto w-full md:w-auto;
  
  a {
    @apply relative mx-4 mb-4 md:mb-0 text-orange-light block font-display uppercase;

    &::before {
      content: '';
      @apply w-full h-0.5 bg-orange-light absolute opacity-0 top-1/2 left-0 transition-all duration-300;
    }

    &:hover,
    &.is-active {
      &::before {
        @apply opacity-100 top-full;
      }
    }
  }
}

.app-social {
  @apply w-auto h-auto flex items-center -mx-2 mt-4 md:mt-0;

  a {
    @apply w-6 h-6 mx-2 flex items-center justify-center text-orange-light hover:text-blue-light;
  }
}
</style>
