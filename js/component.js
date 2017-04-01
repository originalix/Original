Vue.component('my-component', {
    template: '<div> test  something </div>'
})

Vue.component('simple-counter', {
    template: '<button v-on:click="counter += 1">{{ counter }}</button>',
    data: function() {
        return {
            counter: 0
        }
    }
})

var child = {
    template: '<div><code>class func getUserStepsStats<pre></pre></code></div>'
}


var example1 = new Vue({
    el: '#example-1'
})


var example2 = new Vue({
    el: '#example-2',
    components: {
        'my-component1': child
    }
})

var example3 = new Vue({
    el: '#example-3'
})