var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var appInstance = getApp()

Page({
  data: {
    noOrder: false,
    tabs: [
			{title: '全部', content: ''},
      {title: '待付款', content: '内容一'},
      {title: '已完成', content: '内容二'},
    ],
		orderList: [],
		pageMeta: {}
  },
	onLoad () {
		this.getOrderList(0, 1)
	},
  handleTabChange(selectedId) {
    console.log(selectedId);
  },
  onClick: function(e) {
    console.log(`ComponentId:${e.detail.componentId},you selected:${e.detail.key}`);
  },
	getOrderList: function (type, page) {
		var that = this
		orderUtils.getOrderList({
			'type': type,
			'page': page,
			'success': function (res) {
				console.log('订单列表获取成功回调')
				console.log(res)
				let list = this.data.orderList
				for (var i=0; i<res.items.length; i++) {
					list.push(res.items[i])
				}
				
				that.setData({
					orderList: list
				}, function () {
					console.log('now orderlist is: ')
					console.log(this.data.orderList)
				})
			},
			'fail': function (error) {
				console.log('订单列表失败回调')
			}
		})
	}
})
