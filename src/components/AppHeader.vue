<template>
  <div id="appHeader" :class="{ 'offcanvas-shown': offcanvas }">
    <div class="container">
      <div class="app-header">
        <button type="button" class="app-burgerbar" @click="toggleNav">
          <unicon name="bars" fill="currentColor" width="2rem" height="2rem" />
        </button>
        <div class="w-32 md:w-48 h-auto px-4">
          <router-link class="app-logo" :to="{ name: 'Home' }">
            <app-logo />
          </router-link>
        </div>
        <div class="flex-grow flex items-center">
          <app-nav />
        </div>
        <a href="https://www.tiket.com/" target="_blank" class="ticket-link btn btn-brush btn-brush-blue-light">
          <span>Buy Tickets</span>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import AppLogo from './AppLogo'
import AppNav from './AppNav'

export default {
  name: 'AppHeader',
  components: {
    AppLogo,
    AppNav
  },
  watch: {
    '$route': function() {
      this.toggleOffcanvas(false)
    }
  },
  methods: {
    toggleNav() {
      this.toggleOffcanvas(!this.offcanvas)
    }
  }
}
</script>

<style lang="scss" scoped>
#appHeader {
  @apply fixed top-0 left-0 w-full bg-creme-dark z-50 transition-all duration-500 ease-in-out;
  box-shadow: 0 4px 6px rgba(0,0,0,.15);

  &.offcanvas-shown {
    transform: translateX(13rem);
  }
}

.app-header {
  @apply flex items-center -mx-4 h-16 md:h-20;
}

.app-logo {
  @apply text-orange-light hover:text-blue-light;
}

.app-burgerbar {
  @apply w-8 h-8 inline-flex items-center justify-center md:hidden text-orange-light focus:outline-none mx-4;
}

.ticket-link {
  @apply transition-transform duration-300 mx-2 -mt-0.5 text-sm md:text-lg px-4 md:px-8;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;

  &:hover {
    @apply transform scale-90;
  }
}
</style>
