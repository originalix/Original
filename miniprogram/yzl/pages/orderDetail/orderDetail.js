var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var chargeUtils = require('../../utils/charge.js')
var appInstance = getApp()

const Dialog = require('../../bower_components/zanui-weapp/dist/dialog/dialog')

Page({
  data: {
    steps: [],
    submitBtnType: 'order',
    productList: [],
    actionsheetShow: false,
    cancelWithMask: true,
    actions: [{
      name: '上门配送',
    }, {
      name: '到店取送',
    }],
    payActionsheetShow: false,
    payActions: [{
      name: '余额支付'
    }, {
      name: '微信支付'
    }],
    isShowPayView: true,
    expressType: 0,
    expressText: '上门配送',
    // 创建订单之后 缓存的订单数据
    orderInfo: {},
    // 是否已经创建订单
    isCreatedOrder: true,
    // 根据是否创建订单 显示提交按钮的文本  提交订单 or 去支付
    submitBtnText: '去支付',
    isPayment: false,
    userInfo: {}
  },
  onLoad(option) {
    console.log(option)
    this.initializeStatus(option.status)
    this.getUserInfo()
    this.getOrderDetail(option.id)
  },
  getOrderDetail (id) {
    // 根据id 获取订单详情
    var that = this
    orderUtils.getOrderDetail({
      'id': id,
      'success': function (res) {
        console.log('获取订单详情成功回调')
        console.log(res)
        that.setData({
          productList: res.items,
          orderInfo: res
        })
      },
      'fail': function (error) {
        console.log('获取订单详情失败回调')
      }
    })
  },
  /**
   *  根据支付状态 初始化部分数据
   */
  initializeStatus(statusStr) {
    let status = parseInt(statusStr)
    this.setStepsData(status)
    let title = '订单详情'
    let text = '已付款'
    let isPayMent = true

    // 根据支付状态 设置按钮样式
    if (status === 1) {
      title = '待付款的订单'
      text = '去支付'
      isPayMent = false
    }
    this.setData({
      submitBtnText: text,
      isPayment: isPayMent
    })

    wx.setNavigationBarTitle({
      title: title
    })
  },
  setStepsData(status) {
    var steps = [{
        current: false,
        done: false,
        text: '买家下单',
      },
      {
        done: false,
        current: false,
        text: '买家付款',
      },
      {
        done: false,
        current: false,
        text: '交易完成',
      }
    ]

    for (var i = 0; i < steps.length; i++) {
      if (i < status) {
        steps[i].done = true
        steps[i].current = false
      } else if (i == status) {
        steps[i].done = false
        steps[i].current = true
      }

      if (status === 3) {
        steps[2].current = true
      }
    }

    this.setData({
      steps: steps
    })
    console.log(this.data.steps)
  },
  /**
   *  创建订单函数
   */
  createOrder(paymentMethod) {
    var that = this

    if (this.data.isCreatedOrder === true) {
      let total_fee = this.data.orderInfo.real_amount * 100
      if (paymentMethod === 'wxpay') {
        that.createWxOrder(this.data.orderInfo.trade_no, total_fee)
      } else {
        that.confirmChargePay(this.data.orderInfo.trade_no, this.data.orderInfo.real_amount)
      }
      return
    }
    // that.setData({
    // orderInfo: res,
    // isCreatedOrder: true,
    // submitBtnText: '去支付'
    // }, function () {})

    // let total_fee = res.real_amount * 100
    // that.createWxOrder(res.trade_no, total_fee)
  },
  /**
   * 使用JSAPI 调起微信支付
   */
  createWxPay(res) {
    const params = {
      'data': res,
      'success': function (res) {
        console.log('支付完成后的操作')
      },
      'fail': function (error) {
        console.log('支付失败后的操作')
      }
    }

    orderUtils.createWxPay(params)
  },
  /**
   * 创建微信支付订单，微信支付统一下单接口
   */
  createWxOrder(trade_no, total_fee) {
    var that = this
    // const trade_no1 = "2018060515282019326307"
    // const total_fee1 = 3800
    orderUtils.getPayParams({
      'trade_no': trade_no,
      'total_fee': total_fee,
      'type': 1,
      'success': function (res) {
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
   *  检查余额是否够用
   */
  checkCharge() {
    console.log(this.data.userInfo.charge)
    console.log(this.data.orderInfo.real_amount)
    let charge = parseFloat(this.data.userInfo.charge)
    let price = this.data.orderInfo.real_amount
    if (charge < price) {
      console.log('余额不足，请使用其他支付方式支付')
      this.closePayActionsheet()
      Dialog({
        title: '温馨提醒',
        message: '您的余额不足，请使用其他方式支付',
        selector: '#zan-dialog-charge'
      }).then((res) => {
        console.log(res)
      })
    } else {
      console.log('余额充足可以使用')
      this.createOrder('charge')
    }
  },
  /**
   *  确认余额支付的逻辑
   */
  confirmChargePay(trade_no, total_fee) {
    console.log('使用余额支付，开始根据订单提示支付')
    console.log(total_fee)

    Dialog({
      title: '提示',
      message: `是否使用余额支付${total_fee}元消费`,
      buttons: [{
        text: '取消',
        type: 'cancel'
      }, {
        text: '确认',
        color: 'red',
        type: 'confirm'
      }],
      selector: '#zan-dialog-charge'
    }).then(({type}) => {
      if (type === 'confirm') {
        this.createChargePay(trade_no, total_fee)
      } else {

      }
    })
  },
  /**
   *  点击余额支付的逻辑
   */
  createChargePay(trade_no, total_fee) {
    let that = this
    orderUtils.createChargePay({
      'trade_no': trade_no,
      'total_fee': total_fee,
      'success': function (res) {
        if (res.code === 200) {
          wx.showToast({
            title: '支付成功',
            icon: 'success',
            duration: 1500
          })
          that.getOrderDetail(that.data.orderInfo.id)
          // 更改按钮状态
          that.setData({
            submitBtnText: '已付款',
            isPayment: true
          })
        }
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
   *  显示微信支付弹窗
   */
  showPayActionsheet() {
    this.setData({
      payActionsheetShow: true,
      isShowPayView: false
    })
  },
  /**
   * 支付ActionSheet的点击事件
   */
  handlePayActionClick({ detail }) {
    const {
      index
    } = detail;
    console.log(index)

    if (index === 0) {
      // 余额支付 
      this.checkCharge()
    } else {
      // 微信支付直接创建订单
      this.createOrder('wxpay')
    }

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
  },
  getUserInfo() {
    var that = this
    chargeUtils.getUserMe({
      'success': function (res) {
        console.log(res)
        that.setData({
          userInfo: res
        }, function () {
          console.log(that.data.userInfo)
        })
      },
      'fail': function (error) {
        console.log('用户信息获取失败')
      }
    })
  }
})
