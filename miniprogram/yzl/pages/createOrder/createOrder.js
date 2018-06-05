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
		no_express_price: 0,
		remark_value: ''
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
	 *  输入表单事件绑定
	 */
	handleFieldChange (e) {
		console.log(e)
		let value = e.detail.detail.value
		this.setData({
			remark_value: value
		}, function () {})
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
	getRemarkData () {
		let value = this.data.expressText
		if (this.data.remark_value.length > 0) {
			return value + " - " + this.data.remark_value
		} else {
			return value
		}
	},
	/**
	 *  创建订单函数
	 */
	createOrder() {
		let orderItems = []
		let sumItemsCount = 0

		for (var i=0; i<this.data.productList.length; i++) {
			let product = this.data.productList[i]
			sumItemsCount += product.badge
			let item = {
				'product_id': product.id,
				'count': product.badge
			}
			orderItems.push(item)
		}

		let address = this.data.address
		let data = {
			'items_count': sumItemsCount,
			'order_remark': this.getRemarkData(), 
			'orderItems': orderItems,
			'userName': address.userName,
			'province': address.provinceName,
			'city': address.cityName,
			'county': address.countyName,
			'street': address.detailInfo,
			'postal_code': address.postalCode,
			'tel_number': address.telNumber,
			'success': function (res) {
				console.log('订单生成 成功的函数回调')
			},
			'fail': function (error) {
				console.log('订单生成失败的函数回调')
			}
		}

		console.log(data)
		orderUtils.createOrder(data)
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
		// const trade_no = "20150806125329"
		// const total_fee = 1
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
	}
})
