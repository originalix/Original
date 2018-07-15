var config = require('../../config.js');
var appInstance = getApp()
var util = require('../../utils/util.js')
var auth = require('../../utils/auth.js')
var chargeUtils = require('../../utils/charge.js');

const Dialog = require('../../bower_components/zanui-weapp/dist/dialog/dialog')

Page({
  data: {
    imgUrls: [],
    indicatorDots: true,
    autoplay: true,
    interval: 5000,
    duration: 1000,
    categories: [],
    promotions: [],
    tips: '',
		userInfo: {},
  },
  onLoad: function (option) {
    if (appInstance.accessToken.length < 1) {
      this.beforeAction(option)
    } else {
      this.initialiaze(option)
    }
  },
  beforeAction (option) {
    var that = this
    var callback = function callback() {
      const authInfo = auth.getAuthInfo()
      console.log('beforeaction')
      appInstance.accessToken = auth.getAuthInfo().accessToken
      appInstance.requestToken = {
        'Authorization': 'Bearer ' + auth.getAuthInfo().accessToken
      }

      console.log(appInstance.accessToken)
      that.initialiaze(option)
    }
    auth.login(callback)
  },
  initialiaze(option) {
    this.getIndexConfig()
    this.getUserInfo()
    console.log(`option query is : `)
    console.log(option)
    if (option.shareid !== undefined) {
      this.recommendByShareId(option.shareid)
    }
  },
  onPullDownRefresh(){
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
        if (typeof (data.slideshow) != "undefined" && Array.isArray(data.slideshow)) {
          var imgs = [];
          for (let i = 0; i < data.slideshow.length; i++) {
            imgs.push(data.slideshow[i].url)
          }
          that.setData({
            imgUrls: imgs,
            tips: data.tips
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
	// 获取用户信息
	getUserInfo () {
		let that = this
		chargeUtils.getUserMe({
			'success': function (res) {
				that.setData({
					userInfo: res
				}, function () {
					console.log(this.data.userInfo)
				})
			},
			'fail': function (error) {
				console.log('用户信息获取失败')
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
  promotionClicked(e) {
    var that = this
    console.log(e)
    let promotionId = e.currentTarget.dataset.promotionid
    let needVip = e.currentTarget.dataset.needvip
    console.log(needVip)
    if (needVip === 0) {
      this.go2PromotionPage(promotionId)
      return
    }
    if (this.data.userInfo.card_id !== null) {
      this.go2PromotionPage(promotionId)
      return
    }
    Dialog({
      title: '温馨提醒',
      message: '该商品为会员专享，请充值后再购买',
      selector: '#zan-dialog-charge',
      buttons: [{
        text: '去充值',
        color: 'red',
        type: 'charge'
      }, {
        text: '确认',
        type: 'confirm'
      }]
    }).then(({type}) => {
      console.log(type)
      if (type === 'charge') {
        that.go2ChargePage()
      }
    })
  },
  go2PromotionPage(promotionId) {
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
