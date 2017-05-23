<?php

echo '<h1>PDO</h1>';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
    foreach ($dbh->query('SELECT * from test_main') as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print "error! : " . $e->getMessage() . "</br>";
    die();
}
