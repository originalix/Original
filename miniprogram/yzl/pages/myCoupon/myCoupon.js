var config = require('../../config.js');
var appInstance = getApp()
var chargeUtils = require('../../utils/charge.js');

Page({
	data: {
		tabs: [
			{title: '未使用', content: 1},
			{title: '已使用', content: 2},
			{title: '已过期', content: 3}
		],
		noOrder: true,
		loadmore: false,
		loadText: '正在努力加载...'
	}
})

