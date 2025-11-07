<?php
// Bắt đầu hoặc tiếp tục session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cấu hình chung
$logo_clb = "OIP (3).jpg"; 

// Dữ liệu giả lập cho các hoạt động
$featured_activities = [
    [
        'title' => 'Chiến dịch Mùa Hè Xanh 2025',
        'date' => '01/07/2025 - 15/07/2025',
        'location' => 'Xã Tả Phìn, Tỉnh Cao Bằng',
        'description' => 'Chủ đề: "Ánh Sáng Yêu Thương" - Xây dựng khu vui chơi, tặng sách vở và tổ chức khám bệnh miễn phí cho bà con vùng cao. Kêu gọi tình nguyện viên đợt 2.',
        'image' => 'OIP.jpg',
        'link' => 'muahexanh_detail.php'
    ],
    [
        'title' => 'Workshop Kỹ năng Mềm: Giao tiếp Hiệu quả',
        'date' => '25/05/2025',
        'location' => 'Hội trường Lớn, Trường Đại học Nam',
        'description' => 'Sự kiện đào tạo miễn phí nhằm trang bị kỹ năng giao tiếp, thuyết trình và làm việc nhóm. Diễn giả là chuyên gia tâm lý học, TS. Nguyễn Văn A.',
        'image' => 'kn.jpg',
        'link' => 'kynangmem_detail.php'
    ]
];

// Dữ liệu giả lập cho thư viện ảnh (các hoạt động đã hoàn thành)
$gallery_items = [
    ['caption' => 'NGÀY CHỦ NHẬT XANH - DỌN DẸP KHUÔN VIÊN TRƯỜNG ', 'image' => 'CNX.jpg'],
    ['caption' => 'TỔ CHỨC TRUNG THU CHO TRẺ EM', 'image' => 'TT.jpg'],
    ['caption' => 'HIẾN MÁU NHÂN ĐẠO ĐỢT 1/2025', 'image' => 'OIPO.jpg'],
    ['caption' => 'SƠ DUYỆT 2/9', 'image' => 'sd.jpg'],
    ['caption' => 'ĐÊM NHẠC CHÀO TÂN ', 'image' => 'DN.jpg'],
    ['caption' => 'BUỔI CHÀO ĐÓN TÂN SINH VIÊN 2025', 'image' => 'tsv.jpg'],
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoạt Động - Cổng Thông Tin Sinh Viên</title>
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
            background-color: #0022ffff;
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

        /* CSS RIÊNG CHO HOẠT ĐỘNG */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .section-title {
            font-size: 32px;
            color: #010b15ff;
            text-align: center;
            margin-bottom: 40px;
            display: block;
            font-weight: 700;
            padding-bottom: 10px;
            border-bottom: 3px solid #ff6a00;
        }
        
        /* HOẠT ĐỘNG NỔI BẬT */
        .featured-activity {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            padding: 20px;
            display: flex;
            align-items: center;
            transition: transform 0.3s;
        }
        .featured-activity:hover {
            transform: translateY(-5px);
        }
        .activity-image {
            flex: 0 0 300px; /* Độ rộng cố định cho ảnh trên desktop */
            margin-right: 20px;
            overflow: hidden;
            border-radius: 8px;
        }
        .activity-image img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 8px;
        }
        .activity-content {
            flex-grow: 1;
        }
        .activity-content h3 {
            color: #ff6a00;
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 10px;
        }
        .activity-meta {
            font-size: 14px;
            color: #555;
            margin-bottom: 15px;
            display: flex;
            gap: 20px;
        }
        .activity-meta span {
            display: flex;
            align-items: center;
        }
        .activity-meta span::before {
            content: '•';
            margin-right: 5px;
            font-weight: 700;
            color: #037af1ff;
        }
        .activity-content p {
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .view-detail-btn {
            display: inline-block;
            background-color: #0a7bedff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 700;
            transition: background-color 0.3s;
        }
        .view-detail-btn:hover {
            background-color: #00050aff;
        }
        
        /* THƯ VIỆN ẢNH */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .gallery-item {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
        }
        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .gallery-item:hover img {
            transform: scale(1.05);
        }
        .gallery-caption {
            padding: 15px 10px;
            font-size: 15px;
            font-weight: 500;
            color: #333;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .featured-activity {
                flex-direction: column;
                text-align: center;
                padding: 15px;
            }
            .activity-image {
                flex: none;
                width: 100%;
                margin: 0 0 15px 0;
            }
            .activity-image img {
                max-height: 250px;
                object-fit: cover;
            }
            .activity-meta {
                justify-content: center;
                flex-wrap: wrap;
            }
            .gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
                <a href="hoatdong.php" style="background-color: rgba(255, 255, 255, 0.2);">Hoạt Động</a> <!-- Đánh dấu trang hiện tại -->
                <a href="tintuc.php">Tin Tức</a>
                <a href="lienhe.php">Liên Hệ</a> 
                <a href="dangnhap.php">Đăng Xuất</a>
            </nav>
        </div>
    </header>

    <div class="container">
        
        <!-- HOẠT ĐỘNG NỔI BẬT -->
        <h2 class="section-title">HOẠT ĐỘNG NỔI BẬT VÀ SẮP DIỄN RA</h2>

        <?php foreach ($featured_activities as $activity): ?>
            <div class="featured-activity">
                <div class="activity-image">
                    <img src="<?= $activity['image'] ?>" onerror="this.onerror=null;this.src='https://placehold.co/300x200/ff6a00/fff?text=Hinh+Anh';" alt="<?= $activity['title'] ?>">
                </div>
                <div class="activity-content">
                    <h3><?= $activity['title'] ?></h3>
                    <div class="activity-meta">
                        <span>Ngày: <?= $activity['date'] ?></span>
                        <span>Địa điểm: <?= $activity['location'] ?></span>
                    </div>
                    <p><?= $activity['description'] ?></p>
                    <a href="<?= $activity['link'] ?>" class="view-detail-btn">Xem Chi Tiết</a>
                </div>
            </div>
        <?php endforeach; ?>


        <!-- THƯ VIỆN ẢNH / HOẠT ĐỘNG ĐÃ QUA -->
        <h2 class="section-title" style="margin-top: 50px;">THƯ VIỆN HÌNH ẢNH CÁC HOẠT ĐỘNG ĐÃ QUA</h2>
        
        <div class="gallery-grid">
            <?php foreach ($gallery_items as $item): ?>
                <div class="gallery-item">
                    <img src="<?= $item['image'] ?>" onerror="this.onerror=null;this.src='https://placehold.co/400x300/333/fff?text=Anh+Hoat+Dong';" alt="<?= $item['caption'] ?>">
                    <div class="gallery-caption">
                        <?= $item['caption'] ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <!-- FOOTER -->
    <footer class="footer">
        &copy; 2025 CLB Tình Nguyện Đại Nam | Phát triển bởi Leaderbook.
    </footer>

</body>
</html>