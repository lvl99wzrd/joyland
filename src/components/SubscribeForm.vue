<template>
  <div class="subscribe-form">
    <form v-show="!subscribed" id="subscribe-form" autocomplete="off" @submit.prevent="doSubscribe">
      <label for="subscribe-email" :class="{ labelTop }">Join Our Mailing List</label>
      <div :class="['subscribe-email-wrapper', { labelTop }]">
        <input
          type="email"
          id="subscribe-email"
          name="subscribe_email"
          v-model="email"
          :placeholder="labelTop ? 'Email Address' : ''"
          @focus="labelTop = true"
          @blur="labelTop = email ? true : false"
        >
      </div>
      <button type="submit" id="subscribe-button" :class="{ showButton: labelTop }" :disabled="!email || loading">
        {{ loading ? 'Subscribing...' : 'Subscribe' }}
      </button>
    </form>
    <div v-show="subscribed" class="text-center text-sm py-8">
      You are now subscribed!
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'SubsribeForm',
  data() {
    return {
      email: null,
      loading: false,
      labelTop: false,
      subscribed: false
    }
  },
  methods: {
    doSubscribe() {
      this.loading = true
      axios({
        method: 'post',
        url: `${this.app.rest.theme}/mailchimp`,
        data: {
          email: this.email
        }
      })
        .then(() => {
          // console.log(response.data)
          this.subscribed = true
          this.email = null
          this.labelTop = false
          setTimeout(() => {
            this.subscribed = false
          }, 4000)
        })
        .catch((error) => {
          console.log(error.response)
        })
        .finally(() => {
          this.loading = false
        })
    },
    validateEmail() {
      if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(this.email))
        return (true)
      
      return (false)
    }
  }
}
</script>

<style lang="scss" scoped>
#subscribe-form {
  @apply relative py-8;

  label {
    @apply absolute top-10 right-0 w-full text-center transition-all duration-300 cursor-pointer z-10;

    &.labelTop {
      @apply text-xs top-4;
    }
  }

  .subscribe-email-wrapper {
    @apply relative;

    &::after {
      content: '';
      @apply block border-b border-white absolute bottom-0 left-1/2 right-1/2 transition-all duration-300;
    }

    &.labelTop::after {
      @apply left-0 right-0;
    }
  }

  #subscribe-email {
    @apply block w-full text-center py-1 pl-0 pr-2 border-0 bg-transparent placeholder-gray-200 focus:outline-none;

    &::-webkit-input-placeholder {
      @apply italic;
    }
    &:-moz-placeholder {
      @apply italic;  
    }
    &::-moz-placeholder {
      @apply italic;  
    }
    &:-ms-input-placeholder {  
      @apply italic; 
    }
  }

  #subscribe-button {
    @apply absolute block w-full bottom-0 border border-white text-center py-1 transform scale-0 text-sm transition-all duration-300 focus:outline-none;

    &.showButton {
      @apply transform scale-100;
    }

    &:hover {
      @apply bg-white text-orange-dark;
    }

    &:disabled {
      @apply pointer-events-none opacity-50;
    }
  }
}
</style>
