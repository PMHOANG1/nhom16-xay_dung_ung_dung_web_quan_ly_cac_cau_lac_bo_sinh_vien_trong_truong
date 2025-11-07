<?php
// Tên file: muahexanh_detail.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$logo_clb = "OIP (3).jpg"; 

// Dữ liệu chi tiết cho Chiến dịch Mùa Hè Xanh
$activity = [
    'title' => 'Chiến dịch Mùa Hè Xanh 2025: Ánh Sáng Yêu Thương',
    'date' => '01/07/2025 - 15/07/2025',
    'location' => 'Xã Tả Phìn, Huyện Cao Bằng, Tỉnh Cao Bằng',
    'image' => 'OIP.jpg',
    'goals' => [
        'Xây dựng 01 khu vui chơi cho trẻ em tại điểm trường tiểu học.',
        'Tặng 500 bộ sách giáo khoa và đồ dùng học tập cho học sinh khó khăn.',
        'Tổ chức 03 buổi khám bệnh và phát thuốc miễn phí cho 200 hộ dân.',
        'Tổ chức giao lưu văn nghệ, tuyên truyền vệ sinh môi trường.'
    ],
    'schedule' => [
        'Ngày 1-2: Di chuyển và ổn định chỗ ở, làm quen địa phương.',
        'Ngày 3-10: Thực hiện các công trình xây dựng (khu vui chơi, sửa chữa nhà văn hóa).',
        'Ngày 11-13: Tổ chức các hoạt động y tế và tặng quà.',
        'Ngày 14: Tổng kết, giao lưu văn nghệ chia tay.',
        'Ngày 15: Trở về.'
    ],
    'contact' => 'Đồng chí Nguyễn Văn B, Trưởng ban Tổ chức: 0987-654-321'
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $activity['title'] ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* CSS CƠ BẢN */
        body { margin: 0; padding: 0; font-family: 'Roboto', sans-serif; background-color: #f4f7f6; color: #333; }
        .header { background-color: #0022ffff; color: white; padding: 10px 0; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
        .navbar { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px; }
        .logo-box { display: flex; align-items: center; }
        .logo-img { height: 40px; margin-right: 15px; border-radius: 4px; }
        .logo-text { font-size: 20px; font-weight: 700; }
        .nav-links a { color: white; text-decoration: none; padding: 8px 15px; margin-left: 10px; font-weight: 500; transition: background-color 0.3s; border-radius: 4px; }
        .nav-links a:hover { background-color: rgba(255, 255, 255, 0.2); }
        .footer { background-color: #333; color: white; text-align: center; padding: 15px 0; margin-top: 40px; font-size: 14px; }
        /* CSS RIÊNG CHO TRANG CHI TIẾT */
        .container { max-width: 900px; margin: 30px auto; padding: 20px; background-color: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); }
        h1 { color: #ff6a00; font-size: 36px; text-align: center; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        .hero-image { width: 100%; height: 400px; object-fit: cover; border-radius: 8px; margin-bottom: 25px; }
        .meta-info { display: flex; justify-content: space-around; background-color: #e6f7ff; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-size: 16px; font-weight: 500; }
        .meta-info span { color: #037af1ff; }
        .section { margin-bottom: 30px; padding: 0 10px; }
        .section h2 { color: #010b15ff; font-size: 24px; margin-bottom: 15px; border-left: 4px solid #ff6a00; padding-left: 10px; }
        ul { list-style: none; padding-left: 0; }
        ul li { background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="%23ff6a00" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>') no-repeat left center; 
            background-size: 16px; padding: 5px 0 5px 25px; line-height: 1.6; border-bottom: 1px dashed #eee; }
        /* Responsive */
        @media (max-width: 600px) {
            h1 { font-size: 28px; }
            .hero-image { height: 200px; }
            .meta-info { flex-direction: column; align-items: flex-start; gap: 10px; }
            .container { margin: 15px auto; padding: 10px; }
        }
    </style>
</head>
<body>
    
    <header class="header">
        <div class="navbar">
            <div class="logo-box">
                <img src="<?= htmlspecialchars($logo_clb) ?>" onerror="this.onerror=null;this.src='OIP (4).jpg'" alt="Logo" class="logo-img">
                <span class="logo-text">SINH VIÊN TÌNH NGUYỆN</span>
            </div>
            <nav class="nav-links">
                <a href="hoatdong.php">← Quay lại Hoạt Động</a>
                <a href="logout.php">Đăng Xuất</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1><?= $activity['title'] ?></h1>
        

        <img src="<?= htmlspecialchars($activity['image']) ?>" onerror="this.onerror=null;this.src='https://placehold.co/900x400/ff6a00/fff?text=Mua+He+Xanh';" alt="Ảnh Chiến Dịch" class="hero-image">
        
        <div class="meta-info">
            <strong>Thời gian:</strong> <span><?= $activity['date'] ?></span>
            <strong>Địa điểm:</strong> <span><?= $activity['location'] ?></span>
        </div>

        <div class="section">
            <h2>Mục Tiêu Chiến Dịch</h2>
            <ul>
                <?php foreach ($activity['goals'] as $goal): ?>
                    <li><?= $goal ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="section">
            <h2>Lịch Trình Dự Kiến</h2>
            <p>Chiến dịch kéo dài 15 ngày với các hoạt động chính sau:</p>
            <ul>
                <?php foreach ($activity['schedule'] as $item): ?>
                    <li><?= $item ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <div class="section">
            <h2>Thông Tin Liên Hệ</h2>
            <p>Để đăng ký tham gia hoặc đóng góp, vui lòng liên hệ:</p>
            <p style="font-weight: 700; color: #010b15ff;"><?= $activity['contact'] ?></p>
        </div>

    </div>

    <footer class="footer">
        &copy; 2025 CLB Tình Nguyện Đại Nam | Phát triển bởi Leaderbook.
    </footer>

</body>
</html>