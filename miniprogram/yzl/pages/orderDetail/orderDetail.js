var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var appInstance = getApp()

Page({
	data: {
		steps: [
			{
				// 此步骤是否当前完成状态
				current: false,
				// 此步骤是否已经完成
				done: true,
				// 此步骤显示文案
				text: '步骤一',
			},
			{
				done: true,
				current: true,
				text: '步骤二',
			},
			{
				done: false,
				current: false,
				text: '步骤三',
			}
		]
	},
	onLoad () {
		wx.setNavigationBarTitle({
      title: '待付款的订单' 
		})
	}
})

