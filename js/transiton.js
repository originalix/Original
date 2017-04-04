var demo = new Vue({
    el: '#demo',
    data: {
        show: true
    }
})

var example1 = new Vue({
    el: '#example-1',
    data: {
        show: true
    }
})

Vue.component('anchored-heading', {
  render: function (createElement) {
    return createElement(
      'h' + this.level,   // tag name 标签名称
      this.$slots.default // 子组件中的阵列
    )
  },
  props: {
    level: {
      type: Number,
      required: true
    }
  }
})

var example2 = new Vue({
    el: '#example-2'
})

var getChildrenTextContent = function (children) {
    return children.map(function (node) {
        return node.children
        ? getChildrenTextContent(node.children)
        : node.text
    }).join('')
}
