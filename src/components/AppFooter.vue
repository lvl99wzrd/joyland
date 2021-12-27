<template>
  <div id="appFooter">
    <div class="container py-6">
      <div class="flex flex-wrap items-center -mx-4">
        <div class="w-full md:w-1/5 px-4 mt-4 text-center md:text-left">
          <ul>
            <li><router-link to="/about">About</router-link></li>
            <li><router-link to="/sponsors-and-partners">Sponsors & Partners</router-link></li>
            <li><router-link to="/press">Press</router-link></li>
            <li><router-link to="/contact-us">Contact Us</router-link></li>
          </ul>
        </div>
        <div class="w-full md:w-3/5 px-4 mt-4 text-center">
          <div v-if="app.footer.sponsors.length" class="sponsors">
            <div v-for="(sponsor, index) in app.footer.sponsors" :key="index" class="sponsor">
              <img :src="sponsor.logo">
              <a v-if="sponsor.link" :href="sponsor.link" target="_blank" />
            </div>
          </div>
        </div>
        <div class="w-full md:w-1/5 px-4 mt-4 text-right">
          <subscribe-form v-if="app.footer.subscribe.enabled" />
        </div>
      </div>
      <div class="mt-4 md:mt-8 text-center text-sm" v-html="app.footer.copyright" />
    </div>
  </div>
</template>

<script>
import SubscribeForm from '@/components/SubscribeForm'

export default {
  name: 'AppFooter',
  components: {
    SubscribeForm
  }
}
</script>

<style lang="scss" scoped>
#appFooter {
  @apply bg-orange-light text-white;
}

.sponsors {
  @apply flex flex-wrap items-center justify-center;

  .sponsor {
    @apply w-32 my-2 mx-3 relative;

    a {
      @apply block absolute inset-0;
    }
  }
}
</style>
