<?php
// Tên file: logout.php

// 1. Bắt đầu hoặc tiếp tục session
// (Đây là bước cần thiết để có thể thao tác với các biến $_SESSION và session_destroy())
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 2. Hủy bỏ tất cả các biến session
// Đây là cách an toàn để xóa dữ liệu người dùng hiện tại khỏi session
$_SESSION = array();

// 3. Hủy bỏ Cookie Session (Quan trọng cho bảo mật)
// Điều này đảm bảo rằng ngay cả cookie lưu trữ ID session cũng bị xóa
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Hủy session trên server
session_destroy();

// 5. Chuyển hướng người dùng về trang đăng nhập
// Theo đoạn code 2, trang đăng nhập là 'login.php'
header("Location: login.php"); 
exit; // Dừng việc thực thi script ngay lập tức sau khi chuyển hướng
?>