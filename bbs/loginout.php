<?php
// 启动会话（必须位于脚本最顶部）
session_start();

// 清空会话数据（同时清除内存和文件中的session）
session_unset();

// 销毁会话文件
session_destroy();

// 删除客户端session cookie（彻底清除会话标识）
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// 重定向到登录页（使用绝对路径更安全）
header("Location: index.php");
exit();
?>