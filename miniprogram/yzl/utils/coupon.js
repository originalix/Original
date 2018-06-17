var config = require('../config.js')
var appInstance = getApp()

const getCouponList = (data) => {
	wx.request({
		url: config.service.getCouponListUrl,
		header: appInstance.requestToken,
		data: {
			'type': data.type,
			'page': data.page
		},
		method: 'GET',
		success: function (res) {
			const code = res.data.code
			if (code === 200) {
				const response = res.data.data
				if (data.success !== undefined && typeof(data.success) === 'function') {
					data.success(response)
				}
			} else {
				if (data.fail !== undefined && typeof(data.fail) === 'function') {
					data.fail(res.data.msg)
				}
			}
		},
		fail: function (error) {
			if (data.fail !== undefined && typeof(data.fail) === 'function') {
				data.fail('获取优惠券列表失败，请重试')
			}
			console.log(error)
		}
	})
}

module.exports = { getCouponList }

