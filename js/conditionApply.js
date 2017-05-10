var example1 = new Vue({
    el: '#example-1',
    data: {
        ok: ''
    }
})

var example2 = new Vue({
    el: '#example-2',
    data: {
        type: 'C'
    }
})

var example3 = new Vue({
    el: '#example-3',
    data: {
        loginType: 'username'
    },
    methods: {
        doThis: function() {
            if (this.loginType === 'username') {
                this.loginType = 'email'
            } else {
                this.loginType = 'username'
            }
        }
    }
})

var example4 = new Vue({
    el: '#example-4',
    data: {
        ok: null
    }
})

var example5 = new Vue({
    el: '#example-5',
    data: {
        items: [
        ]
    }
})

var dataArray = new Array()
for (var i = 0; i < 3; i++) {
    var object = {message: 'Lix' + i}
    dataArray[i] = object
}
console.log(dataArray)
example5.items = dataArray

var example6 = new Vue({
    el: '#example-6',
    data: {
        parentMessage: 'Parent',
        items: [
            { message: 'Foo' },
            { message: 'Bar' }
        ]
    }
})

var example7 = new Vue({
    el: '#example-7',
    data: {
        items: [
            { msg: 'Foo' },
            { msg: 'Bar' }
        ]
    }
})

var example8 = new Vue({
    el: '#example-8',
    data: {
        object: {
            FirstName: 'Li',
            LastName: 'Xiao',
            Age: 18
        }
    }
})

var example9 = new Vue({
    el: '#example-9',
    data: {
        n: 100
    }
})



