let obj = {};
let arr = [];

// console.log(typeof obj === 'object');
// console.log(typeof arr === 'object');
// console.log(typeof null === 'object');

console.log(Object.prototype.toString.call(obj));
console.log(Object.prototype.toString.call(arr));
console.log(Object.prototype.toString.call(null));
