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
    shareCount: 0,
  },
  onLoad: function (option) {
    if (appInstance.accessToken.length < 1) {
      this.beforeAction(option)
    } else {
      this.initialiaze(option)
    }
  },
  onShow() {
    this.getIndexConfig()
    this.getUserInfo()
  },
	onShareAppMessage: function (res) {
		console.log(res)
		if (res.from === 'button') {
			console.log('来自转发按钮')
    }
		console.log('path: -> ' + '/pages/index/index?shareid=' + this.data.userInfo.id)
		return {
			title: '衣之恋小程序分享',
			path: '/pages/index/index?shareid=' + this.data.userInfo.id
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
        wx.stopPullDownRefresh();
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
        // 处理shareCount
        if (data.share_count !== "undefined") {
          console.log('更新分享参数！！！')
          that.setData({
            shareCount: data.share_count
          })
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
    let needShareCount = e.currentTarget.dataset.sharecount
    console.log(needVip)
    if (needVip === 0) {
      // this.go2PromotionPage(promotionId)
      this.promotionCheckShareCount(needShareCount, promotionId)
      return
    }
    if (this.data.userInfo.card_id !== null) {
      // this.go2PromotionPage(promotionId)
      this.promotionCheckShareCount(needShareCount, promotionId)
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
        console.log('即将进入分享页面')
        that.go2ChargePage()
      }
    })
  },
  promotionCheckShareCount(needShareCount, promotionId) {
    console.log('检查爆款分享参数')
    console.log(needShareCount)
    console.log(promotionId)
    let that = this
    let shareCount = this.data.shareCount
    if (shareCount >= needShareCount) {
      console.log('通过分享数量检测')
      this.go2PromotionPage(promotionId)
      return
    }
    Dialog({
      title: '温馨提醒',
      message: `推荐${needShareCount}个有效关注，方可购买。 当前有效分享数：${shareCount}。`,
      selector: '#zan-dialog-charge',
      buttons: [{
        text: '去分享',
        color: 'red',
        type: 'charge'
      }, {
        text: '知道了',
        type: 'confirm'
      }]
    }).then(({type}) => {
      console.log(type)
      if (type === 'charge') {
        that.go2SharePage()
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
  },
  go2SharePage() {
    wx.navigateTo({
      url: '/pages/share/share?id=' + this.data.userInfo.id
    })
  },
  swiperClick(e) {
    console.log(e)
    let idx = e.currentTarget.dataset.idx
    switch (idx) {
      case 3:
        this.go2SharePage()     
        break;
    
      default:
        this.go2ChargePage()
        break;
    }
  }
})
