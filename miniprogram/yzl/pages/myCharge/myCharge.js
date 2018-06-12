var config = require('../../config.js');
var appInstance = getApp()

Page({
	data: {
		listData: [],
	},
	onLoad() {
		// this.setListData()
	},
	setListData () {
		var list = [];
		for (var i=0; i<100; i++) {
			let data = {
				'title': '充值',
				'type': 1,
				'value': 200
			}	
			list.push(data)
		}

		this.setData({
			listData: list
		})
	}
})

