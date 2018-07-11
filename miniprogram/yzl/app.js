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
    const authInfo = auth.getAuthInfo()
    console.log(authInfo)
    var callback = function callback () {
      console.log(auth.getAuthInfo())
      this.accessToken = auth.getAuthInfo().accessToken
      this.requestToken = {
		    'Authorization': 'Bearer ' + auth.getAuthInfo().accessToken
      }
    }
    auth.login(callback)
  },
  globalData: {
    userInfo: null
  },
  accessToken: auth.getAuthInfo().accessToken,
	requestToken: {
		'Authorization': 'Bearer ' + auth.getAuthInfo().accessToken
	}
})
