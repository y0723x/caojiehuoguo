import axios from 'axios'
import { ElMessage } from 'element-plus'

let baseUrl = ''

const caojiehuoguo = axios.create({
    baseURL: `${baseUrl}`,
    timeout: 10000
})

// 请求时拦截器
caojiehuoguo.interceptors.request.use((config) => {
    config.headers['TableId'] = sessionStorage.getItem('tableId') || ''
    return config
}, (error) => {
    return Promise.reject(error)
})

// 响应式拦截器
caojiehuoguo.interceptors.response.use((success) => {
    // 成功调用到接口
    if (success.status && success.status == 200) {
        if (success.data.code === 401 || success.data.code === 403 || success.data.code === 500) {
            ElMessage.error('获取结果失败')
            return
        }
        ElMessage.success('获取结果成功')
    }
    return success.data
},(error) => {
    //未调用到接口
    if (error.response.code === 404) {
        ElMessage.error('服务器被吃啦( ╯□╰ )')
        return 
    } else if (error.response.data.Elmessage) {
        ElMessage.error(error.response.data.Elmessage)
        return 
    }
    return 
})

export const getRequest = (url, params) => {
    return caojiehuoguo({
        method: 'get',
        url: url,
        params: params
    })
}

export const postRequest = (url, data) => {
    return caojiehuoguo({
        method: 'post',
        url: url,
        data: data
    })
}

export const putRequest = (url, data) => {
    return caojiehuoguo({
        method: 'put',
        url: url,
        data: data
    })
}

export const deleteRequest = (url, data) => {
    return caojiehuoguo({
        method: 'delete',
        url: url,
        data: data
    })
}