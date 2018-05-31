var config = require('../../config.js');
var appInstance = getApp()

Page({
	data: {
		time: '12:01',
		date: '2018-05-30',
		address: {},
		isChooseAddress: false,
		productList: [],
		actionsheetShow: false,
		cancelWithMask: true,
		actions: [{
			name: '上门取送',
		},{
			name: '到店自提',
		}],
		expressType: 1,
	},
	onLoad () {
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
	},
	bindTimeChange: function(e) {
		console.log('picker发送选择改变，携带值为', e.detail.value)
		this.setData({
			time: e.detail.value
		})
	},
	bindDateChange: function(e) {
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
		this.setData({
			actionsheetShow: false
		})
	}
})
