var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var appInstance = getApp()

Page({
	data: {
		time: '',
		startTime: '',
		date: '',
		startDate: '',
		endDate: '',
		address: {},
		isChooseAddress: false,
		submitBtnType: 'not-order',
		productList: [],
		actionsheetShow: false,
		cancelWithMask: true,
		actions: [{
			name: '上门配送',
		},{
			name: '到店取送',
		}],
		expressType: 0,
		expressText: '上门配送',
		// 合计栏目显示价格
		price: 0,
		// fixed栏目显示价格
		finalPrice: 0, 
		// 运费价格
		expressPrice: 0,
		// 不包含快递的合计价格
		no_express_price: 0
	},
	onLoad () {
		// 获取购物车的商品数据
		var that = this
		try {
			var cartData = wx.getStorageSync('CART_LIST_DATA')
			if (cartData) {
				that.setData({
					productList: cartData
				}, function () {
					console.log(that.data.productList)
				})
			}
		} catch (e) {
			console.log(e)
		}
		this.initTimeAndDate()
		this.calculatePrice()
	},
	/**
	 *  初始化配送日期、时间
	 */
	initTimeAndDate () {
		var that = this
		// 查询设置取件整点
		var d = new Date()
		var hours = d.getHours()
		
		// 设置默认取件日期
		var today = util.getDateStr(0)
		var endDate = util.getDateStr(3)
		if (hours < 22 && hours+2 >= 22) {
			hours = 22
		} else if (hours >= 22) {
			today = util.getDateStr(1)
			endDate = util.getDateStr(4)
			hours = 9
		} else {
			hours += 2
		}
		var time = hours + ':00'
		// 设置取件日期
		that.setData({
			date: today,
			startDate: today,
			endDate: endDate,
			time: time,
			startTime: time
		})
		console.log(hours)
	},
	/**
	 *  配送时间修改事件
	 */
	bindTimeChange: function(e) {
		console.log('picker发送选择改变，携带值为', e.detail.value)
		this.setData({
			time: e.detail.value
		})
	},
	/**
	 *  配送日期修改事件
	 */
	bindDateChange: function(e) {
		var targetDate = e.detail.value
		var today = util.getDateStr(0)
		if (today == targetDate) {
			console.log('就是今天哦 亲！！！')
			
			var d = new Date()
			var hours = d.getHours()
			
			// 设置默认取件日期
			if (hours < 22 && hours+2 >= 22) {
				hours = 22
			} else if (hours >= 22) {
				hours = 22
			} else {
				hours += 2
			}
			var time = hours + ':00'
			// 设置取件日期
			this.setData({
				time: time,
				startTime: time
			})
		}
  	console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      date: e.detail.value
    })
  },
	/**
	 *  选择地址事件
	 */
	choseAddress () {
		console.log('choseAddress')
		var that = this
		wx.chooseAddress({
			success: function (res) {
				console.log(res)
				that.setData({
					address: res,
					isChooseAddress: true,
					submitBtnType: 'order'
				}, function () {
					console.log(that.data.isChooseAddress)
				})
			},
			fail: function (res) {
				console.log(res)
				if (that.data.isChooseAddress === false) {
					that.setData({
						isChooseAddress: false,
						submitBtnType: 'not-order'
					})
				}
			}
		})
	},
	/**
	 *  打开配送方式选择的ActionSheet
	 */
	openActionSheet () {
		console.log('openActionSheet')
		this.setData({
			actionsheetShow: true
		})
	},
	/**
	 *  配送方式选择的监听事件
	 */
	handleActionClick ({ detail }) {
		const { index } = detail
		console.log (detail)
		var text = ''
		if (index == 0) {
			text = '上门配送'	
		} else {
			text = '到店取送'
		}
		this.setData({
			expressType: index,
			expressText: text,
			actionsheetShow: false
		})
	},
	/**
	 * 计算商品价格和运费
	 */
	calculatePrice () {
		const list = this.data.productList
		console.log('list ---->: ')
		console.log(list)
		let sumPrice = 0.00
		var expressP = 0.00
		for (let i=0; i<list.length; i++) {
			sumPrice += Number(list[i].price) * list[i].badge
		}
		console.log('price: ' + sumPrice.toFixed(2))

		if (sumPrice < 30) {
			expressP = 10.00	
		}
		var finalP = sumPrice + expressP 
		this.setData({
			'price': sumPrice.toFixed(2),
			expressPrice: expressP,
			finalPrice: finalP,
			no_express_price: sumPrice.toFixed(2)
		}, function () {})
	},
	/**
	 *  创建微信支付
	 */
	createOrder() {
		var that = this
		const trade_no = "20150806125321"
		const total_fee = 1
		orderUtils.getPayParams({
			'trade_no': trade_no,
			'total_fee': total_fee,
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
	}
})
