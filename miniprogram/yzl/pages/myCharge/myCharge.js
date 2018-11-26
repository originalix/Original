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
		this.getListData()
	},
	getListData () {
		let that = this
		wx.request({
			url: config.service.getBalanceLog,
			header: appInstance.requestToken,
			data: {},
			success: function (res) {
				console.log(res.data.data)
				const code = res.data.code
				if (code === 200) {
					const data = res.data.data
					that.setData({
						listData: data.items
					})
				}
			},
			fail: function (error) {
				
			}
		})
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

