var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var chargeUtils = require('../../utils/charge.js')
var appInstance = getApp()

const Dialog = require('../../bower_components/zanui-weapp/dist/dialog/dialog')

Page({
  data: {
    product: {}
  },
  onLoad(option) {
    console.log(option)
    this.getPromotionDetail(option.id)
  },
  getPromotionDetail (id) {
    var that = this
    wx.showLoading({
      title: '加载中',
    })
    wx.request({
      url: config.service.promotionDetailAPI,
      header: appInstance.requestToken,
      data: {
        'id': id
      },
      method: 'GET',
      success: function (res) {
        console.log(res)
        wx.hideLoading()
        const code = res.data.code
        if (code === 200) {
          const response = res.data
          that.setData({
            product: response.data.product
          })
        }
      },
      fail: function (error) {
        wx.hideLoading()
        console.log(error)
      }
    })

  }
})
