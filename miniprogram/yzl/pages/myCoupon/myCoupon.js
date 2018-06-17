var config = require('../../config.js');
var appInstance = getApp()
var chargeUtils = require('../../utils/charge.js');
var couponUtils = require('../../utils/coupon.js')

Page({
	data: {
		tabs: [
			{title: '未使用', content: 1},
			{title: '已使用', content: 2},
			{title: '已过期', content: 3}
		],
		noOrder: true,
		loadmore: false,
		loadText: '正在努力加载...',
		couponList: [],
		pageMeta: {},
		type: 1
	},
	onLoad () {

	},
	getCouponList: function (type, page) {
		var that = this
		couponUtils.getCouponList({
			'type': type,
			'page': page,
			'success': function (res) {
				console.log('优惠券列表获取成功回调')
				console.log(res)
				let list = that.data.couponList
				for (var i=0; i<res.items.length; i++) {
					list.push(res.items[i])
				}

				that.setData({
					couponList: list,
					pageMeta: res.meta
				}, function () {
					console.log('now couponlist is : ')
					console.log(that.data.couponList)
				})
			}
		})
	}
})

