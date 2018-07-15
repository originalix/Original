var config = require('../../config.js')
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
    promotion_id: null,
    sale_count: 0
  },
  onLoad(option) {
    console.log(option)
    this.setData({
      promotion_id: option.id
    })
    this.getPromotionDetail(option.id)
  },
  onShareAppMessage: function (res) {
		return {
			title: '衣之恋火爆拼团',
			path: '/page/promotion/promotion?id=' + this.data.promotion_id
		}
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
            product: response.data.product,
            sale_count: response.data.sale_count
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
  },
  onClick () {
    // 1、点击参团  判断有没有可选值
    let item = this.data.productList[0]
    if (item.customOption.length > 0) {
      this.selectCustomOption(item)
      return
    }

    this.addCartItem(item)
    // 2、有可选值、选可选值、并结算
    // 3、无可选值，直接跳到订单详情页
  },
  /**
   * 点击带customOption属性商品的点击事件
   * @param {*} item 
   */
	selectCustomOption (item) {
			console.log('存在可选值')
			var btnList = []
			for (var i=0; i<item.customOption.length; i++) {
				var btnItem = {
					text: item.customOption[i].custom_option_key,
					type: item.customOption[i].id
				}
				btnList.push(btnItem)
			}
			console.log(btnList)

			Dialog({
				message: '请选择商品具体类型',
				title: '温馨提醒',
				selector: '#zan-dialog-tip',
				buttons: btnList,
				buttonsShowVertical: true,
			}).then(({ type }) => {
				console.log('=== dialog with custom buttons ===', `type: ${type}`)
				item.selectCustomId = type
				console.log('=== now item is')
				console.log(item)
    		this.addCartItem(item)
			})
	},
	/*
	 * 添加商品进入购物车
	 */
	addCartItem: function (item) {
		console.log('add cart item')
    console.log(item)
    let customOption = this.getCustomOptionByItem(item)
    if (customOption !== null) {
      item = this.refreshItemByCustomOption(item, customOption)
    }
		var that = this
		var list = []
    // 添加产品进入list
    list.push(item)
    that.setData({
      cartList: list
    }, function () {
      that.pushToCreateOrderPage()
    })
  },
  getCustomOptionByItem (item) {
    if (item.selectCustomId === null) {
      return null
    }

    let customObj = null
    for (var i=0; i<item.customOption.length; i++) {
      let obj = item.customOption[i]
      if (obj.id === item.selectCustomId) {
        customObj = obj
        break
      }
    }
    console.log(`=========>>>>>> custom Obj is : `)
    console.log(customObj)
    return customObj
  },
  refreshItemByCustomOption (item, customOption) {
    item.selectCustom = customOption
    return item
  },
	/* 保存购物车的数据，传值到下个场景 */
	saveCartParams() {
		const that = this
		try {
			wx.setStorageSync('CART_LIST_DATA', that.data.cartList)
		} catch (e) {
			console.log(e)
		}
	},
	pushToCreateOrderPage() {
		this.saveCartParams()
    let url = '/pages/createOrder/createOrder'
    if (this.data.promotion_id !== null) {
      url = '/pages/createOrder/createOrder?promotionId=' + this.data.promotion_id
    }
		wx.navigateTo({
			url: url
		})
	}
})
