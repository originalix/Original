// async 函数示例
async function timeout(ms) {
  await new Promise((resolve) => {
    setTimeout(resolve, ms);
  });
}

async function asyncPrint(value, ms) {
  await timeout(ms);
  console.log(value);
}

asyncPrint('hello world', 500);

// 返回Promise对象
async function f() {
  return 'hello lix';
}

f().then(v => console.log(v))

// async 函数内部抛出错误，会导致返回的Promise对象变为reject状态
async function f1() {
  throw new Error('出错了哦');
}

f1().then(
  v => console.log(v),
  e => console.log(e)
)
