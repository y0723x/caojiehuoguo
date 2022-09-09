// const { defineConfig } = require('@vue/cli-service')
// module.exports = defineConfig({
//   transpileDependencies: true
// })

let proxyObj = {}

proxyObj['/'] = {
  ws: false,
  target: 'http://localhost//phpDemo/caojie-hotpot/controller/',
  changeOrigin: true,
  pathReWrite: {
    '^/': '/'
  }
}

module.exports = {
  devServer: {
    host: 'localhost',
    port: 8080,
    proxy: proxyObj
  }
}
