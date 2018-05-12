Page({
  data: {
    noOrder: false,
    tabs: [
      {title: '选项一', content: '内容一'},
      {title: '选项二', content: '内容二'},
    ]
  },
  handleTabChange(selectedId) {
    console.log(selectedId);
  },
  onClick: function(e) {
    console.log(`ComponentId:${e.detail.componentId},you selected:${e.detail.key}`);
  }
})
