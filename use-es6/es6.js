/**
 * 1. Let命令
 */

 // 基本用法  let只在代码块中有效
{
    let a = 10;
    var b = 1;
}

// console.log(a);
// console.log(b);

// for (let i = 0; i < 10; i++) {
//     console.log(i);
// }

// console.log(i);

// 块级作用域 与 函数声明

// function f() { console.log('i am outside!'); }
// (function () {
//     if (false) {
//         function f() { console.log('i am inside!'); }
//     }

//     f();
// }());


// ES5 环境
// function f() { console.log('I am outside!'); }

// (function () {
//   function f() { console.log('I am inside!'); }
//   if (false) {
//   }
//   f();
// }());

// function log(x, y = 'javascript') {
//     console.log(x, y);
// }

// log('Hello');
// log('Hello', 'China');

// function Point(x=0, y=0) {
//     this.x = x;
//     this.y = y;
// }

// const p = new Point();
// console.log(p);

// 函数 箭头函数
const numbers = (...nums) => nums;
console.log(numbers(1, 2, 4, 21, 50));

let getTempItems = id => ({id: id, name: "temp"});
console.log(getTempItems(2150));

const full = ({first, last}) => first + ' ' + last;
// function Person(first, last) {
//     this.first = first;
//     this.last = last;
// }

let Person = (first, last) => ({first: first, last: last});

const person = Person('li', 'xxxxxxx');
console.log(full(person));
