<?php
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
    $inputUsername = trim($_POST['username']);
    $inputPassword = trim($_POST['password']);
    $inputEmail = trim($_POST['email']);

    // 输入验证
    if (empty($inputUsername) || empty($inputPassword) || empty($inputEmail)) {
        echo "<script>alert('请填写所有必填字段！');history.back();</script>";
        exit();
    }

    // 检查用户名是否已存在
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('用户名已存在，请重新输入！');history.back();</script>";
    } else {
        // 插入新用户数据
        $insertSql = "INSERT INTO users (username, password, email, level) VALUES (?, ?, ?, 0)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("sss", $inputUsername, $inputPassword, $inputEmail);

        // 捕获插入错误并提供反馈
        if ($insertStmt->execute()) {
            echo "<script>alert('注册成功！');window.location.href='index.php';</script>";
        } else {
            // 捕获插入错误详细信息
            $error = $conn->error;
            echo "<script>alert('注册失败，请重试！错误信息: $error');history.back();</script>";
        }
        $insertStmt->close();
    }

    $stmt->close();
}

$conn->close();
?>
