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
			},
			// {
				// title: '优惠券兑换',
				// slot: false,
				// src: '/resource/img/cou_pon.png'
			// }
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
	},
	go2MyCoupon () {
		wx.navigateTo({
			url: '/pages/myCoupon/myCoupon'
		})
	},
	handleClick: function (e) {
		let index = e.currentTarget.dataset.index
		console.log(index)
		switch (index) {
			// 推荐有奖
			case 0:
				this.go2ErrorPage()
				break
			// 积分商城
			case 1:
				this.go2ErrorPage()
				break
		}
	},
	go2CouponExchangePage () {
		wx.navigateTo({
			url: '/pages/couponExchange/couponExchange'
		})
	},
	go2ErrorPage () {
		wx.navigateTo({
			url: '/pages/error/error'
		})
	},
	makePhoneCall () {
		wx.makePhoneCall({
			phoneNumber: '18853176616'
		})
	},
	go2MyCardPage () {
		wx.navigateTo({
			url: '/pages/myCard/myCard'
		})
	}
})
