/**
 * 1. 让下面的代码可以运行： 
 * const a = [1, 2, 3, 4, 5];
 * // Implement this
 * a.multiply();
 * console.log(a); // [1, 2, 3, 4, 5, 1, 4, 9, 16, 25]
 */
Array.prototype.multiply = function() {
  // var newArray = this.map(function(curr, idx) {
  //   return curr * curr;
  // });
  // 直接使用concat生成数组最方便 但是不能直接修改数组 而是返回新的值
  // return this.concat(newArray);
  
  // 如果需要直接修改结果 建议这样修改
  this.forEach(function(curr, idx) {
    this.push(curr * curr);
  }.bind(this));
}

const a = [1, 2, 3, 4, 5];
a.multiply();
console.log(a);
