import Vue from 'vue'
import VueRouter, { isNavigationFailure, NavigationFailureType } from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    redirect: 'home'
  },
  {
    path: '/home',
    name: 'home',
    component: function () {
      return import(/* webpackChunkName: "Home" */ '@/views/Home')
    }
  },
  {
    path: '/search',
    name: 'search',
    component: function () {
      return import(/* webpackChunkName: "Search" */ '@/views/Search')
    }
  },
  {
    path: '/offer',
    name: 'offer',
    component: function () {
      return import(/* webpackChunkName: "Offers" */ '@/views/Offer')
    }
  },
  {
    path: '/notification',
    name: 'notification',
    component: function () {
      return import(/* webpackChunkName: "Notification" */ '@/views/Notification')
    }
  },
  {
    path: '/category/:id',
    name: 'category',
    component: function () {
      return import(/* webpackChunkName: "Category" */ '@/views/Category')
    }
  },
  {
    path: '/login',
    name: 'login',
    component: function () {
      return import(/* webpackChunkName: "Login" */ '@/views/auth/Login')
    }
  },
  {
    path: '/register',
    name: 'register',
    component: function () {
      return import(/* webpackChunkName: "Register" */ '@/views/auth/Register')
    }
  },
  {
    path: '/cart',
    name: 'cart',
    component: function () {
      return import(/* webpackChunkName: "Cart" */ '@/views/Cart')
    }
  },
  {
    path: '/order',
    name: 'order',
    component: function () {
      return import(/* webpackChunkName: "Cart" */ '@/views/Order')
    }
  },
  {
    path: '/fill-profile',
    name: 'fill-profile',
    component: function () {
      return import(/* webpackChunkName: "FillProfile " */ '@/views/FillProfile')
    }
  },
  {
    path: '/product/:id',
    name: 'product',
    component: function () {
      return import(/* webpackChunkName: "Product" */ '@/views/Product')
    }
  },
  {
    path: '/checkout',
    name: 'checkout',
    component: function () {
      return import(/* webpackChunkName: "Checkout" */ '@/views/Checkout')
    }
  },
  {
    path: '/order',
    name: 'order',
    component: function () {
      return import(/* webpackChunkName: "Order" */ '@/views/Order')
    }
  },
  {
    path: '/profile',
    name: 'profile',
    component: function () {
      return import(/* webpackChunkName: "Profile" */ '@/views/Profile')
    }
  },
]

const router = new VueRouter({
  mode: 'history',
  routes
});

router.beforeEach((to, from, next) => {
  // Chuyển đến trang login nếu chưa được login
  const publicPages = ['login', 'register', 'home', 'search', 'offer', 'notification', 'category'];
  const authRequired = !publicPages.includes(to.name);
  const loggedIn = localStorage.getItem('user');

  if (authRequired && !loggedIn) {
    return next('/login');
  }

  next();
})

export default router
