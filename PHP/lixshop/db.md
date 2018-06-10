数据库设计

## Mysql

### Admin

admin_user 管理员
id username password_hash password_reset_token person mobile auth_key status created_at updated_at access_token

admin_role 权限表

id role_name role_description

admin_user_role 用户权限表

id admin_id role_id

admin_visit_log 日志表

id account person created_at menu url url_key

### Customer

customer 顾客表

id wechat_openid mobile type created_at updated_at access_token favorite_product_count access_token_created_at 

customer_address 顾客地址表

id uid name telephone province city district street is_default created_at updated_at

### 产品

product_flat_stock 产品库存表

id product_id stock

product_custom_option_stock 产品custom option类型产品对应的库存信息

id product_id custom_option_key stock

sales_coupon 优惠券表

id created_person coupon_name coupon_description coupon_code expiration_date users_per_customer times_used type conditions discount created_at updated_at

sales_coupon_usage 优惠券使用表

id coupon_id customer_id times_used

sales_flat_cart 购物车表

id items_count customer_id customer_name customer_is_guest remote_ip coupon_code 

sales_flat_cart_item 购物车项目表

id cart_id product_id count custom_option_key active created_at updated_at

sales_flat_order 订单表

id increment_id order_status items_count total_amount discount_amount customer_id customer_group cutomer_name remote_ip coupon_code payment_method address_id order_remark txn_type txn_id created_at updated_at

sales_flat_order_item 订单产品表

id order_id item_id customer_id product_id custom_option_sku name image count price row_total redirect_url created_at updated_at 

### 充值
顾客表添加余额字段

充值商品表 charge_product
id amount gift discount

充值订单表
id trade_no order_status total_amount discount_amount real_amount customer_id customer_group remote_ip payment_method txn_id created_at updated_at




## Mongodb

Favorite 产品收藏信息表

product_id user_id created_at updated_at

review 产品评论

product_id product_custom_option_key rate_star name user_id ip summary review_content review_date status audit_user audit_date

product_flat 产品信息表

created_at created_user_id updated_at name spu sku status count min_sales_count is_in_stock category price cost_price meta_keywords meta_description image description custom_option review_count reviw_rate_star


