### 鉴权

> 生成或查询顾客信息(无状态下请求access_token)

auth/index (GET)

请求参数: wechat_openid mobile
响应: user信息

### 商品

> 商品列表接口

product/index (GET)
请求参数 page
响应：商品信息集合

> 商品分类接口

product/category (GET)
响应：所有分类信息

> 根据分类 获取商品列表接口

请求参数 category int