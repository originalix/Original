var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var appInstance = getApp()

Page({
	data: {
		title: "优惠券&活动规则",
		content: "一、邀请好友要求:\n被邀请的用户必须是衣之恋新用户",
	},
	onShareAppMessage: function (res) {
		console.log(res)
		if (res.from === 'button') {
			console.log('来自转发按钮')
		}
		return {
			title: '衣之恋小程序分享',
			path: '/page/myCharge/myCharge'
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

