var config = require('../../config.js');
var appInstance = getApp()
var chargeUtils = require('../../utils/charge.js');

Page({
	data: {
		listData: [],
		balance: 0,
	},
	onLoad() {
		this.getUserInfo()
	},
	getListData () {
	},
	// 获取用户信息
	getUserInfo () {
		let that = this
		chargeUtils.getUserMe({
			'success': function (res) {
				console.log(res)
				that.setData({
					balance: res.charge
				}, function () {
					console.log(this.data.balance)
				})
			},
			'fail': function (error) {
				console.log('用户信息获取失败')
			}
		})
	},
	go2ChargePage () {
		wx.navigateTo({
			url: '/pages/charge/charge'
		})
	}
})

