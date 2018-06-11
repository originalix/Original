var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var chargeUtils = require('../../utils/charge.js');
var appInstance = getApp()

Page({
	data: {
		list: [],
		currentIdx: 9999,
		disabled: true,
		inputValue: '',
		balance: 0
	},
	onLoad () {
		this.getUserInfo()
		this.getChargeList()
	},
	getChargeList () {
		let that = this
		chargeUtils.getChargeList({
			'success': function (res) {
				console.log('列表成功回调')
				that.setData({
					list: res
				})
			},
			'fail': function (error) {
				console.log('列表失败回调')
			}
		})
	},
	getUserInfo () {
		let that = this
		chargeUtils.getUserMe({
			'success': function (res) {
				console.log(res)
				that.setData({
					balanace: res.charge
				})
			},
			'fail': function (error) {
				console.log('用户信息获取失败')
			}
		})
	},
	onClick (e) {
		let tapIdx = e.currentTarget.dataset.idx
		this.setData({
			currentIdx: tapIdx,
			disabled: false
		})
		console.log(tapIdx)
	},
	// 输入框的输入事件
	handleInput (e) {
		let value = e.detail.value
		this.setData({
			inputValue: value,
			disabled: false
		})
	},
	// 输入框获取到焦点的事件
	handleFocus (e) {
		let btnDisabled = false
		if (this.data.inputValue.length < 1) {
			btnDisabled = true
		}

		this.setData({
			currentIdx: 9999,
			disabled: btnDisabled
		})
	},
	// 输入框失去焦点事件
	handleBlur (e) {
		console.log('失去焦点')
		console.log(e)
	}
})

