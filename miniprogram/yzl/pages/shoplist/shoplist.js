var config = require('../../config.js');
var appInstance = getApp()

Page({
  data: {
    tabs: [

    ],
    productList: [],
  },
  onLoad() {
    setTimeout(this.getTab, 100)
    setTimeout(this.mockProduct, 3000)
  },
  getTab() {
    var tlist = [
      {title: '洗衣'},
      {title: '洗鞋'},
      {title: '洗家纺'},
      {title: '洗窗帘'},
    ]
    console.log(tlist);
    this.setData({
      tabs: tlist,
    }, function () {})
  },
  mockProduct() {
    var pt = {
      'image': 'http://140.143.8.19/code-repo/PHP/lixshop/backend/web/uploads/temp/78145dcf5ea44b0b89afc2f3392445a3.jpg',
      'title': '衬衫哦哦哦',
      'price': '16.00'
    }
    var ptli = []
    for(var i = 0; i < 20; i++) {
      ptli.push(pt)
    }
    this.setData({
      productList: ptli
    }, function () {})
  },
  handleTabChange(selectedId) {
    console.log(selectedId);
  },
  onClick: function(e) {
    console.log(`ComponentId:${e.detail.componentId},you selected:${e.detail.key}`);
  }
})
