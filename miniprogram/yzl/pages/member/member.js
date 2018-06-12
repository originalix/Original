var config = require('../../config.js')
var appInstance = getApp()

Page({
  data:{
    list: [
			// {
				// title: '常用地址',
				// slot: false,
				// src: '/resource/img/location.png'
			// },
			{
				title: '推荐有奖',
				slot: false,
				src: '/resource/img/love.png'
			},
			{
				title: '积分商城',
				slot: false,
				src: '/resource/img/gift.png'
			}
		],
		userInfo: {},
		couponCount: 0
  },
	onLoad () {
		this.getProfile()
	},
	go2ChargePage () {
		wx.navigateTo({
			url: '/pages/charge/charge'
		})
	},
	getProfile () {
		let that = this
		wx.request({
			url: config.service.getProfileUrl,
			header: appInstance.requestToken,
			data: {},
			method: 'GET',
			success: function (res) {
				const code = res.data.code
				if (code === 200) {
					const data = res.data.data
					that.setData({
						userInfo: data.user,
						couponCount: data.coupon
					})
				}
			},
			fail: function (error) {

			}
		})
	},
	go2MyChargePage() {
		wx.navigateTo({
			url: '/pages/myCharge/myCharge'
		})
	}
})
