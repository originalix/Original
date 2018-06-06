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
    ]
  },
  handleTabChange(selectedId) {
    console.log(selectedId);
  },
  onClick: function(e) {
    console.log(`ComponentId:${e.detail.componentId},you selected:${e.detail.key}`);
		orderUtils.getOrderList({
			'type': 0,
			'page': 1,
			'success': function (res) {
				console.log('订单列表获取成功回调')
			},
			'fail': function (error) {
				console.log('订单列表失败回调')
			}
		})
  }
})
