import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'

Vue.use(VueRouter)

const home = {
  path: '/',
  name: 'Home',
  component: Home
}

const lineup = {
  path: '/lineup',
  name: '',
  component: () => import(/* webpackChunkName: "lineups" */ '../views/Lineup.vue'),
  children: [
    {
      path: ':area?/:artist?',
      name: 'Line-Ups',
      component: () => import(/* webpackChunkName: "stage" */ '../views/lineup/Lineup.vue')
    },
    {
      path: 'full',
      name: 'Full Line-Ups',
      component: () => import(/* webpackChunkName: "full" */ '../views/lineup/Full.vue')
    },
    {
      path: 'schedule',
      name: 'Schedule',
      component: () => import(/* webpackChunkName: "schedule" */ '../views/lineup/Schedule.vue')
    },
    {
      path: 'past',
      name: 'Past Line-Ups',
      component: () => import(/* webpackChunkName: "past" */ '../views/lineup/Past.vue')
    }
  ]
}

const digital = {
  path: '/digital',
  name: 'Digital',
  component: () => import(/* webpackChunkName: "digital" */ '../views/Digital.vue')
}

const areas = {
  path: '/area',
  name: 'Areas',
  component: () => import(/* webpackChunkName: "areas" */ '../views/Areas.vue')
}

const area = {
  path: '/area/:slug',
  name: 'Area',
  component: () => import(/* webpackChunkName: "area" */ '../views/Area.vue')
}

const info = {
  path: '/info',
  name: 'Info',
  component: () => import(/* webpackChunkName: "info" */ '../views/Info.vue')
}

const galleries = {
  path: '/gallery',
  name: 'Galleries',
  component: () => import(/* webpackChunkName: "galleries" */ '../views/Galleries.vue')
}

const gallery = {
  path: '/gallery/:slug',
  name: 'Gallery',
  component: () => import(/* webpackChunkName: "gallery" */ '../views/Gallery.vue')
}

const page = {
  path: '/:slug',
  name: 'Page',
  component: () => import(/* webpackChunkName: "page" */ '../views/Page.vue')
}

const routes = [
  home,
  lineup,
  digital,
  areas,
  area,
  info,
  galleries,
  gallery,
  page
]

const router = new VueRouter({
  mode: 'history',
  linkExactActiveClass: 'is-exact',
  linkActiveClass: 'is-active',
  base: process.env.NODE_ENV === 'production' ? '/' : process.env.BASE_URL,
  routes,
  scrollBehavior(to, _from, savedPosition) {
    if (to.name === 'home') {
      return { x: 0, y: 0 }
    } else if (savedPosition) {
      return savedPosition
    } else {
      return { x: 0, y: 0 }
    }
  }
})

export default router
