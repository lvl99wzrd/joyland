const fs = require('fs')
const version = require('./package.json').version

module.exports = {
  devServer: {
    host: 'localhost',
    https: {
      key: fs.readFileSync('./crt/server.key'),
      cert: fs.readFileSync('./crt/server.crt')
    }
  },
  filenameHashing: false,
  publicPath: process.env.NODE_ENV === 'production' ? 'joyland/' : '/',
  assetsDir: 'assets',
  css: {
    extract: {
      filename: 'assets/css/[name].css',
      chunkFilename: 'assets/css/[name].' + version + '.css',
    },
  },
  configureWebpack: (config) => {
    config.output.chunkFilename = 'assets/views/[name].' + version + '.js'
  }
}
