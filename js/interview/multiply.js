/**
 * 1. 让下面的代码可以运行： 
 * const a = [1, 2, 3, 4, 5];
 * // Implement this
 * a.multiply();
 * console.log(a); // [1, 2, 3, 4, 5, 1, 4, 9, 16, 25]
 */
Array.prototype.multiply = function() {
  var newArray = this.map(function(curr, idx) {
    return curr * curr;
  });
  console.log(this);
  console.log(newArray);
  this.shift();
  this.shift();
  return this.concat(newArray);
}

const a = [1, 2, 3, 4, 5];
a.multiply();
console.log(a);
