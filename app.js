Vue.component('layout', httpVueLoader('vue/layout.vue'));

const routes = [
  { path: '/', component: httpVueLoader('vue/reported.vue') }
]

const router = new VueRouter({
  routes
})

const app = new Vue({
  router,
  render: h => h('layout')
}).$mount('#app')
