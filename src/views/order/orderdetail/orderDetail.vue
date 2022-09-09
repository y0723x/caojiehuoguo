<template>
    <template v-if="orderId > 0">
      <div
    class="mask"
    v-show="mask.showMask"
    @click="handleMask(mask.maskMessage)"
  >
    <div class="mask_body">
      <div class="mask_body_title">{{ mask.maskMessage }}</div>
      <div class="mask_body_choice">
        <div class="mask_body_choice_cancel" @click="handleChoice('取消')">
          取消
        </div>
        <div class="mask_body_choice_confirm" @click="handleChoice('确认')">
          确认
        </div>
      </div>
    </div>
  </div>
  <div class="wrapper">
    <!-- header -->
    <div class="order_detail_header">
      <div class="order_detail_header_body">
        <div
          class="order_detail_header_body_back iconfont"
          @click="handleBack(shop, order)"
        >
          &#xe662;
        </div>
        <div
          class="order_detail_header_body_title"
          v-html="
            order.status === '0'
              ? '订单未付款'
              : order.status === '1'
              ? '订单已付款'
              : order.status === '2'
              ? '订单已取消'
              : '订单已退款'
          "
        ></div>
      </div>
      <!-- 根据order.status来显示不同内容 0:未付款 1:已付款 2:已取消 3:已退款  -->
      <div class="order_detail_header_info">
        <template v-if="order.status === '0'">
          <div class="order_detail_header_info_arrive">预计今天11:30送到</div>
          <div class="order_detail_header_info_distribution">商家配送</div>
          <div class="order_detail_header_info_operation">
            <div class="order_detail_header_info_operation_pay">
              <div class="order_detail_header_info_operation_pay_icon iconfont">
                &#xe7ac;
              </div>
              <div
                class="order_detail_header_info_operation_pay_text"
                @click="handleMask('确认支付吗？')"
              >
                去支付
              </div>
            </div>
            <div class="order_detail_header_info_operation_update">
              <div
                class="order_detail_header_info_operation_update_icon iconfont"
              >
                &#xe8cf;
              </div>
              <div class="order_detail_header_info_operation_update_text">
                改订单信息
              </div>
            </div>
            <div class="order_detail_header_info_operation_talk">
              <div
                class="order_detail_header_info_operation_talk_icon iconfont"
              >
                &#xec3b;
              </div>
              <div class="order_detail_header_info_operation_talk_text">
                联系商家
              </div>
            </div>
            <div class="order_detail_header_info_operation_cancel">
              <div
                class="order_detail_header_info_operation_cancel_icon iconfont"
              >
                &#xe8ae;
              </div>
              <div
                class="order_detail_header_info_operation_cancel_text"
                @click="handleMask('确认取消订单吗？')"
              >
                取消订单
              </div>
            </div>
          </div>
        </template>
        <template v-else>
          <div 
            class="order_detail_header_info_title"
            v-html="
              order.status === '1'
                ? '订单已送达'
                : order.status === '2'
                ? '你取消了订单'
                : '已退款'
            "
          ></div>
          <div class="order_detail_header_info_other">其他服务</div>
          <div class="order_detail_header_info_operation">
            <div class="order_detail_header_info_operation_talk">
              <div
                class="order_detail_header_info_operation_talk_icon iconfont"
              >
                &#xe88b;
              </div>
              <div class="order_detail_header_info_operation_talk_text">
                电话商家
              </div>
            </div>
            <div class="order_detail_header_info_operation_again">
              <div
                class="order_detail_header_info_operation_again_icon iconfont"
              >
                &#xe8ae;
              </div>
              <div 
                class="order_detail_header_info_operation_again_text"
                @click="toShop(shop.shopId)"
              >
                再来一单
              </div>
            </div>
          </div>
        </template>
      </div>
    </div>
    <!-- orderGoodsList -->
    <div class="order_detail_container">
      <div class="order_detail_container_productList">
        <div 
          class="order_detail_container_productList_title"
          @click="toShop(shop.shopId)"
        >
          <div class="order_detail_container_productList_title_text">
            {{ shop.shopName }}
          </div>
          <div class="order_detail_container_productList_title_icon iconfont">
            &#xe602;
          </div>
        </div>
        <div
          class="order_detail_container_productList_item"
          v-for="(orderGoods, index) in orderGoodsList.values"
          :key="index"
        >
          <img
            :src="orderGoods.goodsUrl"
            class="order_detail_container_productList_item_img"
          />
          <div class="order_detail_container_productList_item_body">
            <div class="order_detail_container_productList_item_body_name">
              {{ orderGoods.goodsName }}
            </div>
            <div class="order_detail_container_productList_item_body_count">
              ×{{ 1 }}
            </div>
            <div class="order_detail_container_productList_item_body_price">
              ￥{{ orderGoods.goodsCount * orderGoods.goodsPrice }}
            </div>
          </div>
        </div>
        <div class="order_detail_container_productList_total">
          总计￥{{ order.totalPrice }}
        </div>
        <div class="order_detail_container_productList_other">
          <div class="order_detail_container_productList_other_address">
            <div class="order_detail_container_productList_other_address_pre">
              收货地址
            </div>
            <div class="order_detail_container_productList_other_address_show">
              杭电信工
            </div>
          </div>
          <div class="order_detail_container_productList_other_orderNo">
            <div class="order_detail_container_productList_other_orderNo_pre">
              订单号
            </div>
            <div class="order_detail_container_productList_other_orderNo_show">
              10086
            </div>
          </div>
          <div class="order_detail_container_productList_other_arrive">
            <div class="order_detail_container_productList_other_arrive_pre">
              送达时间
            </div>
            <div class="order_detail_container_productList_other_arrive_show">
              尽快送达[11:30]
            </div>
          </div>
          <div class="order_detail_container_productList_other_distribution">
            <div
              class="order_detail_container_productList_other_distribution_pre"
            >
              配送方式
            </div>
            <div
              class="order_detail_container_productList_other_distribution_show"
            >
              商家配送
            </div>
          </div>
        </div>
      </div>
      <div class="order_detail_container_activity"></div>
      <div class="order_detail_container_command"></div>
      <div class="order_detail_container_other"></div>
    </div>
  </div>
    </template>
    <template v-else>
      <div 
        class="order_no_detail"
        @click="getBack()"
      >
        <div class="order_no_detail_header">
          <div class="order_no_detail_header_back iconfont">&#xe662;</div>
          <div class="order_no_detail_header_text">我的订单</div>
        </div>
        <div class="order_no_detail_container">
          <div class="order_no_detail_container_img">
            <div class="order_no_detail_container_img_icon iconfont">&#xe6ac;</div>
          </div>
          <div class="order_no_detail_container_text">暂无订单</div>
        </div>
      </div>
    </template>
