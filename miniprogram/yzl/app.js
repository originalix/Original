//app.js
var qcloud = require('./vendor/wafer2-client-sdk/index');
var config = require('./config');
var auth = require('./utils/auth.js');

App({
  onLaunch: function () {
    auth.login()
    // qcloud.setLoginUrl(config.service.loginUrl);
    // wx.login({
    //   success(res) {
    //     console.log(res)
    //     wx.request({
    //       url: config.service.loginUrl,
    //       data: {
    //         'code': res.code
    //       },
    //       method: 'GET',
    //       success: function (res) {
    //         let openid = res.data.data.openid
    //         if (typeof(openid) == "undefined") {
    //           console.log('openid undefined')
    //           // 获取openid失败
    //           wx.showModal({
    //             title: '提示',
    //             content: '读取用户信息有误，请点击确认重试',
    //             success: function(res) {
    //               if (res.confirm) {
    //                 console.log('用户点击确定')
    //               } else if (res.cancel) {
    //                 console.log('用户点击取消')
    //               }
    //             }
    //           })
    //         }
    //         console.log(openid)
    //       },
    //       fail: function (error) {
    //         console.log(error)
    //       }
    //     });
    //   },
    //   fail(res) {
    //     console.log(res)
    //   }
    // })
  },
  onError: function (msg) {
    console.log(msg);
  },
  globalData: {
    userInfo: null
  }
})
