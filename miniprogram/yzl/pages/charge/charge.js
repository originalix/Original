var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var appInstance = getApp()

Page({
	data: {
		list: [],
		currentIdx: 1,
		disabled: true
	},
	onLoad () {
		this.getChargeList()
	},
	getChargeList () {
		let list = [
			{
				value: 2000,
				gift: 500
			},
			{
				value: 500,
				gift: 80
			},
			{
				value: 1000,
				gift: 230
			},
			{
				value: 300,
				gift: 40
			},
			{
				value: 5000,
				gift: 1400
			},
			{
				value: 10000,
				gift: 3000
			},
		]
		this.setData({
			list: list 
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
		console.log('输入事件')
		console.log(e)
	},
	// 输入框获取到焦点的事件
	handleFocus (e) {
		console.log('获取焦点')
		console.log(e)
	},
	// 输入框失去焦点事件
	handleBlur (e) {
		console.log('失去焦点')
		console.log(e)
	}
})

