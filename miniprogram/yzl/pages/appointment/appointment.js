var config = require('../../config.js');
var util = require('../../utils/util.js');
var orderUtils = require('../../utils/order.js');
var chargeUtils = require('../../utils/charge.js')
var appInstance = getApp()

const Dialog = require('../../bower_components/zanui-weapp/dist/dialog/dialog')

Page({
  data: {
    buyTypeItems: [{
        name: 'DP',
        value: '大众点评'
      },
      {
        name: 'MT',
        value: '美团',
        checked: 'true'
      },
    ],
    submitTypeItems: [{
      name: 'TXT',
      value: '手动输入',
      checked: 'true'
      },
      {
        name: 'PIC',
        value: '上传截图',
      }
    ],
  },
  radioChange: function(e) {
    console.log('radio发生change事件，携带value值为：', e.detail.value)
  }
})

