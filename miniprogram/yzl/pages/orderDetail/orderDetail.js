var config = require('../../config.js');
					that.calculatePrice()
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var chargeUtils = require('../../utils/charge.js')
var appInstance = getApp()

Page({
	data: {
		steps: [],
		submitBtnType: 'order',
		productList: [],
		actionsheetShow: false,
		cancelWithMask: true,
		actions: [{
			name: '上门配送',
		},{
			name: '到店取送',
		}],
		payActionsheetShow: false,
		payActions: [{
			name: '微信支付'
		}],
		isShowPayView: true,
		expressType: 0,
		expressText: '上门配送',
		// 创建订单之后 缓存的订单数据
		orderInfo: {},
		// 是否已经创建订单
		isCreatedOrder: true,
		// 根据是否创建订单 显示提交按钮的文本  提交订单 or 去支付
		submitBtnText: '去支付',
		isPayment: false,
		userInfo: {}
	},
	onLoad (option) {
		console.log(option)
		this.initializeStatus(option.status)
		this.getUserInfo()

		// 根据id 获取订单详情
		var that = this
		orderUtils.getOrderDetail({
			'id': option.id,
			'success': function (res) {
				console.log('获取订单详情成功回调')
				console.log(res)
				that.setData({
					productList: res.items,
					orderInfo: res
				})
			},
			'fail': function (error) {
				console.log('获取订单详情失败回调')
			}
		})
	},
	/**
	 *  根据支付状态 初始化部分数据
	 */
	initializeStatus (statusStr) {
		let status = parseInt(statusStr)
		this.setStepsData(status)
		let title = '订单详情'
		let text = '已付款'
		let isPayMent = true

		// 根据支付状态 设置按钮样式
		if (status === 1) {
			title = '待付款的订单'
			text = '去支付'
			isPayMent = false
		}
		this.setData({
			submitBtnText: text,
			isPayment: isPayMent
		})
		
		wx.setNavigationBarTitle({
			title: title
		})
	},
	setStepsData (status) {
		var steps = [
			{
				current: false,
				done: false,
				text: '买家下单',
			},
			{
				done: false,
				current: false,
				text: '买家付款',
			},
			{
				done: false,
				current: false,
				text: '交易完成',
			}
		]

		for (var i=0; i<steps.length; i++) {
			if (i < status) {
				steps[i].done = true
				steps[i].current = false
			} else if (i == status ) {
				steps[i].done = false
				steps[i].current = true
			}

			if (status === 3) {
				steps[2].current = true
			}
		}

		this.setData({
			steps: steps
		})
		console.log(this.data.steps)
	},
	/**
	 *  创建订单函数
	 */
	createOrder() {
		var that = this

		if (this.data.isCreatedOrder === true) {
			let total_fee = this.data.orderInfo.real_amount * 100
			that.createWxOrder(this.data.orderInfo.trade_no, total_fee)
			return
		}
					// that.setData({
						// orderInfo: res,
						// isCreatedOrder: true,
						// submitBtnText: '去支付'
					// }, function () {})

					// let total_fee = res.real_amount * 100
					// that.createWxOrder(res.trade_no, total_fee)
	},
	/**
	 * 使用JSAPI 调起微信支付
	 */
	createWxPay (res) {
		const params = {
			'data': res,
			'success': function (res) {
				console.log('支付完成后的操作')
			},
			'fail': function (error) {
				console.log('支付失败后的操作')
			}
		}	

		orderUtils.createWxPay(params)
	},
	/**
	 * 创建微信支付订单，微信支付统一下单接口
	 */
	createWxOrder (trade_no, total_fee) {
		var that = this
		// const trade_no1 = "2018060515282019326307"
		// const total_fee1 = 3800
		orderUtils.getPayParams({
			'trade_no': trade_no,
			'total_fee': total_fee,
			'type': 1,
			'success': function (res) {
				that.createWxPay(res)
			},
			'fail': function (error) {
				if (typeof error == 'string' || error instanceof String) {
					wx.showToast({
						title: error,
						icon: 'none',
						duration: 2000
					})
				}
			}
		})	
	},
	/**
	 *  显示微信支付弹窗
	 */
	showPayActionsheet () {
		this.setData({
			payActionsheetShow: true,
			isShowPayView: false
		})
	},
	/**
	 * 微信支付的点击事件
	 */
	handlePayActionClick () {
		this.createOrder()
		this.setData({
			payActionsheetShow: false,
			isShowPayView: true
		})
	},
	closePayActionsheet () {
		console.log('取消按钮1！！！')
		this.setData({
			payActionsheetShow: false,
			isShowPayView: true
		})
	},
	getUserInfo () {
		var that = this
		chargeUtils.getUserMe ({
			'success': function (res) {
				console.log(res)
				that.setData({
					userInfo: res
				}, function () {
					console.log(that.data.userInfo)
				})
			},
			'fail': function (error) {
				console.log('用户信息获取失败')
			}
		})
	}
})

