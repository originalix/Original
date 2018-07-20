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
      {
        title: '完善用户信息',
        slot: false,
        src: '/resource/img/info.png'
			},
			{
				title: '余额补差价',
				slot: false,
				src: '/resource/img/charge_price.png'
			}
			// {
				// title: '优惠券兑换',
				// slot: false,
				// src: '/resource/img/cou_pon.png'
			// }
		],
		userInfo: {},
		couponCount: 0,
		cardCount: 0,
  },
	onLoad () {
	},
	onShow() {
		this.getProfile()
	},
	onShareAppMessage: function (res) {
		console.log(res)
		return {
			title: '衣之恋小程序分享',
			path: '/page/myCharge/myCharge'
		}
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
					console.log(data)
					var cardCount = 0
					if (data.user.card_id !== null) {
						console.log('有会员卡')
						cardCount = 1
					} else {
						console.log('没有会员卡')
					}
					that.setData({
						userInfo: data.user,
						couponCount: data.coupon,
						cardCount: cardCount
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
				// this.go2ErrorPage()
				this.go2SharePage()
				break
			// 积分商城
			case 1:
				this.go2ErrorPage()
				break
      case 2:
				this.go2EditInfoPage()
				break;
			case 3:
				this.go2ChargePaymentPage()
				break;	
      default:
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
	},
	go2MyCreditPage () {
		wx.navigateTo({
			url: '/pages/myCredit/myCredit'
		})
	},
	go2SharePage () {
		console.log(this.data.userInfo)
		wx.navigateTo({
			url: '/pages/share/share?id=' + this.data.userInfo.id
		})
	},
  go2EditInfoPage() {
    wx.navigateTo({
      url: '/pages/editInfo/editInfo'
    })
	},
	go2ChargePaymentPage() {
		wx.navigateTo({
			url: '/pages/chargePayment/chargePayment'
		})
	}
})
