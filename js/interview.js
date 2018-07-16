let obj = {};
let arr = [];

// console.log(typeof obj === 'object');
// console.log(typeof arr === 'object');
// console.log(typeof null === 'object');

console.log(Object.prototype.toString.call(obj));
console.log(Object.prototype.toString.call(arr));
console.log(Object.prototype.toString.call(null));

(function() {
  var a = b = 3;
})();
console.log("a defined? " + (typeof a !== 'undefined'));
console.log("b defined? " + (typeof b !== 'undefined'));

var myObject = {
  foo: "bar",
  func: function() {
      var self = this;
      console.log("outer func:  this.foo = " + this.foo);
      console.log("outer func:  self.foo = " + self.foo);
      (function() {
          console.log("inner func:  this.foo = " + this.foo);
          console.log("inner func:  self.foo = " + self.foo);
      }());
  }
};
myObject.func();
