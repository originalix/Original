var config = require('../config.js')
var appInstance = getApp()

/**
 *  根据后台订单号，商品价格，获取创建小程序支付的参数
 *  @param String trade_no 后台订单号
 *  @param Int total_fee 商品价格
 *
 */
const getPayParams = (data) => {
	console.log(data)
	wx.request({
		url: config.service.createWxPayUrl,
		header: appInstance.requestToken,
		data: {
			'body': '衣之恋-干洗',
			'out_trade_no': data.trade_no,
			'total_fee': data.total_fee
		},
		method: 'POST',
		success: function (res) {
			console.log(res)
			const code = res.data.code
			if (code === 200) {
				const payParams = res.data.data
				if (data.success !== undefined && typeof(data.success) === 'function') {
					data.success(payParams)
				}
			} else {
				if (data.fail !== undefined && typeof(data.fail) === 'function') {
					data.fail(res.data.msg)
				}
			}
		},
		fail: function (error) {
			if (data.fail !== undefined && typeof(data.fail) === 'function') {
				data.fail(error)
			}
			console.log('error')
			console.log(error)
		}
	})
}

const createWxPay = (data) => {
	wx.requestPayment({
		'timeStamp': data.timeStamp,
		'nonceStr': data.nonceStr,
		'package': data.package,
		'signType': data.signType,
		'paySign': data.sign,	
		'success': function (res) {
			console.log(res)
		},
		'fail': function (res) {
			console.log('fail')
			console.log(res)
		},
		'complete': function (res) {
			console.log('complete')
			console.log(res)
		}
	})
}

module.exports = { getPayParams }

