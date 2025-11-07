<?php
session_start();

// Lấy dữ liệu nhập từ form
$username = $_POST['username'];
$password = $_POST['password'];

// Tài khoản mẫu (thay bằng dữ liệu từ database)
$tk = "admin";
$mk = "123";

// Kiểm tra đúng sai
if($username == $tk && $password == $mk) {
    $_SESSION['username'] = $username;  // Lưu phiên đăng nhập
    header("Location: trangchu.php"); // ✅ Chuyển đến trang chủ
    exit();
} else {
    echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu!'); window.location='dangnhap.php';</script>";
}
?>
