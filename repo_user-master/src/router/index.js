import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [  
  {
    path : '/',
    redirect: 'home'
  },
  {
    path: '/home',
    name: 'home',
    component: function () {
      return import(/* webpackChunkName: "Home" */ '@/views/menu/home/Index')
    }
  },
  {
    path: '/product-detail',
    name: 'product-detail',
    component: function () {
      return import(/* webpackChunkName: "Product detail" */ '@/views/product/Detail')
    }
  },
  {
    path: '/search',
    name: 'search',
    component: function () {
      return import(/* webpackChunkName: "Search" */ '@/views/menu/search/Index')
    }
  },
  {
    path: '/lets-in',
    name: 'lets-in',
    component: function () {
      return import(/* webpackChunkName: "LetsIn" */ '@/views/account/LetsIn')
    }
  },
  {
    path: '/sign-in',
    name: 'sign-in',
    component: function () {
      return import(/* webpackChunkName: "SignIn" */ '@/views/account/SignIn')
    }
  },
  {
    path: '/sign-up',
    name: 'sign-up',
    component: function () {
      return import(/* webpackChunkName: "SignUp" */ '@/views/account/SignUp')
    }
  },
  {
    path: '/fill-profile',
    name: 'fill-profile',
    component: function () {
      return import(/* webpackChunkName: "FillProfile" */ '@/views/account/FillProfile')
    }
  },
  {
    path: '/new-pin',
    name: 'new-pin',
    component: function () {
      return import(/* webpackChunkName: "NewPin" */ '@/views/account/NewPin')
    }
  },
  {
    path: '/forgot-password',
    name: 'forgot-password',
    component: function () {
      return import(/* webpackChunkName: "ForgotPassword" */ '@/views/account/ForgotPassword')
    }
  },
  {
    path: '/verify-password',
    name: 'verify-password',
    component: function () {
      return import(/* webpackChunkName: "VerifyPassword" */ '@/views/account/VerifyPassword')
    }
  },
  {
    path: '/new-password',
    name: 'new-password',
    component: function () {
      return import(/* webpackChunkName: "NewPassword" */ '@/views/account/ResetPassword')
    }
  },
  {
    path: '/type',
    name: 'type',
    component: function () {
      return import(/* webpackChunkName: "ShoesType" */ '@/views/menu/shoes_type/Index')
    }
  },
  {
    path: '/notifications',
    name: 'notifications',
    component: function () {
      return import(/* webpackChunkName: "Notifications" */ '@/views/menu/notification/Index')
    }
  },
  {
    path: '/wishlist',
    name: 'wishlist',
    component: function () {
      return import(/* webpackChunkName: "Wishlist" */ '@/views/menu/wishlist/Index')
    }
  },
  {
    path: '/popular',
    name: 'popular',
    component: function () {
      return import(/* webpackChunkName: "Popular" */ '@/views/menu/popular/Index')
    }
  },
  {
    path: '/offers',
    name: 'offers',
    component: function () {
      return import(/* webpackChunkName: "Offers" */ '@/views/menu/special_offer/Index')
    }
  },
  {
    path: '/cart',
    name: 'cart',
    component: function () {
      return import(/* webpackChunkName: "Cart" */ '@/views/cart/Index')
    }
  },
  {
    path: '/checkout',
    name: 'checkout',
    component: function () {
      return import(/* webpackChunkName: "Checkout" */ '@/views/checkout/Index')
    }
  },
  {
    path: '/shipping_address',
    name: 'shipping_address',
    component: function () {
      return import(/* webpackChunkName: "ShippingAddress" */ '@/views/checkout/ShipingAdress')
    }
  },
  {
    path: '/choose_shipping',
    name: 'choose_shipping',
    component: function () {
      return import(/* webpackChunkName: "ChooseShiping" */ '@/views/checkout/ChooseShiping')
    }
  },
  {
    path: '/payment_methods',
    name: 'payment_methods',
    component: function () {
      return import(/* webpackChunkName: "PaymentMethods" */ '@/views/checkout/PaymentMethods')
    }
  },
  {
    path: '/confirm_PIN',
    name: 'confirm_PIN',
    component: function () {
      return import(/* webpackChunkName: "ConfirmPin" */ '@/views/checkout/ConfirmPin')
    }
  },
  {
    path: '/setting',
    name: 'setting',
    component: function () {
      return import(/* webpackChunkName: "SettingProfile" */ '@/views/setting/Index')
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  routes
})

export default router
