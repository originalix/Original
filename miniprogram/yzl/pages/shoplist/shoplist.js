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
    setTimeout(this.mockProduct, 100)
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
      'id' : 0,
      'image': 'http://140.143.8.19/code-repo/PHP/lixshop/backend/web/uploads/temp/78145dcf5ea44b0b89afc2f3392445a3.jpg',
      'title': '衬衫哦哦哦',
      'price': '16.00',
      'badge': 0
    }
    var ptli = []
    for(var i = 0; i < 40; i++) {
      pt.id = i;
      console.log(pt.id)
      ptli.push(pt)
    }
    this.setData({
      productList: ptli
    }, function () {})
  },
  changeData() {
    var str = "productList[0].badge"
    this.setData({
      [str]: 1
    }, function () {})
  },
  // addBadge(item) {
  //   var item = "productList[item.id].badge"
  //   var newData = item.badge += 1
  //   var that = this
  //   that.setData({
  //     [item]: newData
  //   }, function () {})
  // },
  addBadge: function (event) {
    console.log(event)
    var item = event.currentTarget.dataset.item
    console.log(item.id)
    var targetBadge = "productList[0].badge"
    var newData = item.badge += 1
    var that = this
    that.setData({
      [targetBadge]: newData
    }, function () {})
  },
  onClick: function(e) {
    console.log(`ComponentId:${e.detail.componentId},you selected:${e.detail.key}`);
  }
})
