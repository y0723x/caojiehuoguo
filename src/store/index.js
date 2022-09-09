import { createStore } from 'vuex'

export default createStore({
  state: {
    /**
     * cart: [
     *    shop:{
     *      shopName: '',
     *      goodsList: [
     *        goods
     *      ]
     *    }
     * ]
     */
    cart:[]
  },
  getters: {
  },
  mutations: {
    changeCartItemInfo(state, payload){
      const { shopId, shopName, goods, num } = payload

      const shop = state.cart[shopId] || {
        shopName: shopName,
        goodsList: []
      }

      let product = shop.goodsList[goods.goodsId]
      if(!product){
        product = goods
        product.count = 0
      }

      product.count += num
      if (product.count < 0) {
        product.count = 0
      }
      shop.goodsList[goods.goodsId] = product

      state.cart[shopId] = shop
    },
    clearCart(state, payload){
      const { shopId } = payload
      state.cart[shopId].goodsList = []
    }
  },
  actions: {
  },
  modules: {
  }
})
