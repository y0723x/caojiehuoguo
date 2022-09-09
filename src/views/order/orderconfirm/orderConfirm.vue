<template>
    <div class="wrapper">
    <!-- header -->
    <div class="order_confirm_header">
      <div class="order_confirm_header_body">
        <div 
            class="order_confirm_header_body_back iconfont" 
            @click="handleBack()"
        >
          &#xe662;
        </div>
        <div class="order_confirm_header_body_title">确认订单</div>
      </div>
      <!-- address -->
      <div class="order_confirm_header_info">
        <div class="order_confirm_header_info_address">
            <div class="order_confirm_header_info_address_text">请选择收获地址</div>
            <div class="order_confirm_header_info_address_icon iconfont">&#xe602;</div>
        </div>
        <div class="order_confirm_header_info_time">
            <div class="order_confirm_header_info_time_text">立即送出</div>
            <div class="order_confirm_header_info_time_body">
                <span class="order_confirm_header_info_time_body_show">11:37-11.52送到</span>
                <span class="order_confirm_header_info_time_body_icon iconfont">&#xe602;</span>
            </div>
        </div>
        <div class="order_confirm_header_info_paymethod">
            <div class="order_confirm_header_info_paymethod_text">支付方式</div>
            <div class="order_confirm_header_info_paymethod_body">
                <span class="order_confirm_header_info_paymethod_body_show">支付宝</span>
                <span class="order_confirm_header_info_paymethod_body_icon iconfont">&#xe602;</span>
            </div>
        </div>
      </div>
    </div>
    <!-- orderList -->
    <div class="order_confirm_container">
        <div class="order_confirm_container_productList">
            <div class="order_confirm_container_productList_title">{{ shopName }}</div>
            <div 
                class="order_confirm_container_productList_item"
                v-for="(product, index) in productList"
                :key="index"
            >
                <img 
                    :src="product.goodsUrl"
                    class="order_confirm_container_productList_item_img"
                >
                <div class="order_confirm_container_productList_item_body">
                    <div class="order_confirm_container_productList_item_body_name">{{ product.goodsName }}</div>
                    <div class="order_confirm_container_productList_item_body_count">×{{ product.count }}</div>
                    <div class="order_confirm_container_productList_item_body_price">￥{{ product.goodsPrice }}</div>
                </div>
            </div>
        </div>
        <div class="order_confirm_container_activity"></div>
        <div class="order_confirm_container_command"></div>
        <div class="order_confirm_container_other"></div>
    </div>
    <!-- bottom -->
    <div class="order_confirm_bottom">
      <div class="order_confirm_bottom_price">合计￥{{ total.totalPrice }}</div>
      <div
        class="order_confirm_bottom_confirm"
        @click="getOrderDetail(shopId, total, goodsList)"
      >提交订单</div>
    </div>
  </div>
</template>

<script>
import { useCartEffect } from '@/effect/cartEffect'
import { useRoute, useRouter } from 'vue-router'
import { reactive } from 'vue'
import { getRequest, postRequest } from '@/utils/request'
// 跳转逻辑
const toEffect = () => {
    const router = useRouter()

    // getOrderDetail
    const getOrderDetail = async (shopId, total, goodsList) => {
        const result = await getRequest('/order/getSubmitOrder.php', {
            shopId: shopId,
            total: total,
            goodsList: goodsList
        })
        console.log(result)
        if(result?.code && result?.code === 200){
            const orderId = result?.object
            router.push({
                path: `/order/${orderId}`,
                query: {
                    from: 'orderConfirm'
                }
            })
        }
        
    }
    // 返回点餐
    const handleBack = () => {
        router.back()
    }
    return { handleBack, getOrderDetail }
}

// productList转化成数组形式
const useTransformEffect = (productList) => {
    let goodsList = []
    for(let i in productList.value){
        const product = productList.value[i]
        // console.log(product)
        goodsList.push(product)
    }

    return { goodsList }
}

