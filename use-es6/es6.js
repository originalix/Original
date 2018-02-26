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
function f() { console.log('I am outside!'); }

(function () {
  function f() { console.log('I am inside!'); }
  if (false) {
  }
  f();
}());