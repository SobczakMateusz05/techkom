<?php
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "techkom";
    $conn = @new mysqli($db_host, $db_user, $db_pass, $db_name);
    mysqli_query($conn,"SET NAMES utf8");
?>