export default {
    name: 'orderConfirm',
    setup() {
        const route = useRoute()
        // 获取shopId
        const shopId = route.params.shopId
        // cart逻辑
        const { productList, total, shopName } = useCartEffect(shopId)
        // productList转化成数组形式
        const { goodsList } = useTransformEffect(productList)
        // 跳转逻辑
        const { handleBack, getOrderDetail } = toEffect()

        return { productList, total, shopName, handleBack, getOrderDetail, 
        goodsList, shopId }
    },
}
</script>

<style lang="scss" scoped>
.wrapper{
    position:absolute;
    top:0;
    left: 0;
    right: 0;
    bottom: 0;
}

.order_confirm_header {
  position: relative;
  height: 2.5rem;
  background-image: linear-gradient(
    0deg,
    rgba(0, 145, 255, 0) 4%,
    #0091FF 50%
  );
  &_body {
    display: flex;
    position: absolute;
    top: 0.4rem;
    left: 0;
    right: 0;
    color: #fff;
    &_back {
      font-size: 0.26rem;
      margin-left:0.1rem;
      transform:rotate(180deg);
    }
    &_title{
      flex:2;
      font-size: 0.18rem;
      text-align:center;
      margin-right:.3rem;
    }
  }
  &_info {
    z-index:2;
    background: #fff;
    position: absolute;
    top: 1rem;
    left: 0.1rem;
    right: 0.1rem;
    height: 1.3rem;
    border-radius: 0.1rem;
    border:.01rem solid rgb(231, 227, 227);
    padding: 0.1rem;
    &_address{
        position:relative;
        display: flex;
        margin:.08rem 0 .15rem 0;
        &_text{
            font-size:.2rem;
            font-weight: bolder;
        }
        &_icon{
            color:#737373;
            position:absolute;
            top:.08rem;
            right:0;
            transform: rotate(180deg);
        }
    }
    &_time{
        position:relative;
        display: flex;
        margin-bottom: .15rem;
        &_text{
            font-size:.12rem;
        }
        &_body{
            color:#737373;
            position:absolute;
            right:0;
            &_show{
                color:#0082d4;
            }
            &_icon{
                display:inline-block;
                transform: rotate(180deg);
                margin-left:.06rem;
            }
        }
    }
    &_paymethod{
        position:relative;
        display: flex;
        margin-bottom: .15rem;
        &_text{
            font-size:.12rem;
        }
        &_body{
            color:#737373;
            position:absolute;
            right:0;
            &_show{
                color:#0082d4;
            }
            &_icon{
                display:inline-block;
                transform: rotate(180deg);
                margin-left:.06rem;
            }
        }
    }
  }
}

.order_confirm_container{
    overflow-y: scroll;
    position:absolute;
    bottom:.6rem;
    top:2.55rem;
    left:0;
    right:0;
    background:#f2ecec;
    padding:0 .1rem;
    border-radius: .1rem .1rem;
    &_productList{
        position:relative;
        background:#fff;
        border-radius:.1rem;
        margin-top:.2rem;
        padding:.1rem;
        &_title{
            color:#737373;
            margin-left:.02rem;
        }
        &_item{
            display:flex;
            margin:.1rem 0;
            &_img{
                height:.5rem;
                width:.5rem;
                border-radius:.1rem;
                margin-right:.05rem;
            }
            &_body{
                flex:1;
                position:relative;
                &_count{
                    color:#737373;
                    position: absolute;
                    bottom:0;
                    left:0;
                }
                &_price{
                    position:absolute;
                    right:0;
                    top:0;
                }
            }
        }
    }
}

.order_confirm_bottom {
  position: fixed;
  left: 0;
  right: 0;
  bottom: 0;
  height: 0.6rem;
  background: #fff;
  border-top: 0.01rem solid #eae4e4;
  display: flex;
  &_price {
    margin: 0.02rem 0;
    line-height: 0.6rem;
    font-size: 0.2rem;
  }
  &_confirm {
    position: absolute;
    top: 0.2rem;
    right: 0.1rem;
    height: 0.3rem;
    width: 0.8rem;
    border: 0.01rem solid #0082d4;
    border-radius: 0.2rem;
    color: #fff;
    background: #0082d4;
    text-align: center;
    line-height: 0.3rem;
  }
}
</style>