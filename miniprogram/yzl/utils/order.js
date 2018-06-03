var config = require('../config.js')
var appInstance = getApp()

/**
 *  根据后台订单号，商品价格，获取创建小程序支付的参数
 *  @param String trade_no 后台订单号
 *  @param Int total_fee 商品价格
 *
 */
const getPayParams = (trade_no, total_fee) => {
	wx.request({
		url: config.service.createWxPayUrl,
		header: appInstance.requestToken,
		data: {
			'body': '衣之恋-干洗',
			'out_trade_no': trade_no,
			'total_fee': total_fee
		},
		method: 'POST',
		success: function (res) {
			console.log(res)
		},
		fail: function (error) {
			console.log('error')
			console.log(res)
		}
	})
}

const createWxPay = (data) => {

}

module.exports = { getPayParams }

