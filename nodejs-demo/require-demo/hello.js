// 创建模块 方法一
// var world = function() {
//     console.log('Love wsxxxxxx');
// }

// exports.world = world;

// 方法二
// exports.world = function() {
//     console.log('Hello world');
// }

function Hello() {
    var name;
    this.setName = function(thyName) {
        name = thyName;
    };
    this.sayHello = function() {
        console.log('Hello ' + name);
    };
};

module.exports = Hello;
