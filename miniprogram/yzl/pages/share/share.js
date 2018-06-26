var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var appInstance = getApp()

Page({
	data: {},
	onShareAppMessage: function (res) {
		console.log(res)
		if (res.from === 'button') {
			console.log('来自转发按钮')
		}
		return {
			title: '衣之恋小程序分享',
			path: '/page/myCharge/myCharge'
		}
	},
})

