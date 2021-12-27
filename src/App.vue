<template>
  <div id="app">
    <app-header />
    <div id="appWrapper">
      <main id="appMain">
        <router-view/>
      </main>
      <app-footer />
    </div>
    <offcanvas-outside />
    <vue-progress-bar />
  </div>
</template>

<script>
import axios from 'axios'
import AppHeader from './components/AppHeader'
import AppFooter from './components/AppFooter'
import OffcanvasOutside from './components/OffcanvasOutside'

export default {
  name: 'App',
  components: {
    AppHeader,
    AppFooter,
    OffcanvasOutside
  },
  created() {
    this.loadingIndicator()
  },
  methods: {
    calculatePercentage(loaded, total) {
      return (Math.floor(loaded * 1.0) / total)
    },
    loadingIndicator() {
      let requestsCounter = 0
      let ajaxLoading = false

      const setupStartProgress = () => {
        axios.interceptors.request.use(config => {
          requestsCounter++
          if (!ajaxLoading) {
            this.$Progress.start()
            ajaxLoading = true
          }
          return config
        })
      }

      const setupUpdateProgress = () => {
        const update = e => this.calculatePercentage(e.loaded, e.total)
        axios.defaults.onDownloadProgress = update
        axios.defaults.onUploadProgress = update
      }
      
      const setupStopProgress = () => {
        const responseFunc = response => {
          if ((--requestsCounter) === 0 && ajaxLoading) {
            this.$Progress.finish()
            ajaxLoading = false
          }
          return response
        }

        const errorFunc = error => {
          if ((--requestsCounter) === 0 && ajaxLoading) {
            this.$Progress.finish()
            ajaxLoading = false
          }
          return Promise.reject(error)
        }

        axios.interceptors.response.use(responseFunc, errorFunc)
      }

      setupStartProgress()
      setupUpdateProgress()
      setupStopProgress()
    }
  }
}
</script>

<style lang="scss">
// @import './assets/fonts/stylesheet.css';
@import './assets/scss/app.scss';
</style>
