/**
 * JavaScript 中有哪些不同的数据类型？
 */
// 分为基础数据类型和引用数据类型
// 基础数据类型分为 String, Number, Boolean, Undefined, Null, Object, Symbol(ES6新加)
// 引用数据类型分为 Object、Array、Function、RegExp、Date、Math

var obj = new Proxy({}, {
  get: function(target, key, receiver) {
    console.log(`getting ${key}!`);
    return Reflect.get(target, key, receiver);
  },
  set: function(target, key, value, receiver) {
    console.log(`setting ${key}!`);
    return Reflect.set(target, key, value, receiver);
  }
});

obj.count = 1;
obj.count++;
