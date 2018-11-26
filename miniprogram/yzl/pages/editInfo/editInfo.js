var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var chargeUtils = require('../../utils/charge.js')
var appInstance = getApp()

const Dialog = require('../../bower_components/zanui-weapp/dist/dialog/dialog')

Page({
  data: {
    userInfo: {},
    mobileValue: "",
    nameValue: "",
    loading: false
  },
  onLoad() {
    this.getUserInfo()
  },
  getUserInfo() {
    var that = this
    chargeUtils.getUserMe({
      'success': function (res) {
        let mobile = ""
        let name = ""
        if (res.mobile !== null) {
          mobile = res.mobile
        }
        if (res.name !== null) {
          name = res.name
        }
        that.setData({
          userInfo: res,
          mobileValue: mobile,
          nameValue: name
        }, function () {
          console.log(this.data.userInfo)
        })
      },
      'fail': function (error) {
        console.log('用户信息获取失败')
      }
    })
  },
  nameInput: function (e) {
    const {
      value
    } = e.detail
    console.log(value)
    this.setData({
      nameValue: value
    })
  },
  mobileInput: function (e) {
    const {
      value
    } = e.detail
    console.log(value)
    this.setData({
      mobileValue: value
    })
  },
  submit() {
    var that = this
    that.setData({
      loading: true
    })
    console.log('Hello world')
    wx.request({
      url: config.service.editProfileInfoAPI,
      header: appInstance.requestToken,
      data: {
        'mobile': that.data.mobileValue,
        'name': that.data.nameValue
      },
      method: 'POST',
      success: function (res) {
        that.setData({
          loading: false
        })
        console.log(res)
        const code = res.data.code
        if (code === 200) {
          const response = res.data.data
          wx.showToast({
            title: '修改成功',
            icon: 'success',
            duration: 1500
          })
        } else {
          wx.showToast({
            title: res.data.msg,
            icon: 'none',
            duration: 1500
          })
        }
      },
      fail: function (error) {
        that.setData({
          loading: false
        })
        console.log(error)
        wx.showToast({
          title: error,
          icon: 'none',
          duration: 1500
        })
      }
    })
  }
})