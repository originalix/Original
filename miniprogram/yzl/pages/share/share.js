var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var appInstance = getApp()

Page({
	data: {
		uid: 0,
		title: "优惠券&活动规则",
	},
	onLoad (option) {
		console.log(`option query is : `)
		console.log(option)
		if (option.id !== undefined) {
			var that = this
			this.setData({
				uid: option.id
			})
		}
	},
	onShareAppMessage: function (res) {
		console.log(res)
		if (res.from === 'button') {
			console.log('来自转发按钮')
		}
		return {
			title: '衣之恋小程序分享',
			path: '/page/index/index?share_id=' + this.data.uid
		}
	},
	showDialog() {
		let dialogComponent = this.selectComponent('.wxc-dialog')
		dialogComponent && dialogComponent.show();
	},
	hideDialog() {
		let dialogComponent = this.selectComponent('.wxc-dialog')
		dialogComponent && dialogComponent.hide();
	},
	onConfirm () {
		console.log('点击了确认按钮')
		this.hideDialog()
	},
	onCancel () {
		console.log('点击了取消按钮')
		this.hideDialog()
	}
})

