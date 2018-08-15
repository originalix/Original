const router = require('koa-router')();
const Mock = require('mockjs');
const Random = Mock.Random;

router.get('/koa', (ctx) => {
  ctx.body = Mock.mock({
    'image': [
      Random.image('200x100', '#fffcc33'),
      Random.image('200x100', '#fb0a2a'),
      Random.image('200x100'),
      Random.image('200x100'),
      Random.image('200x100')
    ]
  });
});

const category = Mock.mock({
  'data|5-10': [{
    'id|+1': 1,
    'name': Random.first(),
    'spread': {
      'title': Random.csentence(5, 10),
      'description': Random.csentence(15, 20),
      'image': Random.image('264x84'),
      'link': Random.url('http')
    },
    'items|5-10': [{
      'id|+1': 1,
      'name': Random.first(),
      'items|5-10': [{
        'id|+1': 1,
        'name': Random.first(),
        'image': Random.image('60x50'),
        'link': Random.url('http')
      }]
    }]
  }]
});

router.get('/category', (ctx) => {
  ctx.body = {
    'code': 200,
    'msg': 'success',
    category
  }
}); 

module.exports = router;
