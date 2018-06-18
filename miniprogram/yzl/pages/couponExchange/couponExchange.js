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
	getCoupon () {

	}
})

