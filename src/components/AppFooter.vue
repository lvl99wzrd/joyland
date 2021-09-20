<template>
  <div id="appFooter">
    <div class="container py-6">
      <div class="flex flex-wrap items-center -mx-4">
        <div class="w-full md:w-1/5 px-4 my-4">
          <ul>
            <li><router-link to="/about">About</router-link></li>
            <li><router-link to="/sponsors-and-partners">Sponsors & Partners</router-link></li>
            <li><router-link to="/press">Press</router-link></li>
            <li><router-link to="/contact-us">Contact Us</router-link></li>
          </ul>
        </div>
        <div class="w-full md:w-3/5 px-4 my-4 text-center">
          Main Sponsor Logo
        </div>
        <div class="w-full md:w-1/5 px-4 my-4 text-right">
          <subscribe-form v-if="app.footer.subscribe.enabled" />
        </div>
      </div>
      <div class="mt-4 text-center text-sm" v-html="app.footer.copyright" />
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
</style>
