<?php
// Bắt đầu hoặc tiếp tục session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cấu hình chung
$logo_clb = "OIP (3).jpg"; 

// Giả lập xử lý form (Nếu có)
$message = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Trong môi trường thực, bạn sẽ kiểm tra và gửi email hoặc lưu vào database ở đây.
    // Giả lập thông báo thành công
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
        $message = "Cảm ơn bạn, tin nhắn của bạn đã được gửi thành công! Chúng tôi sẽ phản hồi sớm nhất có thể.";
    } else {
        $error = "Vui lòng điền đầy đủ tất cả các trường thông tin.";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ - Cổng Thông Tin Sinh Viên</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* CSS CƠ BẢN (Giống trang chủ) */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7f6;
            color: #333;
        }
        .header {
            background-color: #2f00ffff;
            color: white;
            padding: 10px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        .logo-box {
            display: flex;
            align-items: center;
        }
        .logo-img {
            height: 40px;
            margin-right: 15px;
            border-radius: 4px;
        }
        .logo-text {
            font-size: 20px;
            font-weight: 700;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            margin-left: 10px;
            font-weight: 500;
            transition: background-color 0.3s;
            border-radius: 4px;
        }
        .nav-links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: 40px;
            font-size: 14px;
        }

        /* CSS RIÊNG CHO LIÊN HỆ */
        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .section-title {
            font-size: 32px;
            color: #ff6a00;
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 3px solid #007bff;
            display: inline-block;
            padding-bottom: 10px;
            font-weight: 700;
        }
        
        .contact-layout {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        /* THÔNG TIN LIÊN HỆ (BÊN TRÁI) */
        .contact-info {
            flex: 1;
            min-width: 300px;
            padding-right: 20px;
        }
        .contact-info h2 {
            color: #007bff;
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 16px;
        }
        .info-item .icon {
            color: #ff6a00;
            font-size: 20px;
            margin-right: 10px;
            width: 25px;
            text-align: center;
        }
        .info-item p {
            margin: 0;
        }
        
        /* IFRAME MAP (Bên dưới thông tin) */
        .map-container {
            margin-top: 30px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ddd;
        }
        .map-container iframe {
            width: 100%;
            height: 250px;
            border: 0;
        }


        /* FORM LIÊN HỆ (BÊN PHẢI) */
        .contact-form {
            flex: 2;
            min-width: 400px;
            padding-left: 20px;
            border-left: 1px solid #eee;
        }
        .contact-form h2 {
            color: #007bff;
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        .form-group input:focus, .form-group textarea:focus {
            border-color: #080400ff;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 106, 0, 0.3);
        }
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        .submit-btn {
            background-color: #ff6a00;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            transition: background-color 0.3s, transform 0.1s;
        }
        .submit-btn:hover {
            background-color: #cc5400;
        }
        .submit-btn:active {
            transform: scale(0.98);
        }

        /* MESSAGE BOX */
        .message-box {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }
        .message-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }


        /* Responsive */
        @media (max-width: 800px) {
            .contact-layout {
                flex-direction: column;
                padding: 20px;
            }
            .contact-form {
                padding-left: 0;
                border-left: none;
                padding-top: 20px;
                border-top: 1px solid #eee;
            }
            .contact-info {
                padding-right: 0;
            }
            .section-title {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    
    <!-- HEADER -->
    <header class="header">
        <div class="navbar">
            <div class="logo-box">
                <img src="<?= $logo_clb ?>" onerror="this.onerror=null;this.src='OIP (4).jpg'" alt="Logo" class="logo-img">
                <span class="logo-text">SINH VIÊN TÌNH NGUYỆN</span>
            </div>
            <nav class="nav-links">
                <a href="trangchu.php">Trang Chủ</a>
                <a href="lichtruc.php">Lịch Trực</a> 
                <a href="hoatdong.php">Hoạt Động</a>
                <a href="tintuc.php">Tin Tức</a>
                <a href="lienhe.php" style="background-color: rgba(255, 255, 255, 0.2);">Liên Hệ</a> <!-- Đánh dấu trang hiện tại -->
                <a href="dangnhap.php">Đăng Xuất</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <center>
            <h1 class="section-title">CHÚNG TÔI LUÔN SẴN SÀNG HỖ TRỢ BẠN</h1>
        </center>

        <div class="contact-layout">
            
            <!-- THÔNG TIN LIÊN HỆ VÀ BẢN ĐỒ -->
            <div class="contact-info">
                <h2>Thông Tin Liên Hệ</h2>
                <p>Nếu bạn có bất kỳ câu hỏi, đề xuất hợp tác hoặc muốn tham gia vào CLB, vui lòng liên hệ với chúng tôi qua các kênh dưới đây:</p>

                <div class="info-item">
                    <!-- Biểu tượng điện thoại (Sử dụng Emoji hoặc SVG đơn giản) -->
                    <span class="icon">&#x1F4DE;</span> 
                    <p><strong>Điện thoại:</strong> 0987 654 321 (Mr. Trưởng CLB)</p>
                </div>

                <div class="info-item">
                    <!-- Biểu tượng email -->
                    <span class="icon">&#x2709;&#xFE0F;</span>
                    <p><strong>Email:</strong> clb.tinhnguyen@dnu.edu.vn</p>
                </div>

                <div class="info-item">
                    <!-- Biểu tượng địa chỉ -->
                    <span class="icon">&#x1F4CD;</span>
                    <p><strong>Địa chỉ Văn phòng:</strong> Phòng 101, Tòa nhà A, Trường Đại học Nam.</p>
                </div>
                
                <!-- BẢN ĐỒ (Giả lập vị trí trường học) -->
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.872719717596!2d105.80387807490059!3d20.99849548906967!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac94665427b5%3A0x89798083a21691c9!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyDEkOG6oWkgTmFt!5e0!3m2!1svi!2sVN!4v1700660461877!5m2!1svi!2sVN" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Vị trí Trường Đại học Nam trên bản đồ">
                    </iframe>
                </div>

            </div>

            <!-- FORM GỬI TIN NHẮN -->
            <div class="contact-form">
                <h2>Gửi Tin Nhắn Cho Chúng Tôi</h2>
                
                <!-- Hiển thị thông báo (nếu có) -->
                <?php if ($message): ?>
                    <div class="message-box message-success"><?= $message ?></div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="message-box message-error"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST" action="lienhe.php">
                    <div class="form-group">
                        <label for="name">Họ và Tên</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Chủ đề (Tùy chọn)</label>
                        <input type="text" id="subject" name="subject">
                    </div>

                    <div class="form-group">
                        <label for="message">Nội dung Tin nhắn</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Gửi Liên Hệ</button>
                </form>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        &copy; 2025 CLB Tình Nguyện Đại Nam | Phát triển bởi Leaderbook.
    </footer>

</body>
</html>