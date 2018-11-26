var config = require('../config.js')
var appInstance = getApp()

/**
 *  获取充值列表api
 */
const getChargeList = (data) => {
	wx.request({
		url: config.service.getChargeListUrl,
		header: appInstance.requestToken,
		data: {},
		method: 'GET',
		success: function (res) {
			console.log(res)
			const code = res.data.code
			if (data.success !== undefined && typeof(data.success) === 'function') {
				data.success(res.data.data)
			} else {
				if (data.fail !== undefined && typeof(data.fail) === 'function') {
					data.fail(res.data.msg)
				}
			}
		},
		fail: function (error) {
			if (data.fail !== undefined && typeof(data.fail) === 'function') {
				data.fail('获取充值列表失败，请重试')
			}
			console.log(error)
		}
	})
}

/**
 * 创建充值订单接口
 */
const createChargeOrder = (data) => {
	wx.request({
		url:config.service.createChargeOrderUrl,
		header: appInstance.requestToken,
		data: data.params,
		method: 'POST',
		success: function (res) {
			console.log(res)
			const code = res.data.code
			if (data.success !== undefined && typeof(data.success) === 'function') {
				data.success(res.data.data)
			} else {
				if (data.fail !== undefined && typeof(data.fail) === 'function') {
					data.fail(res.data.msg)
				}
			}
		},
		fail: function (error) {
			if (data.fail !== undefined && typeof(data.fail) === 'function') {
				data.fail('创建充值订单失败 请重试')
			}
			console.log(error)
		}
	})
}

/**
 * 获取用户信息接口 
 */ 
const getUserMe = (data) => {
	wx.request({
		url: config.service.getUserMe,
		header: appInstance.requestToken,
		data: {},
		method: 'GET',
		success: function (res) {
			console.log(res)
			const code = res.data.code
			if (data.success !== undefined && typeof(data.success) === 'function') {
				data.success(res.data.data)
			} else {
				if (data.fail !== undefined && typeof(data.fail) === 'function') {
					data.fail(res.data.msg)
				}
			}
		},
		fail: function (error) {
			if (data.fail !== undefined && typeof(data.fail) === 'function') {
				data.fail('创建充值订单失败 请重试')
			}
			console.log(error)
		}
	})
}

/**
 * 使用余额补差价
 * @param {*} data 
 */
const paymentByCharge = (data) => {
  wx.request({
    url: config.service.chargePaymentAPI,
    header: appInstance.requestToken,
    data: {
      'total_fee': data.total_fee
    },
    method: 'POST',
    success: function (res) {
      console.log(res)
			const code = res.data.code
			if (code === 200) {
				if (data.success !== undefined && typeof (data.success) === 'function') {
					data.success(res.data.data)
				}
			} else {
        if (data.fail !== undefined && typeof (data.fail) === 'function') {
          data.fail(res.data.msg)
        }
			}
    },
    fail: function (error) {
      if (data.fail !== undefined && typeof (data.fail) === 'function') {
        data.fail('余额补差价失败 请重试')
      }
      console.log(error)
    }
  })
}

module.exports = {
	getChargeList,
	createChargeOrder,
  getUserMe,
  paymentByCharge,
}
