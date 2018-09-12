var Mock = require('mockjs');
Mock.setup({
  timeout: 500
});
var data = Mock.mock({
  'list|1-10': [{
    'id|+1': 1
  }]
});
Mock.mock(/login/,function(){
  return {
      code: 200,
      tocken: 'zheshidenglu'
  }
});
console.log(JSON.stringify(data, null, 2));
