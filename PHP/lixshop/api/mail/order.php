<p>
    <p>亲爱的老板你好，您有新的干洗订单：</p>
    <p>订单号: <?= $order->trade_no ?></p>
    <p>订单商品数量: <?= $order->items_count ?></p>
    <p>实际支付价格: <?= $order->real_amount ?></p>
    <p>顾客姓名: <?= $order->userName ?></p>
    <p>详细地址： <?= $order->province . $order->city . $order->county . $order->street ?></p>
    <p>联系电话：<?= $order->tel_number ?></p>
    <p>配送方式: 
        <?php  
            if ($order->express_type === 1) {
                echo '上门配送';
            } else {
                echo '到点取送';
            } 
        ?>
    </p>
    <p>配送时间: <?= $order->express_date ." ". $order->express_time ?></p>
    <p>交易备注: 
        <?php 
            if (is_null($order->order_remark) || strlen($order->order_remark) < 1) {
                echo "无";
            } else {
                echo $order->order_remark;
            }
        ?>
    </php>
</p>
