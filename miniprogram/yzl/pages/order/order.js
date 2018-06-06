Page({
  data: {
    noOrder: false,
    tabs: [
			{title: '全部', content: ''},
      {title: '待付款', content: '内容一'},
      {title: '已完成', content: '内容二'},
    ]
  },
  handleTabChange(selectedId) {
    console.log(selectedId);
  },
  onClick: function(e) {
    console.log(`ComponentId:${e.detail.componentId},you selected:${e.detail.key}`);
  }
})
