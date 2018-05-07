//app.js
var qcloud = require('./bower_components/wafer-client-sdk/index');
var config = require('./config');

App({
  onLaunch: function () {
    qcloud.setLoginUrl(config.service.loginUrl);
  },
  onError: function (msg) {
    console.log(msg);
  },
  globalData: {
    userInfo: null
  }
})
