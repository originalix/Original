var config = require('../../config.js');
var appInstance = getApp()

Page({
  data: {
    tabs: [

    ]
  },
  onLoad() {
    setTimeout(this.getTab, 3000)
  },
  getTab() {
    var tlist = [
      {title: '选项一', content: '内容一'},
      {title: '选项二', content: 'jjwwwwww'},
      {title: '选项三', content: '内容三'},
      {title: '选项四', content: '内容四'},
      {title: '选项五', content: '内容五'},
      {title: '选项六', content: '内容六'}
    ]
    console.log(tlist);
    this.setData({
      tabs: tlist,
    }, function () {})
  },
  handleTabChange(selectedId) {
    console.log(selectedId);
  },
  onClick: function(e) {
    console.log(`ComponentId:${e.detail.componentId},you selected:${e.detail.key}`);
  }
})
