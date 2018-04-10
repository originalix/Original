数据库设计


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

