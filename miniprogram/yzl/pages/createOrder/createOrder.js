var config = require('../../config.js');
var util = require('../../utils/util.js');
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
		productList: [],
		actionsheetShow: false,
		cancelWithMask: true,
		actions: [{
			name: '上门配送',
		},{
			name: '到店取送',
		}],
		expressType: 0,
		expressText: '上门配送'
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
	},
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
	bindTimeChange: function(e) {
		console.log('picker发送选择改变，携带值为', e.detail.value)
		this.setData({
			time: e.detail.value
		})
	},
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
					isChooseAddress: true
				}, function () {
					console.log(that.data.isChooseAddress)
				})
			},
			fail: function (res) {
				console.log(res)
				if (that.data.isChooseAddress === false) {
					that.setData({
						isChooseAddress: false
					})
				}
			}
		})
	},
	openActionSheet () {
		console.log('openActionSheet')
		this.setData({
			actionsheetShow: true
		})
	},
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
	}
})
