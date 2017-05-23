<?php

echo '<h1>PDO</h1>';

// try {
//     $dbh = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
//     foreach ($dbh->query('SELECT * from test_main') as $row) {
//         print_r($row);
//     }
//     $dbh = null;
// } catch (PDOException $e) {
//     print "error! : " . $e->getMessage() . "</br>";
//     die();
// }

    // $dbh = new PDO('mysql:host=localhost;dbname=blog', 'root', '', array(
    //     PDO::ATTR_PERSISTENT => true  //连接持久化
    // ));
    // 在此使用连接

    // 现在运行完成,在此关闭连接
    // $dbh = null;

/* 在事务中执行批处理 */

try {
    $dbh = new PDO('mysql:host=localhost;dbname=blog', 'root', '', array(
        PDO::ATTR_PERSISTENT => true  //连接持久化
    ));
    echo "Connected </br>";
} catch (Exception $e) {
    die("Unable to connect: " . $e->getMessage());
}

// try {
//     $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     $dbh->beginTransaction();
//     $dbh->exec("insert into test_main (nikename, mobile, password) values ('transation', '18866668788', '2150')");
//     $dbh->exec("insert into test_belong (main_id, content) values (3, 'pdopdopdo')");
//     $dbh->commit();
// } catch (Exception $e) {
//     $dbh->rollback();
//     echo "Failed: " . $e->getMessage();
// }

//通过用 name 和 value 替代相应的命名占位符来执行一个插入查询
// try {
//     $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     $dbh->beginTransaction();

//     /* 用预处理语句进行重复插入 */
//     $stmt = $dbh->prepare("INSERT INTO test_main (nikename, mobile, password) VALUES (:nikename, :mobile, :password)");
//     $stmt->bindParam(':nikename', $nickname);
//     $stmt->bindParam(':mobile', $mobile);
//     $stmt->bindParam(':password', $password);

//     //插入一行
//     $nickname = 'wsx';
//     $mobile = '13566885986';
//     $password = '2150';
//     $stmt->execute();

//     //用不同的值 插入另一行
//     $nickname = 'xxx';
//     $mobile = '13566994477';
//     $password = '5021121';
//     $stmt->execute();

//     $dbh->commit();
// } catch (Exception $e) {
//     $dbh->rollback();
//     echo "Failed: " . $e->getMessage();
// }

//通过用 name 和 value 取代 ? 占位符的位置来执行一条插入查询。
try {
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbh->beginTransaction();

    /* 用预处理语句进行重复插入 */
    $stmt = $dbh->prepare("INSERT INTO test_main (nikename, mobile, password) VALUES (?, ?, ?)");
    $stmt->bindParam(1, $nickname);
    $stmt->bindParam(2, $mobile);
    $stmt->bindParam(3, $password);

    //插入一行
    $nickname = 'wsx';
    $mobile = '13566885986';
    $password = '2150';
    $stmt->execute();

    //用不同的值 插入另一行
    $nickname = 'xxx';
    $mobile = '13566994477';
    $password = '5021121';
    $stmt->execute();

    $dbh->commit();
} catch (Exception $e) {
    $dbh->rollback();
    echo "Failed: " . $e->getMessage();
}