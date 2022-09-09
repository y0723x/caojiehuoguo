import { useStore } from 'vuex'
import { computed } from 'vue'
export const useCartEffect = (shopId) => {
    const store = useStore()
    const shopName = store.state.cart[shopId]?.shopName || ''
      // 更改cart
      const changeCartItemInfo = (shopId, shopName, goods, num) => {
          store.commit('changeCartItemInfo',{ shopId, shopName, goods, num })
      }
      
      // 获取productList
      const productList = computed(() => {
          const products = store.state.cart[shopId]?.goodsList || []
          const notEmptyProduct = {}
          for(let i in products){
              const product = products[i]
              if (product.count > 0) {
                  notEmptyProduct[i] = product
              }
          }
          return notEmptyProduct
      })

      // 购物车产品总价格、购物车中产品数量>0的总数
        const total = computed(() => {
            // let total = 0
            const result = {
            totalCount: 0,
            totalPrice: 0
            }
            const productList = store.state.cart[shopId]?.goodsList || []
            for (const i in productList) {
                const product = productList[i]
                if (product.count > 0) {
                    result.totalCount += 1
                    result.totalPrice += (product.count * product.goodsPrice)
                }
            }
            return result
        })

        // 清空购物车
        const clearCart = (shopId) => {
            store.commit('clearCart', {
                shopId
            })
        }

        return { changeCartItemInfo, productList, clearCart, total, shopName }
}