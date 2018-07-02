/**
 * 小程序配置文件
 */

// 此处主机域名修改成腾讯云解决方案分配的域名
// var host = 'https://yc9qpwz4.qcloud.la';
var host = 'https://wx.yzl1030.com'
// 专用于接口的https域名
var base_host = 'https://api.yzl1030.com'

var config = {

  // 下面的地址配合云端 Demo 工作
  service: {
    host,
    base_host,
    // 登录地址，用于建立会话
    loginUrl: `${host}/login/index`,
    // 获取Token地址
    tokenUrl: `${base_host}/v1/auth/token`,
    // 测试的请求地址，用于测试会话
    requestUrl: `${host}/user`,
    // 测试的信道服务地址
    tunnelUrl: `${host}/weapp/tunnel`,
    // 上传图片接口
    uploadUrl: `${host}/weapp/upload`,
    // 获取首页配置信息
    indexConfigUrl: `${base_host}/v1/home/index`,
    // 获取分类列表
    getCategoryListUrl: `${base_host}/v1/category/index`,
    // 根据分类id获取产品列表
    getProductByCategoryId: `${base_host}/v1/category/list`,
    // 创建微信支付订单接口
    createWxPayUrl: `${base_host}/v1/wxpay/create`,
    // 创建订单接口
    createOrderUrl: `${base_host}/v1/order/create`,
    // 查询订单列表接口
    getOrderListUrl: `${base_host}/v1/order/index`,
    // 获取订单详情接口
    getOrderDetailUrl: `${base_host}/v1/order/detail`,
    // 获取充值商品列表
    getChargeListUrl: `${base_host}/v1/charge/list`,
    // 创建充值订单
    createChargeOrderUrl: `${base_host}/v1/charge/create`,
    // 获取用户信息
    getUserMe: `${base_host}/v1/user/me`,
    // 获取会员页面配置信息
    getProfileUrl: `${base_host}/v1/profile/index`,
    // 获取消费日志
    getBalanceLog: `${base_host}/v1/balance/log`,
    // 获取优惠券列表
    getCouponListUrl: `${base_host}/v1/coupon/index`,
    // 兑换优惠券
    exchangeCouponUrl: `${base_host}/v1/coupon/exchange`,
    // 获取积分日志
    getCreditLog: `${base_host}/v1/credit/log`,
    // 推荐有奖api
    shareAndGetCouponAPI: `${base_host}/v1/share/index`,
    // 发起余额支付
    chargePayAPI: `${base_host}/v1/charge/pay`,
  }
};

module.exports = config;
