var config = require('../config.js')
var appInstance = getApp()

/**
 *  根据后台订单号，商品价格，获取创建小程序支付的参数
 *  @param String trade_no 后台订单号
 *  @param Int total_fee 商品价格
 *
 */
const getPayParams = (data) => {
	console.log(data)
	wx.request({
		url: config.service.createWxPayUrl,
		header: appInstance.requestToken,
		data: {
			'body': '衣之恋-干洗',
			'out_trade_no': data.trade_no,
			'total_fee': data.total_fee
		},
		method: 'POST',
		success: function (res) {
			console.log(res)
			const code = res.data.code
			if (code === 200) {
				const payParams = res.data.data
				if (data.success !== undefined && typeof(data.success) === 'function') {
					data.success(payParams)
				}
			} else {
				if (data.fail !== undefined && typeof(data.fail) === 'function') {
					data.fail(res.data.msg)
				}
			}
		},
		fail: function (error) {
			if (data.fail !== undefined && typeof(data.fail) === 'function') {
				data.fail('发起支付失败，请重试')
			}
			console.log(error)
		}
	})
}

/**
 * 根据参数 拼装数据，调起小程序支付的JSAPI 
 *
 */
const createWxPay = (params) => {
	const { data } = params
	wx.requestPayment({
		'timeStamp': data.timeStamp.toString(),
		'nonceStr': data.nonceStr,
		'package': data.package,
		'signType': data.signType,
		'paySign': data.sign,	
		'success': function (res) {
			console.log(res)
			if (params.success !== undefined && typeof(params.success) === 'function') {
				params.success(res)
			}
		},
		'fail': function (res) {
			console.log('fail')
			console.log(res)
			if (params.fail !== undefined && typeof(params.fail) === 'function') {
				params.fail(res)
			}
		},
		'complete': function (res) {
			console.log('complete')
			console.log(res)
		}
	})
}

/**
 * 生成订单API
 */
const createOrder = (params) => {
	wx.showLoading({
		'title': '数据提交中',
		'mask': true
	})
	let data = {
		'items_count': params.items_count,
		'order_remark': params.order_remark,
		'orderItems': params.orderItems,
		'userName': params.userName,
		'province': params.province,
		'city': params.city,
		'county': params.county,
		'street': params.street,
		'postal_code': params.postal_code,
		'tel_number': params.tel_number
	}

	wx.request({
		url: config.service.createOrderUrl,
		header: appInstance.requestToken,
		data: data,
		method: 'POST',
		success: function (res) {
			wx.hideLoading()
			console.log(res)
			const code = res.data.code
			if (code === 200) {
				const response = res.data.data
				if (params.success !== undefined && typeof(params.success) === 'function') {
					params.success(response)
				}
			} else {
				if (params.fail !== undefined && typeof(params.fail) === 'function') {
					params.fail(res.data.msg)
				}
			}
		},
		fail: function (error) {
			wx.hideLoading()
			if (params.fail !== undefined && typeof(params.fail) === 'function') {
				params.fail('生成订单失败，请重试')
			}
			console.log(error)
		}
	})
}

/**
 *  获取订单列表
 *  @param type 订单列表类型
 *  @param page 订单列表页数
 */
const getOrderList = (params) => {
	wx.request({
		url: config.service.getOrderListUrl,
		header: appInstance.requestToken,
		data: {
			'type': params.type,
			'page': params.page
		},
		method: 'GET',
		success: function (res) {
			console.log(res)
			const code = res.data.code
			if (code === 200) {
				const response = res.data.data
				if (params.success !== undefined && typeof(params.success) === 'function') {
					params.success(response)
				}
			} else {
				if (params.fail !== undefined && typeof(params.fail) === 'function') {
					params.fail(res.data.msg)
				}
			}
		},
		fail: function (error) {
			console.log(error)
			if (params.fail !== undefined && typeof(params.fail) === 'function') {
				params.fail('获取订单列表失败，请重试')
			}
		}
	})
}

module.exports = { getPayParams, createWxPay, createOrder, getOrderList }

