Page({
	data: {
		time: '12:01',
		date: '2018-05-30'
	},
	bindTimeChange: function(e) {
		console.log('picker发送选择改变，携带值为', e.detail.value)
		this.setData({
			time: e.detail.value
		})
	},
	bindDateChange: function(e) {
  	console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      date: e.detail.value
    })
  },
	choseAddress () {
		console.log('choseAddress')
		wx.chooseAddress({
			success: function (res) {
				console.log(res)
			}
		})
	},
})
