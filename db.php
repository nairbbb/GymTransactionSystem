<?php

$conn = mysqli_connect('localhost', 'root', '', 'testdb');

if(mysqli_connect_errno()) {
    echo 'failed to connect to mysql', mysqli_connect_errno();
}


?>