</template>

<script>
import { useRoute, useRouter } from 'vue-router'
import { reactive, ref, onMounted } from 'vue'
import { getRequest, putRequest } from '@/utils/request'
// getdata
const useData = () => {
    const route = useRoute()
    // 获取orderId
    const orderId = route.params.orderId
    // 获取tableId
    const tableId = ref()
    // shop
    const shop = ref({})
    // orderGoodsList
    const orderGoodsList = reactive([])
    // order
    const order = ref({})
    

    onMounted(() => {
      if(orderId > 0){
        getData(orderId)
      }
    })

    const getData = async (orderId) => {
      const result = await getRequest('/order/getOrderDetail.php', {
        orderId: orderId
      })
      // console.log(result)
      if(result?.code && result?.code === 200){
        order.value = result?.object
        shop.value = result?.object?.shop
        orderGoodsList.values = result?.object?.goodsList
        tableId.value = result?.object?.tableId
      }
    }

    return { shop, orderGoodsList, order, tableId }
}

// 支付和取消订单逻辑
const usePayOrCancelEffect = (tableId) => {
  const router = useRouter();
  // 获取orderId
  const route = useRoute();
  const orderId = route.params.orderId;

  // mask参数
  const mask = ref({
    showMask: false,
    maskMessage: "",
  });

  // mask的显示与隐藏
  const handleMask = (message) => {
    mask.value.showMask = !mask.value.showMask;
    mask.value.maskMessage = message;
  };

  // 改变order.status的状态
  const handleChoice = (message) => {
    if (mask.value.maskMessage === "确认支付吗？") {
      if (message === "取消") {
      } else {
        getPayOrCancelOrder(orderId, 'pay', tableId.value)
        console.log("成功支付")
      }
    } else {
      if (message === "取消") {
      } else {
        getPayOrCancelOrder(orderId, 'cancel', tableId.value)
        console.log("成功取消订单")
      }
    }
  };

// 去支付或者取消订单
  const getPayOrCancelOrder = async(orderId, choice, tableId) => {
      const result = await getRequest('/order/getPayOrCancelOrder.php', {
          orderId: orderId,
          choice: choice,
          tableId: tableId
      })
      console.log(result)
      if(result?.code && result?.code === 200){
        router.push(`/order/${orderId}`)
      }
      
  }


  return { handleChoice, mask, handleMask };
}



