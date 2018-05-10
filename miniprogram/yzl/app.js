//app.js
var qcloud = require('./vendor/wafer2-client-sdk/index');
var auth = require('./utils/auth.js');

App({
  onLaunch: function () {
    auth.login()
  },
  onError: function (msg) {
    console.log(msg);
  },
  globalData: {
    userInfo: null
  }
})
