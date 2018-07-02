var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var chargeUtils = require('../../utils/charge.js')
var appInstance = getApp()

const Dialog = require('../../bower_components/zanui-weapp/dist/dialog/dialog')

Page({
  data: {
    product: {},
    productList: [],
    cartList: [],
  },
  onLoad(option) {
    console.log(option)
    this.getPromotionDetail(option.id)
  },
  /**
   * 获取促销详情
   * @param {*} id 促销id
   */
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
          that.createProductList(response.data.product)
        }
      },
      fail: function (error) {
        wx.hideLoading()
        console.log(error)
      }
    })
  },
  /**
   * 模拟shoplist 创建商品数组
   * @param {*} product 商品对象 
   */
  createProductList(product) {
    let product_li = []
    const productInfo = {
      'id': product.id,
      'image': product.image[0],
      'title': product.name,
      'price': product.final_price,
      'badge': 1,
      'customOption': product.customOptionStock,
      'selectCustomId': null,
      'selectCustom': null
    }
    product_li.push(productInfo)
    this.setData({
      productList: product_li
    }) 
  }
  
})
