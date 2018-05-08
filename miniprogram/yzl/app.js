//app.js
var qcloud = require('./vendor/wafer2-client-sdk/index');
var config = require('./config');

App({
  onLaunch: function () {
    // qcloud.setLoginUrl(config.service.loginUrl);
    wx.login({
      success(res) {
        console.log(res)
      },
      fail(res) {
        console.log(res)
      }
    })
  },
  onError: function (msg) {
    console.log(msg);
  },
  globalData: {
    userInfo: null
  }
})