// 跳转逻辑
const toEffect = () => {
    const route = useRoute()
    const router = useRouter();

    // 获取from
    const from = route.query.from

    // 无数据时
    const getBack = () => {
      router.back()
    }

    // 有数据时
    const handleBack = (shop, order) => {
        if (from === 'orderConfirm' || from === 'shop') {
            const orderId = route.params.orderId
            router.push({
              path: `/shop/${shop.shopId}`, 
              query: {
                tableId: order.tableId,
                orderId: orderId
            }})
        } else {
            router.push(`/order`)
        }
    };

    return { handleBack, getBack  };
}

export default {
    name: 'orderDetail',
    setup() {
        // 获取orderId
        const route = useRoute()
        const orderId = route.params.orderId
        // getData
        const { shop, orderGoodsList, order, tableId } = useData()
        // 支付和取消订单逻辑
        const { handleChoice, mask, handleMask } = usePayOrCancelEffect(tableId)
        // 跳转逻辑
        const { handleBack, getBack } = toEffect(shop, order)

        return { shop, orderGoodsList, order, handleChoice, mask, handleMask,
         handleBack, getBack, orderId }
    },
}
</script>

<style lang="scss" scoped>
.mask {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgb(0, 0, 0, 0.5);
  z-index: 1;
  text-align: center;
  &_body {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 2;
    height: 0.8rem;
    width: 2rem;
    background: #fff;
    border-radius: 0.1rem;
    padding: 0.1rem;
    &_title {
      font-size: 0.2rem;
      font-weight: bolder;
      margin-bottom: 0.1rem;
    }
    &_choice {
      display: flex;
      margin-top: 0.2rem;
      position: relative;
      &_cancel {
        border: 0.01rem solid #000;
        border-radius: 0.1rem;
        width: 0.5rem;
        position: absolute;
        left: 0.1rem;
      }
      &_confirm {
        border: 0.01rem solid #0091ff;
        border-radius: 0.1rem;
        width: 0.5rem;
        position: absolute;
        right: 0.1rem;
      }
    }
  }
}

