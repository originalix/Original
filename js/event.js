var example = new Vue({
    el: '#example-1',
    data: {
        counter: 0
    }
})

var example2 = new Vue({
  el: '#example-2',
  data: {
    name: 'Vue.js'
  },
  methods: {
    greet: function (event) {
      alert('Hello ' + this.name + '!')
      alert(event.target.tagName)
    }
  }
})

var example3 = new Vue({
    el: '#example-3',
    methods: {
        say: function(message) {
            alert(message)
        }
    }
})

var example4 = new Vue({
    el: '#example-4',
    methods: {
        doThis: function() {
            alert('do This')
        },
        doThat: function() {
            alert('do That')
        },
        howtodo: function() {
            alert('how to do')
        }
    }
})

var example5 = new Vue({
    el: '#example-5',
    methods: {
        doThis: function() {
            alert('do this is a thing')
        },
        doThat: function() {
            alert('do That')
        }
    }
})

var example6 = new Vue({
    el: '#example-6',
    methods: {
        submit: function() {
            alert('submit')
        }
    }
})

var example7 = new Vue({
    el: '#example-7',
    methods: {
        doSomething: function() {
            alert('do some thing a')
        }
    }
})