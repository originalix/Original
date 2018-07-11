var config = require('../../config.js');
var appInstance = getApp()
var util = require('../../utils/util.js')
var auth = require('../../utils/auth.js')

Page({
  data: {
    imgUrls: [],
    indicatorDots: true,
    autoplay: true,
    interval: 5000,
    duration: 1000,
    categories: [],
    promotions: [],
  },
  onLoad: function (option) {
    this.getIndexConfig()
    console.log(`option query is : `)
    console.log(option)
    if (option.share_id !== undefined) {
      this.recommendByShareId(option.share_id)
    }
  },
  onPullDownRefresh(){
    this.getIndexConfig()
  },
  getIndexConfig() {
    if (appInstance.accessToken.length < 1 || appInstance.accessToken === null) {
      console.log('没有token return')
      appInstance.accessToken = '12312312313'
      appInstance.login()
      return
    }
    var that = this;
    wx.request({
      url: config.service.indexConfigUrl,
      header: {
        'Authorization': 'Bearer ' + appInstance.accessToken
      },
      success: function (res) {
        let data = res.data.data;
        // 处理轮播图赋值
        if (typeof (data.slideshow) != "undefined" && Array.isArray(data.slideshow)) {
          var imgs = [];
          for (let i = 0; i < data.slideshow.length; i++) {
            imgs.push(data.slideshow[i].url)
          }
          that.setData({
            imgUrls: imgs
          }, function () {})
        }

        // 处理category
        if (typeof (data.categories) != "undefined" && Array.isArray(data.categories)) {
          that.setData({
            categories: data.categories
          }, function () {})
        }

        // 处理promotions
        if (typeof (data.promotions) != "undefined" && Array.isArray(data.promotions)) {
          that.setData({
            promotions: data.promotions
          }, function () {})
        }
        console.log(data)
      }
    })
  },
  pushToShopList(e) {
    const categoryId = e.currentTarget.dataset.id
    console.log('categoryId is : ' + categoryId)
    wx.navigateTo({
      url: '/pages/shoplist/shoplist?id=' + categoryId
    })
  },
  /**
   * 如果用户是被推荐进小程序的，执行此推荐有礼的代码
   */
  recommendByShareId(id) {
    wx.request({
      url: config.service.shareAndGetCouponAPI,
      header: appInstance.requestToken,
      data: {
        'recommend_id': id
      },
      method: 'GET',
      success: function (res) {
        console.log(res)
        const code = res.data.code
        if (code !== 200) {
          wx.showToast({
            title: res.data.msg,
            icon: 'none',
            duration: 1500
          })
        }
      },
      fail: function (error) {
        console.log(error)
      }
    })
  },
  go2PromotionPage(e) {
    console.log(e)
    let promotionId = e.currentTarget.dataset.promotionid
    wx.navigateTo({
      url: '/pages/promotion/promotion?id=' + promotionId
    })
  },
  go2AppointmentPage() {
    wx.navigateTo({
      url: '/pages/appointment/appointment'
    })
  },
  go2IntroducePage() {
    wx.navigateTo({
      url: '/pages/introduce/introduce'
    })
  },
  go2GroupPage() {
    wx.navigateTo({
      url: '/pages/group/group'
    })
  },
  go2ScopePage() {
    wx.navigateTo({
      url: '/pages/scope/scope'
    })
  },
  go2PriceMenuPage() {
    wx.navigateTo({
      url: '/pages/priceMenu/priceMenu'
    })
  },
  go2ChargePage(e) {
    wx.navigateTo({
      url: '/pages/charge/charge'
    })
  }
})
