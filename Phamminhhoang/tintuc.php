<?php
// Bắt đầu hoặc tiếp tục session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cấu hình chung
$logo_clb = "OIP (3).jpg"; 
$articles_per_page = 4; // Số lượng bài viết hiển thị trên mỗi trang

// --- DỮ LIỆU MÔ PHỎNG TIN TỨC ---
// Mỗi bài viết bao gồm: title, summary, date, category, image
$articles = [
    [
        'id' => 1,
        'title' => 'Tuyển Tình Nguyện Viên Chiến Dịch Hè 2026',
        'summary' => 'Chiến dịch Mùa Hè Xanh năm nay sẽ diễn ra tại Hà Giang. Đây là cơ hội để các bạn sinh viên cống hiến và trải nghiệm thực tế.',
        'date' => '2025-11-06',
        'category' => 'Sự Kiện',
        'image' => 'muahexanh.jpg'
    ],
    [
        'id' => 2,
        'title' => 'Khởi động khóa huấn luyện Kỹ năng mềm cho CLB',
        'summary' => 'Khóa học tập trung vào các kỹ năng lãnh đạo, làm việc nhóm và quản lý thời gian, giúp nâng cao năng lực cho thành viên CLB.',
        'date' => '2025-11-04',
        'category' => 'Hoạt Động',
        'image' => '
        knang.jpg'
    ],
    [
        'id' => 3,
        'title' => 'Gây quỹ "Áo Ấm Cho Em" vượt mốc 50 triệu đồng',
        'summary' => 'Chiến dịch gây quỹ đã kết thúc thành công, vượt xa mục tiêu ban đầu. Cảm ơn sự đóng góp của toàn thể sinh viên và nhà trường.',
        'date' => '2025-11-01',
        'category' => 'Thành Tích',
        'image' => 'OIP (2).jpg',
        'link'=> 'chitiettintuc.php'
    ],
    [
        'id' => 4,
        'title' => 'Thông báo Lịch họp định kỳ Ban Chấp Hành tháng 11',
        'summary' => 'Buổi họp quan trọng để tổng kết hoạt động quý vừa qua và đưa ra kế hoạch chi tiết cho quý tiếp theo. Mọi thành viên BCH cần tham dự đầy đủ.',
        'date' => '2025-10-30',
        'category' => 'Thông Báo',
        'image' => 'https://placehold.co/800x450/6c757d/fff?text=Lich+Hop'
    ],
    [
        'id' => 5,
        'title' => 'Hướng dẫn đăng ký thành viên mới CLB Tình Nguyện',
        'summary' => 'Quy trình và các bước cần thiết để chính thức trở thành thành viên của CLB. Hạn cuối đăng ký vào ngày 15/12/2025.',
        'date' => '2025-10-25',
        'category' => 'Thông Báo',
        'image' => 'ttv.jpg'
    ],
    [
        'id' => 6,
        'title' => 'Tọa đàm về Văn hóa Tình Nguyện trong giới trẻ',
        'summary' => 'Buổi tọa đàm với sự tham gia của các diễn giả nổi tiếng, thảo luận về vai trò và ý nghĩa của việc làm tình nguyện trong xã hội hiện đại.',
        'date' => '2025-10-20',
        'category' => 'Sự Kiện',
        'image' => 'https://placehold.co/800x450/fd7e14/fff?text=Toa+Dam'
    ],
    // Thêm các bài viết mẫu khác để kiểm tra phân trang
    [
        'id' => 7,
        'title' => 'Báo cáo tài chính quý III/2025',
        'summary' => 'Công khai minh bạch các khoản thu chi trong quý III. Đề nghị các thành viên kiểm tra và phản hồi (nếu có).',
        'date' => '2025-10-15',
        'category' => 'Thông Báo',
        'image' => 'https://placehold.co/800x450/20c997/fff?text=Bao+Cao+TC'
    ],
    [
        'id' => 8,
        'title' => 'Đại hội thường niên CLB Tình Nguyện',
        'summary' => 'Đại hội tổng kết cuối năm, bầu cử Ban Chấp Hành mới và vinh danh các cá nhân có thành tích xuất sắc.',
        'date' => '2025-10-10',
        'category' => 'Sự Kiện',
        'image' => 'thuongnien.jpg'
    ],
];

