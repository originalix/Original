//app.js
var qcloud = require('./vendor/wafer2-client-sdk/index');
var auth = require('./utils/auth.js');

App({
  onLaunch: function () {
    const authInfo = auth.getAuthInfo()
    console.log(authInfo)
    auth.login()
    // 测试请求地址
    wx.request({
      url: 'https://api.yzl1030.com/test/index',
      data: {
      },
      method: 'GET',
      success: function(res) {
        console.log(res)
      },
      fail: function(error) {
        console.log(error)
      }
    });
  },
  onError: function (msg) {
    console.log(msg);
  },
  globalData: {
    userInfo: null
  },
  accessToken: auth.getAuthInfo().accessToken,
})
