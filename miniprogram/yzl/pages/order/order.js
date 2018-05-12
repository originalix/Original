// index.js
var qcloud = require('../../vendor/wafer2-client-sdk/index')
var config = require('../../config')
var util = require('../../utils/util.js')

Page({
  data: {
    noOrder: false,
    list: [{
      id: 'topay',
      title: '未完成'
    },
    {
      id: 'sign',
      title: '已完成'
    }],
    selectedId: 'topay',
    tabs: [
      {title: '选项一', content: '内容一'},
      {title: '选项二', content: '内容二'},
    ]
  },
  handleTabChange(selectedId) {
    console.log(selectedId);
  },
  login: function() {
    util.showBusy('正在登录')
    var that = this

    //调用登录接口
    qcloud.login({
      success(result) {
        if (result) {
          util.showSuccess('登录成功')
          console.log(result)
        } else {
          qcloud.request({
            url: config.service.requestUrl,
            login: true,
            success(result) {
              util.showSuccess('登录成功 else')
              console.log(result)
            },

            fail(error) {
              util.showModel('请求失败 else', error)
              console.log('request fail else', error)
            }
          })
        }
      },
      fail(error) {
        util.showModel('请求失败', error)
        console.log('request fail', error)
      }
    })
  },
  onClick: function(e) {
    console.log(`ComponentId:${e.detail.componentId},you selected:${e.detail.key}`);
  }
})
