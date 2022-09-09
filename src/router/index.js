import { createRouter, createWebHashHistory } from 'vue-router'

const routes = [
  {
    path: '/order/:orderId',
    name: 'orderDetail',
    component: () => import(/* webpackChunkName: "orderdetail" */ '../views/order/orderdetail/orderDetail')
  },
  {
    path: '/orderConfirm/:shopId',
    name: 'orderConfirm',
    component: () => import(/* webpackChunkName: "orderconfirm" */ '../views/order/orderconfirm/orderConfirm')
  },
  {
    path: '/shop/:shopId',
    name: 'shop',
    component: () => import(/* webpackChunkName: "shop" */ '../views/shop/shop')
  },
  {
    path: '/',
    redirect: '/hotpot'
  },
  {
    path: '/home',
    name: 'Home',
    component: () => import(/* webpackChunkName: "home" */ '../views/home/Home'),
    children: [
      {
        path: '/hotpot',
        name: 'HotpPot',
        component: () => import(/* webpackChunkName: "hotpot" */ '../views/home/hotpot/hotpot')
      },
      {
        path: '/dynamic',
        name: 'dynamic',
        component: () => import(/* webpackChunkName: "dynamic" */ '../views/home/dynamic/dynamic')
      },
      {
        path: '/order',
        name: 'order',
        component: () => import(/* webpackChunkName: "order" */ '../views/home/order/order')
      }
    ]
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
