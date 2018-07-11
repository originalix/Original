var config = require('../config.js');

const getOpenid = (code, callback) => {
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
              // console.log('用户点击确定')
              login()
            } else if (res.cancel) {
              // console.log('用户点击取消')
            }
          }
        })
      } else {

        getAccessTokenFromServer(openid, callback)
      }
    },
    fail: function(error) {
    }
  });
}

const login = (callback) => {
  wx.showLoading({
    'title': '加载中'
  })

  wx.login({
    success(res) {
      getOpenid(res.code, callback)
    },
    fail(res) {
      
    }
  })
}

const getAccessTokenFromServer = (openid, callback) => {
  wx.showLoading()
  wx.request({
    url: config.service.tokenUrl,
    data: {
      'openId': openid
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
              // console.log('用户点击确定')
              login()
            } else if (res.cancel) {
              // console.log('用户点击取消')
            }
          }
        })
      } else {
        try {
          wx.setStorageSync('access_token', access_token)
          wx.setStorageSync('openid', wechat_openid)
          callback()
        } catch (e) {

        }
      }
    },
    fail: function(error) {
    }
  });
}

const getAuthInfo = () => {
  try {
    let accessToken = wx.getStorageSync('access_token')
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
