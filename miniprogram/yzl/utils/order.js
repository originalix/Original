var config = require('../config.js')

const getPayParams = (trade_no, total_fee) => {
	wx.request({
		url: config.service.createWxPayUrl,
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

module.exports{ getPayParams }

