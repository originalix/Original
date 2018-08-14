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

module.exports = router;
