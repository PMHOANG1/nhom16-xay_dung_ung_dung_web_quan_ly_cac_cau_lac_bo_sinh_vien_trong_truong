<?php
// Bắt đầu hoặc tiếp tục session (Cần thiết cho các trang PHP)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cấu hình các đường dẫn ảnh và nội dung tĩnh
$logo_clb = "OIP (3).jpg"; // Logo CLB (hoặc DNU)
$welcome_message = "Chào mừng bạn đến với cổng thông tin trang chủ của CLB Tình Nguyện. Hãy cùng nhau lan tỏa yêu thương!";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Cổng Thông Tin Sinh Viên</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* CSS CƠ BẢN */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f9fafaff;
            color: #333;
        }

        /* HEADER & NAVIGATION */
        .header {
            background-color: #1100ffff; /* Màu cam chủ đạo */
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
            height: 40px; /* Kích thước logo */
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

        /* KHỐI CHÀO MỪNG CHẠY NGANG (MARQUEE EFFECT) */
        .marquee-container {
            width: 100%;
            height: 60px; /* Chiều cao cố định */
            background-color: #e6f7ff; /* Nền xanh nhạt */
            overflow: hidden;
            border-bottom: 2px solid #007bff;
            display: flex;
            align-items: center;
            white-space: nowrap; /* Ngăn nội dung bị xuống dòng */
        }

        .marquee-text {
            /* Hiệu ứng chạy từ phải sang trái */
            display: inline-block;
            padding-left: 100%; /* Bắt đầu từ ngoài cùng bên phải */
            font-size: 24px;
            font-weight: 700;
            color: #000811ff; /* Màu xanh nổi bật */
            animation: marquee 15s linear infinite; /* Tốc độ và kiểu lặp */
            will-change: transform; /* Tối ưu hóa hiệu suất */
        }

        @keyframes marquee {
            from { transform: translateX(0); }
            to { transform: translateX(-100%); } /* Di chuyển hết chiều rộng của văn bản */
        }

        /* NỘI DUNG CHÍNH */
        .main-content {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 3fr 1fr; /* Nội dung chính và Sidebar */
            gap: 20px;
        }

        .section-title {
            font-size: 24px;
            color: #ff6a00;
            border-left: 4px solid #007bff;
            padding-left: 10px;
            margin-bottom: 20px;
        }

        /* KHỐI TIN TỨC & SỰ KIỆN */
        .news-item {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .news-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .news-item h4 {
            margin-top: 0;
            color: #007bff;
            font-size: 18px;
        }

        .news-item p {
            font-size: 14px;
            color: #666;
        }

        /* SIDEBAR (Thông báo) */
        .sidebar {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar h3 {
            font-size: 20px;
            color: #ff0004ff;
            margin-top: 0;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .sidebar h3::before {
            content: "🔔";
            margin-right: 8px;
            font-size: 1.2em;
        }

        .notice-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #e0e0e0;
        }

        .notice-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .notice-item a {
            color: #333;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
        }

        .notice-item a:hover {
            color: #007bff;
        }

        .notice-date {
            display: block;
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }
        
        /* FOOTER */
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: 40px;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            .navbar {
                flex-direction: column;
            }
            .nav-links {
                margin-top: 10px;
            }
            .nav-links a {
                display: block;
                margin: 5px 0;
                text-align: center;
            }
            .marquee-text {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    
    <!-- HEADER -->
    <header class="header">
        <div class="navbar">
            <div class="logo-box">
                <!-- Sử dụng biến PHP cho đường dẫn logo -->
                <img src="<?= $logo_clb ?>" onerror="this.onerror=null;this.src='OIP (4).jpg'" alt="Logo" class="logo-img">
                <span class="logo-text">SINH VIÊN TÌNH NGUYỆN</span>
            </div>
            <nav class="nav-links">
                <a href="trangchu.php">Trang Chủ</a>
                <a href="lichtruc.php">Lịch Trực</a>
                <a href="hoatdong.php">Hoạt Động</a>
                <a href="tintuc.php">Tin Tức</a>
                <a href="lienhe.php">Liên Hệ</a>
                <a href="dangnhap.php">Đăng Xuất</a>
            </nav>
        </div>
    </header>

    <!-- KHỐI CHÀO MỪNG CHẠY NGANG -->
    <div class="marquee-container">
        <!-- Sử dụng biến PHP cho nội dung chạy -->
        <div class="marquee-text">
            <?= $welcome_message ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?= $welcome_message ?>
        </div>
    </div>

    <!-- NỘI DUNG CHÍNH -->
    <main class="main-content">
        
        <!-- CỘT CHÍNH: TIN TỨC & SỰ KIỆN -->
        <section class="main-section">
            <h2 class="section-title">Tin Tức & Sự Kiện Mới</h2>
            
            <div class="news-list">
                <!-- Item 1 -->
                <article class="news-item">
                    <h4><a href="#">[Sự kiện] Hè Tình Nguyện 2025: Lên Đường Đến Vùng Cao</a></h4>
                    <p>CLB chính thức khởi động chiến dịch Hè Tình Nguyện năm nay. Hạn đăng ký tham gia: 20/11/2025. Chi tiết xem tại đây...</p>
                    <span class="notice-date">10/11/2025</span>
                </article>

                <!-- Item 2 -->
                <article class="news-item">
                    <h4><a href="#">Đánh giá chất lượng hoạt động của các đội nhóm</a></h4>
                    <p>Vui lòng gửi báo cáo hoạt động quý III/2025 về ban quản lý trước ngày 15/11 để đánh giá và nhận phản hồi.</p>
                    <span class="notice-date">08/11/2025</span>
                </article>

                <!-- Item 3 -->
                <article class="news-item">
                    <h4><a href="#">Tuyển thành viên Ban Truyền thông năm học 2025-2026</a></h4>
                    <p>Cơ hội rèn luyện kỹ năng viết bài, thiết kế và quản lý mạng xã hội. Deadline nộp đơn: 25/11/2025.</p>
                    <span class="notice-date">05/11/2025</span>
                </article>
                
                <!-- Item 4 -->
                <article class="news-item">
                    <h4><a href="#">Báo cáo tài chính quý II và kế hoạch gây quỹ</a></h4>
                    <p>Công khai báo cáo tài chính quý II và kêu gọi ý tưởng cho sự kiện gây quỹ sắp tới.</p>
                    <span class="notice-date">01/11/2025</span>
                </article>
            </div>
        </section>

        <!-- CỘT PHỤ: THÔNG BÁO -->
        <aside class="sidebar">
            <h3>Thông Báo Quan Trọng</h3>
            <div class="notice-list">
                <!-- Thông báo 1 -->
                <div class="notice-item">
                    <a href="#">Lịch họp Ban Chấp Hành tuần 46</a>
                    <span class="notice-date">Ngày: 12/11/2025 | Địa điểm: P.101</span>
                </div>
                <!-- Thông báo 2 -->
                <div class="notice-item">
                    <a href="#">Hướng dẫn đăng ký tham gia CLB mới</a>
                    <span class="notice-date">Áp dụng từ ngày 01/11/2025</span>
                </div>
                <!-- Thông báo 3 -->
                <div class="notice-item">
                    <a href="#">Về việc nộp hồ sơ xin cấp chứng nhận TNV</a>
                    <span class="notice-date">Hạn cuối: 30/11/2025</span>
                </div>
                <!-- Thông báo 4 -->
                <div class="notice-item">
                    <a href="#">Kính mời tham dự Lễ kỷ niệm 10 năm thành lập CLB</a>
                    <span class="notice-date">Thời gian: 15:00, 20/12/2025</span>
                </div>
            </div>
        </aside>

    </main>

    <!-- FOOTER -->
    <footer class="footer">
        &copy; 2025 CLB Tình Nguyện Đại Nam | Phát triển bởi Leaderbook.
    </footer>

</body>
</html>