// --- LOGIC PHÂN TRANG ---
$total_articles = count($articles);
$total_pages = ceil($total_articles / $articles_per_page);
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Đảm bảo trang hiện tại nằm trong phạm vi hợp lệ
if ($current_page < 1) $current_page = 1;
if ($current_page > $total_pages) $current_page = $total_pages;

// Tính toán vị trí bắt đầu và kết thúc của mảng
$start_index = ($current_page - 1) * $articles_per_page;
$articles_to_display = array_slice($articles, $start_index, $articles_per_page);

// Lấy 3 tin nổi bật (Mới nhất)
$featured_articles = array_slice($articles, 0, 3);

// Hàm hiển thị tag danh mục
function get_category_class($category) {
    switch ($category) {
        case 'Sự Kiện': return 'tag-event';
        case 'Hoạt Động': return 'tag-activity';
        case 'Thông Báo': return 'tag-notice';
        case 'Thành Tích': return 'tag-success';
        default: return 'tag-default';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Tức - Cổng Thông Tin Sinh Viên</title>
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
            background-color: #2600ffff;
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

        /* CSS RIÊNG CHO TIN TỨC */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .main-content {
            display: grid;
            grid-template-columns: 3fr 1fr; /* Nội dung chính và Sidebar */
            gap: 30px;
        }
        .section-title {
            font-size: 28px;
            color: #ff6a00;
            border-left: 5px solid #007bff;
            padding-left: 15px;
            margin-bottom: 25px;
            font-weight: 700;
        }

        /* CARD TIN TỨC */
        .article-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            overflow: hidden;
            display: flex;
            transition: box-shadow 0.3s;
        }
        .article-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .article-img {
            width: 300px; /* Chiều rộng ảnh lớn hơn */
            height: 200px;
            flex-shrink: 0;
            overflow: hidden;
        }
        .article-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .article-card:hover .article-img img {
            transform: scale(1.05);
        }

        .article-content {
            padding: 20px;
            flex-grow: 1;
        }

        .article-content h3 {
            margin-top: 0;
            font-size: 20px;
            line-height: 1.4;
        }

        .article-content a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }
        .article-content a:hover {
            color: #ff6a00;
        }

        .article-meta {
            font-size: 13px;
            color: #777;
            margin-bottom: 10px;
        }

        .article-summary {
            font-size: 15px;
            color: #555;
            line-height: 1.6;
        }

        /* SIDEBAR TIN NỔI BẬT */
        .sidebar {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        .sidebar h3 {
            color: #ff6a00;
            font-size: 20px;
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
            margin-bottom: 20px;
        }
        .featured-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #e0e0e0;
        }
        .featured-item:last-child {
            border-bottom: none;
        }
        .featured-item a {
            font-size: 16px;
            font-weight: 500;
            color: #333;
            text-decoration: none;
        }
        .featured-item a:hover {
            color: #007bff;
        }
        .featured-date {
            display: block;
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }

        /* PHÂN TRANG (PAGINATION) */
        .pagination {
            text-align: center;
            margin-top: 30px;
            padding: 10px;
        }
        .pagination a, .pagination span {
            display: inline-block;
            padding: 8px 15px;
            margin: 0 4px;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-weight: 500;
        }
        .pagination a {
            color: #007bff;
            background-color: white;
        }
        .pagination a:hover {
            background-color: #e9ecef;
        }
        .pagination span.current {
            background-color: #ff6a00;
            color: white;
            border-color: #ff6a00;
            cursor: default;
        }

        /* TAG DANH MỤC */
        .category-tag {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 700;
            margin-right: 10px;
            text-transform: uppercase;
        }
        .tag-event { background-color: #007bff; color: white; }
        .tag-activity { background-color: #ffc107; color: #333; }
        .tag-notice { background-color: #17a2b8; color: white; }
        .tag-success { background-color: #28a745; color: white; }
        .tag-default { background-color: #6c757d; color: white; }

        /* Responsive */
        @media (max-width: 900px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            .article-card {
                flex-direction: column;
            }
            .article-img {
                width: 100%;
                height: 250px;
            }
            .sidebar {
                margin-top: 20px;
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
                <a href="tintuc.php" style="background-color: rgba(255, 255, 255, 0.2);">Tin Tức</a> <!-- Đánh dấu trang hiện tại -->
                <a href="lienhe.php">Liên Hệ</a>
                <a href="dangnhap.php">Đăng Xuất</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1 class="section-title">Cập Nhật Tin Tức & Thông Báo Mới Nhất</h1>

        <div class="main-content">
            
            <!-- CỘT CHÍNH: DANH SÁCH BÀI VIẾT -->
            <section class="news-list">
                
                <?php if (!empty($articles_to_display)): ?>
                    <?php foreach ($articles_to_display as $article): ?>
                        <article class="article-card">
                            <!-- Hình ảnh đại diện -->
                            <div class="article-img">
                                <img src="<?= htmlspecialchars($article['image']) ?>" 
                                     onerror="this.onerror=null;this.src='https://placehold.co/300x200/ff6a00/fff?text=No+Image'" 
                                     alt="<?= htmlspecialchars($article['title']) ?>">
                            </div>
                            
                            <!-- Nội dung bài viết -->
                            <div class="article-content">
                                
                                <div class="article-meta">
                                    <!-- Hiển thị Tag Danh mục -->
                                    <span class="category-tag <?= get_category_class($article['category']) ?>">
                                        <?= htmlspecialchars($article['category']) ?>
                                    </span>
                                    | Đăng ngày: <?= date('d/m/Y', strtotime($article['date'])) ?>
                                </div>
                                
                                <h3>
                                    <!-- Giả định liên kết đến trang chi tiết -->
                                    <a href="chitiettintuc.php?id=<?= $article['id'] ?>">
                                        <?= htmlspecialchars($article['title']) ?>
                                    </a>
                                </h3>
                                
                                <p class="article-summary">
                                    <?= htmlspecialchars($article['summary']) ?>
                                </p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="message-box error">Hiện chưa có bài viết nào được đăng.</div>
                <?php endif; ?>

                <!-- PHÂN TRANG -->
                <?php if ($total_pages > 1): ?>
                    <div class="pagination">
                        <!-- Nút Previous -->
                        <?php if ($current_page > 1): ?>
                            <a href="tintuc.php?page=<?= $current_page - 1 ?>">Trước</a>
                        <?php endif; ?>

                        <!-- Các số trang -->
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <?php if ($i == $current_page): ?>
                                <span class="current"><?= $i ?></span>
                            <?php else: ?>
                                <a href="tintuc.php?page=<?= $i ?>"><?= $i ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <!-- Nút Next -->
                        <?php if ($current_page < $total_pages): ?>
                            <a href="tintuc.php?page=<?= $current_page + 1 ?>">Sau</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </section>

            <!-- CỘT PHỤ: TIN NỔI BẬT -->
            <aside class="sidebar">
                <h3>📰 Tin Nổi Bật</h3>
                <div class="featured-list">
                    <?php foreach ($featured_articles as $featured): ?>
                        <div class="featured-item">
                            <a href="chitiettintuc.php?id=<?= $featured['id'] ?>">
                                <?= htmlspecialchars($featured['title']) ?>
                            </a>
                            <span class="featured-date">
                                <?= date('d/m/Y', strtotime($featured['date'])) ?> | <?= htmlspecialchars($featured['category']) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </aside>

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        &copy; 2025 CLB Tình Nguyện Đại Nam | Phát triển bởi Leaderbook.
    </footer>

</body>
</html>