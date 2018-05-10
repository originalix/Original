var config = require('../config.js');

const getOpenid = (code) => {
  wx.request({
    url: config.service.loginUrl,
    data: {
      'code': code
    },
    method: 'GET',
    success: function(res) {
      wx.hideLoading()
      let openid = res.data.data.openid
      if (typeof(openid) == "undefined") {
        console.log('openid undefined')
        // 获取openid失败
        wx.showModal({
          title: '提示',
          content: '读取用户信息有误，请点击确认重试',
          success: function(res) {
            if (res.confirm) {
              console.log('用户点击确定')
              login()
            } else if (res.cancel) {
              console.log('用户点击取消')
            }
          }
        })
      } else {

        getAccessTokenFromServer(openid)
      }
      console.log(openid)
    },
    fail: function(error) {
      // wx.hideLoading()
      console.log(error)
    }
  });
}

const login = () => {
  wx.showLoading({
    'title': '加载中'
  })

  wx.login({
    success(res) {
      console.log(res)
      getOpenid(res.code)
    },
    fail(res) {
      console.log(res)
    }
  })
}

const getAccessTokenFromServer = (openid) => {
  wx.showLoading()
  wx.request({
    url: config.service.tokenUrl,
    data: {
      'openid': openid
    },
    method: 'GET',
    success: function(res) {
      wx.hideLoading()
      let access_token = res.data.data.access_token
      let wechat_openid = res.data.data.wechat_openid
      if (typeof(access_token) == "undefined") {
        wx.showModal({
          title: '提示',
          content: '读取用户信息有误，请点击确认重试',
          success: function(res) {
            if (res.confirm) {
              console.log('用户点击确定')
              login()
            } else if (res.cancel) {
              console.log('用户点击取消')
            }
          }
        })
      } else {
        try {
          wx.setStorageSync('access_token', access_token)
          wx.setStorageSync('openid', wechat_openid)
        } catch (e) {

        }
      }
      console.log(res)
    },
    fail: function(error) {
      // wx.hideLoading()
      console.log(error)
    }
  });
}

const getAuthInfo = () => {
  try {
    let accessToken = wx.getStorageInfo('access_token')
    let openid = wx.getStorageSync('openid')
    return {
      'accessToken': accessToken,
      'openid': openid
    }
  } catch (e) {
    return undefined
  }
}

module.exports = { getOpenid, login, getAccessTokenFromServer, getAuthInfo }
