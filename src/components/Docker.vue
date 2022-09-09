<template>
    <!-- bottom -->
    <div class="docker_bottom">
        <div 
            :class="{'docker_bottom_item': true, 'docker_bottom_item-active': activeIndex === index}"
            v-for="(docker, index) in dockerList"
            :key="index"
            @click="changeIndex(index, docker.path)"
        >
            <div 
                class="docker_bottom_item_icon iconfont"
                v-html="docker.icon"
            ></div>
            <div class="docker_bottom_item_text">{{ docker.text }}</div>
        </div>
    </div>
</template>

<script>
import { ref, reactive } from 'vue'
import { useRouter } from 'vue-router'
// 下标逻辑
const useIndexEffect = () => {
    const router = useRouter()
    const dockerList = reactive([
        {
            path: '/hotpot',
            icon: '&#xe626;',
            text: '下单'
        },
        {
            path: '/dynamic',
            icon: '&#xe7c2;',
            text: '动态'
        },
        {
            path: '/order',
            icon: '&#xe897;',
            text: '订单'
        }
    ])

    // 下标
    const activeIndex = ref(0)

    const changeIndex = (index, path) => {
        activeIndex.value = index
        router.push(path)
    }

    return { activeIndex, changeIndex, dockerList }
}

export default {
    name: 'docker',
    setup() {
        const { activeIndex, changeIndex, dockerList } = useIndexEffect()

        return { activeIndex, changeIndex, dockerList }
    },
}
</script>

<style lang="scss" scoped>
.docker_bottom{
    position:fixed;
    bottom:0;
    left:0;
    right:0;
    height:.8rem;
    background:#f2ecec;
    display:flex;
    text-align:center;
    &_item{
        flex:1;
        margin-top:.1rem;
        &-active{
            color:#36a7ee;
        }
        &_icon{
            font-size:.3rem;
        }
        &_text{
            font-size:.15rem;
        }
    }
}
</style>