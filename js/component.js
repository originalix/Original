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

Vue.component('example4', {
    props: ['message'],
    template: '<span>{{ message }}</span>'
})

var exampleFour = new Vue({
    el: '#example-4'
})

Vue.component('example5', {
    props: ['myMessage'],
    template: '<span>{{ myMessage }}</span>'
})

var exampleFive = new Vue({
    el: '#example-5',
    data: {
        parentMsg: '组件消息传递'
    }
})

Vue.component('valid', {
    props: {
        propA: Number,
        propB: [String, Number],
        propC: {
            type:String,
            required: true
        }
    },
    template: '<span>{{ propC }}</span>'
})

var example6 = new Vue({
    el: '#example-6',
    data: {
        propC: 400
    }
})