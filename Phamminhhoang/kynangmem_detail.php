<?php
// Tên file: kynangmem_detail.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$logo_clb = "OIP (3).jpg"; 

// Dữ liệu chi tiết cho Workshop Kỹ năng Giao tiếp
$activity = [
    'title' => 'Workshop Kỹ năng Mềm: Giao tiếp Hiệu quả 4.0',
    'date' => 'Thứ Bảy, 25/05/2025 (8h00 - 11h30)',
    'location' => 'Hội trường Lớn, Tầng 3 Tòa Nhà A, Trường Đại học Nam',
    'image' => 'kn.jpg',
    'speaker' => 'TS. Nguyễn Văn A (Chuyên gia Tâm lý và Đào tạo Kỹ năng Mềm)',
    'topics' => [
        'Nguyên tắc vàng trong giao tiếp phi ngôn ngữ (body language).',
        'Lắng nghe chủ động và phản hồi xây dựng.',
        'Xử lý xung đột và bất đồng trong môi trường nhóm.',
        'Kỹ năng thuyết trình ấn tượng trước đám đông.'
    ],
    'registration' => 'Miễn phí. Đăng ký trước ngày 20/05/2025 qua form trực tuyến.',
    'note' => 'Người tham dự sẽ nhận được Chứng nhận tham gia (Certificate of Attendance) và tài liệu độc quyền.'
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
        /* CSS TỪ TRANG 1 (Mùa Hè Xanh) - Có thể tái sử dụng gần hết */
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
        h1 { color: #010b15ff; font-size: 36px; text-align: center; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        .hero-image { width: 100%; height: 400px; object-fit: cover; border-radius: 8px; margin-bottom: 25px; }
        .meta-info { display: flex; justify-content: space-around; background-color: #e5f5e5; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-size: 16px; font-weight: 500; }
        .meta-info span { color: #4CAF50; } /* Màu xanh lá cây cho workshop */
        .section { margin-bottom: 30px; padding: 0 10px; }
        .section h2 { color: #010b15ff; font-size: 24px; margin-bottom: 15px; border-left: 4px solid #4CAF50; padding-left: 10px; }
        ul { list-style: none; padding-left: 0; }
        ul li { background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="%234CAF50" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>') no-repeat left center; 
            background-size: 16px; padding: 5px 0 5px 25px; line-height: 1.6; border-bottom: 1px dashed #eee; }
        .speaker-box { background-color: #f0f0f0; padding: 15px; border-radius: 8px; text-align: center; margin-bottom: 25px; }
        .speaker-box p { margin: 5px 0; font-size: 18px; }
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
        

[Image of Professional speaker on stage]

        
        <img src="<?= htmlspecialchars($activity['image']) ?>" onerror="this.onerror=null;this.src='https://placehold.co/900x400/4CAF50/fff?text=Ky+Nang+Mem';" alt="Ảnh Workshop" class="hero-image">
        
        <div class="meta-info">
            <strong>Thời gian:</strong> <span><?= $activity['date'] ?></span>
            <strong>Địa điểm:</strong> <span><?= $activity['location'] ?></span>
        </div>

        <div class="speaker-box">
            <h2>Diễn Giả Chính</h2>
            <p style="font-weight: 700; color: #4CAF50;"><?= $activity['speaker'] ?></p>
        </div>

        <div class="section">
            <h2>Nội Dung Chính</h2>
            <ul>
                <?php foreach ($activity['topics'] as $topic): ?>
                    <li><?= $topic ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <div class="section">
            <h2>Đăng Ký Tham Dự</h2>
            <p style="font-weight: 700; color: #ff6a00;"><?= $activity['registration'] ?></p>
            <p style="font-style: italic; color: #666;"><?= $activity['note'] ?></p>
        </div>

    </div>

    <footer class="footer">
        &copy; 2025 CLB Tình Nguyện Đại Nam | Phát triển bởi Leaderbook.
    </footer>

</body>
</html>