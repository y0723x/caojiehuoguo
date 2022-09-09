import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import '@/style/index.css'
import { getRequest, postRequest, putRequest, deleteRequest } from '@/utils/request'
import  element  from 'element-plus'

createApp(App).use(store).use(router).use(element).mount('#app')
