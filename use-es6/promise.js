// Promise对象的简单例子
function timeout(ms) {
  return new Promise((resolve, reject) => {
    setTimeout(resolve, ms, 'done');
  });
}

timeout(100).then((value) => {
  console.log(value);
});

// Promise 新建后 立即执行的特性
let promise = new Promise(function(resolve, reject) {
  console.log('Promise');
  resolve();
});

promise.then(function() {
  console.log('resolve');
});

console.log('Hi');

// 异步加载图片示例
function loadImageAsync(url) {
  return new Promise(function(resolve, reject) {
    const image = new Image();

    image.onload = function() {
      resolve(image);
    };

    image.onerror = function() {
      reject(new Error('Could not load image at ' + url));
    };

    image.src = url;
  });
}

// 用promise对象实现Ajax操作的示例
const getJSON = function (url) {
  const promise = new Promise(function(resolve, reject) {
    const handler = function() {
      if (this.readyState !== 4) {
        return;
      }
      if (this.status === 200) {
        resolve(this.response);
      } else {
        reject(new Error(this.statusText));
      }
    };
    const client = new XMLHttpRequest();
    client.open('GET', url);
    client.onreadystatechange = handler;
    client.responseType = 'json';
    client.setRequestHeader('Accept', 'application/json');
    client.send();
  });

  return promise;
};

// Ajax使用示例
// getJSON('https://api.yzl1030.com/test/ip').then(function(json) {
//   console.log('Contents: ', json);
// }, function(error) {
//   console.error('出错了', error);
// });

// resolve的函数参数 可能是另一个Promise实例
// const p1 = new Promise(function(resolve, reject) {
//   setTimeout(() => reject(new Error('fail')), 3000);
// });

// const p2 = new Promise(function(resolve, reject) {
//   setTimeout(() => resolve(p1), 1000);
// });

// p2
//   .then(result => console.log(result))
//   .catch(error => console.log(error));

new Promise((resolve, reject) => {
  resolve(1);
  console.log(2);
}).then(r => {
  console.log(r);
});

// getJSON('https://api.yzl1030.com/test/ip').then(function(json) {
//   return json;
// }).then(function(post) {
//   // ...
// });

// catch的使用
const promise1 = new Promise(function(resolve, reject) {
  throw new Error('test');
});

// promise1.catch(function(error) {
//   console.log(error);
// });

let thenable = {
  then: function(resolve, reject) {
    resolve(42);
  }
};

let p1 = Promise.resolve(thenable);
p1.then(function(value) {
  console.log(value);
});
