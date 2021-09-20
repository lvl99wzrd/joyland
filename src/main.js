import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

Vue.config.productionTip = false

// Progressbar
import VueProgressBar from 'vue-progressbar'
const options = {
  color: '#D27756',
  failedColor: '#DC2626',
  thickness: '3px',
  transition: {
    speed: '0.3s',
    opacity: '0.6s',
    termination: 300
  },
  autoFinish: false
}
Vue.use(VueProgressBar, options)

// Unicons
import Unicon from 'vue-unicons/dist/vue-unicons-vue2.umd'
import { uniYoutube, uniInstagramAlt, uniBars, uniTimes } from 'vue-unicons/dist/icons'
import { joyPlainsong, joySpotify, joyArrowLeft, joyArrowRight } from './custom-icons'
Unicon.add([uniYoutube, uniInstagramAlt, uniBars, uniTimes, joyPlainsong, joySpotify, joyArrowLeft, joyArrowRight])
Vue.use(Unicon)

// Global Mixins
import mixins from './mixins'
Vue.mixin(mixins)

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
