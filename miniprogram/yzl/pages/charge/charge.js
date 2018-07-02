var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var chargeUtils = require('../../utils/charge.js');
var appInstance = getApp()

Page({
  data: {
    list: [],
    currentIdx: 9999,
    disabled: true,
    inputValue: '',
    balance: 0,
    // 1是点选金额，2是手动输入
    type: 0,
    payActionsheetShow: false,
    payActions: [{
      name: '微信支付'
    }],
    isShowPayView: true,
  },
  onLoad() {
    this.getUserInfo()
    this.getChargeList()
  },
  // 获取充值商品列表
  getChargeList() {
    let that = this
    chargeUtils.getChargeList({
      'success': function (res) {
        console.log('列表成功回调')
        that.setData({
          list: res
        })
      },
      'fail': function (error) {
        console.log('列表失败回调')
      }
    })
  },
  // 获取用户信息
  getUserInfo() {
    let that = this
    chargeUtils.getUserMe({
      'success': function (res) {
        console.log(res)
        that.setData({
          balance: res.charge
        }, function () {
          console.log(this.data.balance)
        })
      },
      'fail': function (error) {
        console.log('用户信息获取失败')
      }
    })
  },
  // 充值列表的点击事件
  onClick(e) {
    let tapIdx = e.currentTarget.dataset.idx
    this.setData({
      currentIdx: tapIdx,
      disabled: false,
      inputValue: '',
      type: 1
    })
  },
  // 输入框的输入事件
  handleInput(e) {
    let value = e.detail.value
    this.setData({
      inputValue: value,
      disabled: false,
      type: 2
    })

    if (value.length < 1) {
      this.setData({
        disabled: true,
        type: 0
      })
    }
  },
  // 输入框获取到焦点的事件
  handleFocus(e) {
    let btnDisabled = false
    if (this.data.inputValue.length < 1) {
      btnDisabled = true
    }

    this.setData({
      currentIdx: 9999,
      disabled: btnDisabled
    })
  },
  // 输入框失去焦点事件
  handleBlur(e) {
    console.log('失去焦点')
    console.log(e)
  },
  // 创建充值订单
  createChargeOrder() {
    let that = this
    let type = this.data.type
    if (type === 0) {
      console.log(this.data.type)
      wx.showToast({
        title: '请选择或填写正确的充值金额',
        icon: 'none',
        duration: 1000
      })
      return
    }
    let params = {}
    if (type === 1) {
      let product = this.data.list[this.data.currentIdx]
      params = {
        'type': type,
        'product_id': product.id
      }
    } else if (type === 2) {
      params = {
        'type': type,
        'input_amount': this.data.inputValue
      }
    }

    let data = {
      'params': params,
      'success': function (res) {
        console.log(res)
        if (res.trade_no !== undefined && res.real_amount !== undefined) {
          let total_fee = res.real_amount * 100
          that.createWxOrder(res.trade_no, total_fee)
        }
      },
      'fail': function (error) {
        console.log(error)
      }
    }

    chargeUtils.createChargeOrder(data)
  },
  /**
   * 创建微信支付订单，微信支付统一下单接口
   */
  createWxOrder(trade_no, total_fee) {
    var that = this
    orderUtils.getPayParams({
      'trade_no': trade_no,
      'total_fee': total_fee,
      'type': 2,
      'success': function (res) {
        // 根据返回参数 拉起微信支付
        that.createWxPay(res)
      },
      'fail': function (error) {
        if (typeof error == 'string' || error instanceof String) {
          wx.showToast({
            title: error,
            icon: 'none',
            duration: 2000
          })
        }
      }
    })
  },
  /**
   * 使用JSAPI 调起微信支付
   */
  createWxPay(res) {
    var that = this
    const params = {
      'data': res,
      'success': function (res) {
        console.log('支付完成后的操作')
        wx.showToast({
          title: '支付成功',
          icon: 'success',
          duration: 2000
        })
        that.getUserInfo()
      },
      'fail': function (error) {
        console.log('支付失败后的操作')
      }
    }

    orderUtils.createWxPay(params)
  },
  /**
   *  显示微信支付弹窗
   */
  showPayActionsheet() {
    this.setData({
      payActionsheetShow: true,
      isShowPayView: false
    })
  },
  /**
   * 微信支付的点击事件
   */
  handlePayActionClick() {
    // this.createOrder()
    this.createChargeOrder()
    this.setData({
      payActionsheetShow: false,
      isShowPayView: true
    })
  },
  closePayActionsheet() {
    console.log('取消按钮1！！！')
    this.setData({
      payActionsheetShow: false,
      isShowPayView: true
    })
  }
})
