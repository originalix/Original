//app.js

var qcloud = require('./vendor/wafer2-client-sdk/index');
var auth = require('./utils/auth.js');

App({
  onLaunch: function () {
    this.login()
  },
  onError: function (msg) {
    console.log(msg);
  },
  login() {
    var that = this
    const authInfo = auth.getAuthInfo()
    console.log(authInfo)
    var callback = function callback() {
      console.log(auth.getAuthInfo())
      console.log('hello world')
      // console.log(that.globalData.accessToken)
      that.accessToken = auth.getAuthInfo().accessToken
      that.requestToken = {
        'Authorization': 'Bearer ' + auth.getAuthInfo().accessToken
      }
      console.log(that.accessToken)
    }
    auth.login(callback)
  },
  globalData: {
    userInfo: null,
  },
  accessToken: auth.getAuthInfo().accessToken,
  requestToken: {
    'Authorization': 'Bearer ' + auth.getAuthInfo().accessToken
  }
})
