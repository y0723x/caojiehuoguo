<template>
    <div class="wrapper">
        <!-- container -->
        <div class="home_container">
            <router-view v-slot="{ Component }">
                <transition name="move">
                    <keep-alive>
                        <component :is="Component"></component>
                    </keep-alive>
                </transition>
            </router-view>
        </div>
        <!-- bottom -->
        <Docker />
    </div>
</template>

<script>
import Docker from '@/components/Docker.vue'
export default {
    name: 'Home',
    components:{Docker},
    setup() {
        
    },
}
</script>

<style lang="scss" scoped>
.wrapper{
    position:absolute;
    top:0;
    right:0;
    left:0;
    bottom:0;
}

.home_container{
    position:absolute;
    top:0;
    right:0;
    left:0;
    bottom:.8rem;
}
</style>