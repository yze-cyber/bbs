<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // 未登录时跳回登录页
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>登录成功</title>
</head>
<body>
<h1>登录成功！</h1>
<p>当前登录用户：<?php echo $_SESSION['username']; ?></p>
<a href="loginout.php">退出登录</a>
</body>
</html>