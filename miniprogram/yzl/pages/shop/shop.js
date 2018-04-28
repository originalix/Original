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
  }
})
