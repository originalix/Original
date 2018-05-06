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
  },
  handleTabChange(selectedId) {
    console.log(selectedId);
  }
})
