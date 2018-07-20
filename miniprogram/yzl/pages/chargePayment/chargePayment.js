var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var chargeUtils = require('../../utils/charge.js');
var appInstance = getApp()

Page({
  data: {
    nowCharge: 0,
    loading: false,
    price: 0
  },
  onLoad() {
    this.getUserInfo()
  },
  getUserInfo() {
    var that = this
    chargeUtils.getUserMe({
      'success': function (res) {
        that.setData({
          nowCharge: res.charge
        }, function () {
          console.log(this.data.nowCharge)
        })
      },
      'fail': function (error) {
        console.log('用户信息获取失败')
      }
    })
  },
  priceInput: function (e) {
    const { value } = e.detail
    console.log(value)
    this.setData({
      price: value
    })
  },
  submit() {
    var that = this
    wx.showLoading({
      title: '支付中',
    })
    var data = {
      'total_fee': that.data.price,
      'success': function (res) {
        wx.hideLoading()
        wx.showToast({
          title: '支付成功',
          icon: 'success',
          duration: 1500
        })
        that.setData({
          nowCharge: res.charge
        })
      },
      'fail': function (error) {
        wx.hideLoading()
        wx.showToast({
          title: error,
          icon: 'none',
          duration: 1500
        })
      }
    }

    chargeUtils.paymentByCharge(data)
  }
});