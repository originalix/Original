<?php
    //Get the private context
    session_name('Private');
    session_start();
    $private_id = session_id();
    $b = $_SESSION['pr_key'];
    session_write_close();
 ?>
