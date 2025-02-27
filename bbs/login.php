<?php
//开启会话，用于存储用户登录状态
session_start();
// 数据库连接信息
$servername = "localhost";
$username = "root"; // 修改为您的数据库用户名
$password = "yzk0826.."; // 修改为您的数据库密码
$dbname = "mybbs";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 检查表单提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // 查询用户信息
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // 验证密码
        if ($row['password'] === $inputPassword) { // 可以改为密码加密验证
            $_SESSION['username'] = $inputUsername; // 存储用户名到Session
            header("Location: loginsuccess.php"); // 改为跳转到PHP文件
            exit();
        } else {
            echo "<script>alert('密码错误，请重新输入！');history.back();</script>";
        }
    } else {
        echo "<script>alert('用户不存在，请检查用户名！');history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