.wrapper {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

.order_detail_header {
  position: relative;
  height: 2.5rem;
  background-image: linear-gradient(0deg, rgba(0, 145, 255, 0) 4%, #0091ff 50%);
  &_body {
    display: flex;
    position: absolute;
    top: 0.4rem;
    left: 0;
    right: 0;
    color: #fff;
    &_back {
      font-size: 0.26rem;
      margin-left: 0.1rem;
      transform:rotate(180deg);
    }
    &_title {
      flex: 2;
      font-size: 0.18rem;
      text-align: center;
      margin-right: 0.3rem;
    }
  }
  &_info {
    background: #fff;
    position: absolute;
    top: 1rem;
    left: 0.1rem;
    right: 0.1rem;
    height: 1.3rem;
    border-radius: 0.1rem;
    border: 0.01rem solid rgb(231, 227, 227);
    padding: 0.1rem;
    &_title{
      font-size:.2rem;
      font-weight: bolder;
    }
    &_other{
      font-weight: bolder;
      height:.5rem;
      border-bottom:.01rem solid #f2ecec;
      margin-top:.1rem;
    }
    &_arrive {
      font-size: 0.2rem;
      margin-bottom: 0.1rem;
    }
    &_distribution {
      color: #737373;
      font-size: 0.14rem;
      height: 0.4rem;
      border-bottom: 0.01rem solid #f2ecec;
    }
    &_operation {
      display: flex;
      position: absolute;
      bottom: 0.1rem;
      left: 0;
      right: 0;
      &_pay {
        flex: 1;
        text-align: center;
        color: #0091ff;
      }
      &_update {
        flex: 1;
        text-align: center;
        color: #0091ff;
      }
      &_talk {
        flex: 1;
        text-align: center;
      }
      &_cancel {
        flex: 1;
        text-align: center;
      }
      &_again {
        flex: 1;
        text-align: center;
      }
    }
  }
}

.order_detail_container {
  overflow-y: scroll;
  position: absolute;
  bottom: 0;
  top: 2.55rem;
  left: 0;
  right: 0;
  background: #f2ecec;
  padding: 0 0.1rem;
  border-radius: 0.1rem 0.1rem;
  &_productList {
    position: relative;
    background: #fff;
    border-radius: 0.1rem;
    margin-top: 0.2rem;
    padding: 0.1rem;
    &_title {
      font-weight: bolder;
      margin-left: 0.02rem;
      display: flex;
      &_text {
        margin-right: 0.1rem;
      }
      &_icon {
        color: #737373;
        transform: rotate(180deg);
      }
    }
    &_item {
      display: flex;
      margin: 0.1rem 0;
      &_img {
        height: 0.5rem;
        width: 0.5rem;
        border-radius: 0.1rem;
        margin-right: 0.05rem;
      }
      &_body {
        flex: 1;
        position: relative;
        &_count {
          color: #737373;
          position: absolute;
          bottom: 0;
          left: 0;
        }
        &_price {
          position: absolute;
          right: 0;
          top: 0;
        }
      }
    }
    &_total {
      text-align: right;
      font-size: 0.15rem;
      font-weight: bolder;
      margin: 0.1rem 0;
    }
    &_other {
      border-top: 0.01rem solid #f2ecec;
      padding-top: 0.1rem;
      &_address {
        position: relative;
        display: flex;
        margin-bottom: 0.3rem;
        &_pre {
          position: absolute;
          top: 0;
          left: 0;
        }
        &_show {
          position: absolute;
          top: 0;
          right: 0;
        }
      }
      &_orderNo {
        position: relative;
        display: flex;
        margin-bottom: 0.3rem;
        &_pre {
          position: absolute;
          top: 0;
          left: 0;
        }
        &_show {
          position: absolute;
          top: 0;
          right: 0;
        }
      }
      &_arrive {
        position: relative;
        display: flex;
        margin-bottom: 0.3rem;
        &_pre {
          position: absolute;
          top: 0;
          left: 0;
        }
        &_show {
          position: absolute;
          top: 0;
          right: 0;
        }
      }
      &_distribution {
        position: relative;
        display: flex;
        margin-bottom: 0.3rem;
        &_pre {
          position: absolute;
          top: 0;
          left: 0;
        }
        &_show {
          position: absolute;
          top: 0;
          right: 0;
        }
      }
    }
  }
}

.order_no_detail{
  position:absolute;
  top:0;
  left:0;
  right:0;
  bottom:0;
  background:#f2ecec;
  border-radius:.1rem;
  text-align:center;
  &_header{
    position:relative;
    width:100%;
    height:.6rem;
    display:flex;
    &_back{
      position:absolute;
      left:.1rem;
      transform:rotate(180deg);
      top:.2rem;
      color:#000;
      font-size:.23rem;
    }
    &_text{
      position:absolute;
      left:40%;
      top:.15rem;
      color:#737373;
      font-size:.18rem;
      font-weight:bolder;
    }
  }
  &_container{
    position:relative;
    height:100%;
    width:100%;
    &_img{
      position:absolute;
      top:30%;
      left:50%;
      transform:translate(-50%,-50%);
      &_icon{
        font-size:1.4rem;
      }
    }
    &_text{
      position:absolute;
      top:45%;
      left:50%;
      transform:translate(-50%,-50%);
      color:#737373;
      font-size:.2rem;
    }
  }
}
</style>