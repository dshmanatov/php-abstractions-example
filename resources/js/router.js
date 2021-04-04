import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/Home';
import Resources from './pages/Resources';
import Workshops from './pages/Workshops';
import Recipes from './pages/Recipes';

Vue.use(VueRouter);

const routes = [{
  path: '/',
  component: Home,
  meta: {title: 'Обзор'},
}, {
  path: '/resources',
  component: Resources,
  meta: {title: 'Ресурсы'},
}, {
  path: '/workshops',
  component: Workshops,
  meta: {title: 'Фабрики'},
}, {
  path: '/recipes',
  component: Recipes,
  meta: {title: 'Рецепты'},
},];

export default new VueRouter({
  linkActiveClass: 'active',
  routes
});


