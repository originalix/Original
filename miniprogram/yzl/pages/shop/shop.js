Page({
  data: {
    message: 'Hello world!',
    array: [1, 2, 3, 4, 5],
    view: 'MINA',
    staffA: {firstName: 'Hulk', lastName: 'Hu'},
    staffB: {firstName: 'Shang', lastName: 'You'},
    staffC: {firstName: 'Gideon', lastName: 'Lin'},
    count: 1
  },
  add: function (e) {
    this.setData({
      count: this.data.count + 1,
    })
  },
  tapName: function(event) {
    console.log(event)
  },
  bindViewTap:function(event){
    event.currentTarget.dataset.alphaBeta === 1 // - 会转为驼峰写法
    event.currentTarget.dataset.alphabeta === 2 // 大写会转为小写
  }
})
