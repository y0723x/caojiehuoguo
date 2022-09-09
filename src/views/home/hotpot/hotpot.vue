<template>
    <div class="hotpot">
        <!-- header -->
        <div class="hotpot_header">
            <img 
                :src="shop.shopUrl"
                class="hotpot_header_img"
            >
            <div class="hotpot_header_body">
                <img 
                    :src="shop.shopUrl"
                    class="hotpot_header_body_face"
                >
                <div class="hotpot_header_body_info">
                    <div class="hotpot_header_body_info_name">{{ shop.shopName }}</div>
                    <div class="hotpot_header_body_info_intro">{{ shop.shopIntro }}</div>
                    <div class="hotpot_header_body_info_pay">
                        <div class="hotpot_header_body_info_pay_icon iconfont">&#xe642;</div>
                        <div class="hotpot_header_body_info_pay_text">付款</div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- container -->
        <div class="hotpot_container">
            <div class="hotpot_container_header">
                <div 
                    class="hotpot_container_header_body"
                    v-for="(header, index) in headerList"
                    :key="index"
                >
                    <div 
                        :class="{'hotpot_container_header_body_text-active': activeIndex === index,
                            'hotpot_container_header_body_text': true
                        }"
                        @click="changeTableList(index, header.status)"
                    >{{ header.text }}</div>
                    <div 
                        :class="{'hotpot_container_header_body_underline': activeIndex === index }"
                    ></div>
                </div>
            </div>
            <div class="hotpot_container_content">
                <div 
                    :class="{'hotpot_container_content_item': true,
                        'hotpot_container_content_item-active': table.status === '1'
                    }"
                    v-for="(table, index) in tables.values"
                    :key="index"
                    @click="toViewOrPlaceOrder(table.status, table.shopId,
                     table.id, table.orderId)"
                >{{ table.tableName }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { getRequest } from '@/utils/request'
// getData
const useGetDataEffect = () => {
    // 下标
    const activeIndex = ref(0)
    // shop
    const shop = ref({})

    // headerList
    const headerList = reactive([
        {
            text: '全部',
            status: -1
        },
        {
            text: '空闲',
            status: 0
        },
        {
            text: '在使用',
            status: 1
        }
    ])

    // headerStatus
    const headerStatus = ref(-1)

    // tableList
    const tableList = reactive([])

    // tables
    const tables = reactive([])

    const changeTableList = (index, hs) => {
        activeIndex.value = index
        headerStatus.value = hs
        // console.log(headerStatus.value)
        tables.values = []
        if (headerStatus.value != -1) {
            tableList.values.forEach(table => {
                if (table.status === String(headerStatus.value)) {
                    tables.values.push(table)
                }
            });
        } else {
            tables.values = tableList.values
        }
    }

    onMounted(() => {
        getData()
    })

    const getData = async() => {
        const result = await getRequest('/table/getTableList.php')
        // console.log(result)
        if (result?.code && result?.code === 200) {
            tableList.values = result?.object
            tables.values = result?.object
            shop.value = result?.object[0]?.shop
        }
    }

    return { shop, changeTableList, activeIndex,
    headerList, tableList, tables }
}

// 跳转逻辑
const toEffect = () => {
    const router = useRouter()
    const toViewOrPlaceOrder = (status, shopId, tableId, orderId) => {
        /**
         * 1.根据桌子状态来判断跳转页面
         * 0:跳转下单界面`/shop/${shopId}`
         * 1:跳转至订单详情界面`/order/${orderId}`
         */
        if (status === '0') {
            sessionStorage.setItem('tableId', tableId)
            router.push({
                path: `/shop/${shopId}`,
                query: {
                    from: '/'
                }
            })
        } else {
            router.push({
                path: `/order/${orderId}`,
                query: {
                    shopId, tableId
                }
            })
        }
    }

    return { toViewOrPlaceOrder }
}
export default {
    name: 'HotPot',
    setup() {
        // getGoodsWithCateByShopId逻辑
        const { shop, changeTableList, tableList, tables,
         activeIndex, headerList } = useGetDataEffect()
        
        // 跳转逻辑
        const { toViewOrPlaceOrder } = toEffect()

         return { shop, changeTableList, tableList, tables,
          activeIndex, headerList, toViewOrPlaceOrder }
    },
}
</script>

<style lang="scss" scoped>
.hotpot{
    position:absolute;
    top:0;
    right:0;
    left:0;
    bottom:0;
    &_header{
    position:absolute;
    left:0;
    right:0;
    top:0;
    height:2rem;
    background:red;
    &_img{
        height:100%;
        width:100%;
        filter: blur(.06rem);
    }
    &_body{
        display:flex;
        position:absolute;
        top:.6rem;
        left:.25rem;
        right:.25rem;
        &_face{
            height:.7rem;
            width:.7rem;
            border-radius:50%;
            margin-right:.15rem;
        }
        &_info{
            position:relative;
            flex:1;
            color:#fff;
            &_name{
                font-size:.2rem;
                margin-bottom:.1rem;
            }
            &_intro{
                font-size:.1rem;
            }
            &_pay{
                position:absolute;
                right:0;
                top:0;
                text-align: center;
                border-left:.01rem solid #e1dce1;
                width:.7rem;
                &_icon{
                    font-size:.2rem;
                }
                &_text{
                    font-size:.1rem;
                }
            }
        }
    }
}

    &_container{
        overflow-x:hidden;
        overflow-y:scroll;
        position:absolute;
        top:1.8rem;
        right:0;
        left:0;
        bottom:.8rem;
        border-radius:.1rem .1rem;
        background:#fff;
        &_header{
            position:relative;
            display:flex;
            height:.6rem;
            width:100%;
            background:#ece1e1;
            border-radius:.1rem .1rem 0 0;
            &_body{
                height:.4rem;
                width:.6rem;
                margin:.1rem .2rem 0 .1rem;
                text-align: center;
                &_text{
                    font-size:.16rem;
                    &-active{
                        font-size:.2rem;
                    }
                }
                &_underline{
                    width:.15rem;
                    height:.03rem;
                    border:.01rem solid #36a7ee;
                    border-radius:.1rem;
                    background:#36a7ee;
                    margin:.05rem auto;
                }
            }
        }
        &_content{
            display: flex;
            width:100%;
            padding:.1rem .1rem 0 .1rem;
            flex-wrap: wrap;
            &_item{
                margin:0 .1rem .1rem 0;
                text-align: center;
                line-height: .6rem;
                height:.6rem;
                width:21%;
                border:.01rem solid #f2ecec;
                border-radius: .1rem;
                background:#f2ecec;
                &-active{
                    background:red;
                }
            }
        }
    }
}
</style>