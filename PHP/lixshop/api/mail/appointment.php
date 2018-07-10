<p>
    <p>亲爱的老板你好，您有新的团购预约：</p>
    <p>购买平台: <?= $appointment->platform ?></p>
    <p>输入方式: 
        <?php  
            if ($appointment->enter_type === 1) {
                echo '手动输入';
            } else {
                echo '上传截图';
            } 
        ?>
    </p>
    <p>手动输入的团购券: 
        <?php 
            if (is_null($appointment->code) || strlen($appointment->code) < 1) {
                echo "无";
            } else {
                echo $appointment->code;
            }
        ?>
    </p>
    <p>衣服数量: <?= $appointment->clothes_count ?></p>
    <p>顾客姓名: <?= $order->userName ?></p>
    <p>详细地址： <?= $order->province . $order->city . $order->county . $order->street ?></p>
    <p>联系电话：<?= $order->tel_number ?></p>
</p>
