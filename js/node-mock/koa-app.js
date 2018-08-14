const Koa = require('koa');
const Router = require('koa-router');

const app = new Koa();
const router = new Router();

// logger
app.use(async (ctx, next) => {
  await next();
  const rt = ctx.response.get('X-Response-Time');
  console.log(`${ctx.method} ${ctx.url} - ${rt}`);
});

// X-response-time
app.use(async (ctx, next) => {
  const start = Date.now();
  await next();
  const ms = Date.now() - start;
  ctx.set('X-Response-Time', `${ms}ms`);
});

// set response type
app.use(async (ctx, next) => {
  await next();
  ctx.response.type = 'json';
})

router.get('/', (ctx, next) => {
  ctx.body = { data: 'Hello World' };
});

router.get('/test', (ctx, next) => {
  ctx.body = { data: 'Test' };  
});

app
  .use(router.routes())
  .use(router.allowedMethods());

app.listen(3000);
