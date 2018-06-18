var config = require('../../config.js');
var appInstance = getApp()
var couponUtils = require('../../utils/coupon.js')

Page({
	data: {
		inputValue: ''
	},
	handleInput: function (e) {
		let value = e.detail.value
		console.log(value)
		this.setData({
			inputValue: value
		})
	},
	test () {
		console.log('Hello world')
	},
	getCoupon: function (e) {
		let value = this.data.inputValue
		console.log(value)
		if (value.length < 1) {
			wx.showToast({
				title: '请输入正确的兑换码',
				icon: 'none',
				duration: 1500
			})
			return
		}
		couponUtils.exchangeCoupon({
			'code': value,
			'success': function (res) {
				wx.showToast({
					title: '领券成功',
					icon: 'success',
					duration: 1500
				})
			},
			'fail': function (error) {
				wx.showToast({
					title: error,
					icon: 'none',
					duration: 1500
				})
			}
		})
	}
})

