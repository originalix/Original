var config = require('../../config.js');
var appInstance = getApp()

Page({
	data: {
		listData: [],
	},
	onLoad() {
		this.setListData()
	},
	setListData () {
		var list = [];
		for (var i=0; i<100; i++) {
			let type = 1
			if (i % 2 === 0) {
				type = 2
			}
			let data = {
				'title': '充值',
				'type': type,
				'value': i
			}	
			list.push(data)
		}

		this.setData({
			listData: list
		})
	}
})

