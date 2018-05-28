//app.js

var qcloud = require('./vendor/wafer2-client-sdk/index');
var auth = require('./utils/auth.js');

App({
  onLaunch: function () {
    const authInfo = auth.getAuthInfo()
    console.log(authInfo)
    auth.login()
  },
  onError: function (msg) {
    console.log(msg);
  },
  globalData: {
    userInfo: null
  },
  accessToken: auth.getAuthInfo().accessToken,
	requestToken: {
		'Authorization': 'Bearer ' + auth.getAuthInfo().accessToken
	}
})
