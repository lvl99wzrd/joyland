/* global appSettings */
import { mapGetters, mapActions } from 'vuex'

export default {
  data() {
    return {
      app: appSettings
    }
  },
  computed: {
    ...mapGetters([
      'offcanvas',
      'alphabetical'
    ])
  },
  methods: {
    ...mapActions([
      'appAxios'
    ]),
    setPageTitle(title) {
      let pageTitle = this.app.site.title
      if (title) {
        pageTitle += ' | ' + title
      }
      document.title = pageTitle
    },
    toggleOffcanvas(show) {
      this.$store.commit('setOffcanvas', show)
      // const app = document.getElementById('appWrapper')
      if (show)
        document.body.classList.add('offcanvas-shown')
      else
        document.body.classList.remove('offcanvas-shown')
    }
  }
}
