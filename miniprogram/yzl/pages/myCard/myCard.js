var config = require('../../config.js');
var appInstance = getApp()
var chargeUtils = require('../../utils/charge.js');

Page({
	data: {
		userInfo: {},
	},
	onLoad () {
		this.getUserInfo()
	},
	getUserInfo () {
		var that = this
		chargeUtils.getUserMe({
			'success': function (res) {
				that.setData({
					userInfo: res
				}, function () {
					console.log(this.data.userInfo)
				})
			},
			'fail': function (error) {
				console.log('用户信息获取失败')
			}
		})
	}
})

