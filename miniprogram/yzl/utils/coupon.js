var config = require('../config.js')
var appInstance = getApp()

const getCouponList = (data) => {
	wx.request({
		url: config.service.getCouponListUrl,
		header: appInstance.requestToken,
		data: {
			'type': data.type,
		},
		method: 'GET',
	
	})
}
