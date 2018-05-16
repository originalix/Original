var config = require('../../config.js');
var appInstance = getApp()

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
  onLoad: function () {
    this.getIndexConfig()
  },
  getIndexConfig() {
    var that = this;
    wx.request({
      url: config.service.indexConfigUrl,
      header: {
        'Authorization': 'Bearer ' + appInstance.accessToken
      },
      success: function (res) {
        let data = res.data.data;
        // 处理轮播图赋值
        if (typeof(data.slideshow) != "undefined" && Array.isArray(data.slideshow)) {
          var imgs = [];
          for (let i=0; i < data.slideshow.length; i++) {
            imgs.push(data.slideshow[i].url)
          }
          that.setData({
            imgUrls: imgs
          }, function () {
          })
        }

        // 处理category
        if (typeof(data.categories) != "undefined" && Array.isArray(data.categories)) {
          that.setData({
            categories: data.categories
          }, function () {})
        }

        // 处理promotions
        if (typeof(data.promotions) != "undefined" && Array.isArray(data.promotions)) {
          that.setData({
            promotions: data.promotions
          }, function () {})
        }
        console.log(data)
      }
    })
  },
  pushToShopList() {
    wx.navigateTo({
      url: '/pages/shoplist/shoplist'
    })
  }
})
