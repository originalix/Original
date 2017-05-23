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
    echo "Connected\n";
} catch (Exception $e) {
    die("Unable to connect: " . $e->getMessage());
}

try {
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbh->beginTransaction();

}
