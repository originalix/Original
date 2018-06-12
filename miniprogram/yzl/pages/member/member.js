var config = require('../config.js')
var appInstance = getApp()

Page({
  data:{
    list: [
			// {
				// title: '常用地址',
				// slot: false,
				// src: '/resource/img/location.png'
			// },
			{
				title: '推荐有奖',
				slot: false,
				src: '/resource/img/love.png'
			},
			{
				title: '积分商城',
				slot: false,
				src: '/resource/img/gift.png'
			}
		]
  },
	go2ChargePage () {
		wx.navigateTo({
			url: '/pages/charge/charge'
		})
	},
	getProfile () {
		wx.request({
			url: config.service.getProfileUrl,
			header: appInstance.requestToken,
			data: {},
			method: 'GET',
			success: function (res) {

			},
			fail: function (error) {

			}
		})

	}
})
