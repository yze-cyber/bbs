<?php
$host = "localhost";
$user = "root";
$password = "yzk0826..";
$conn = new mysqli($host, $user, $password);
if($conn->connect_error){
    die("连接失败".$conn->connect_error);
}else{
    echo "连接成功";
}