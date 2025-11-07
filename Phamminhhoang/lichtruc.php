<?php
// Bắt đầu hoặc tiếp tục session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Khởi tạo mảng lưu trữ nếu chưa tồn tại
if (!isset($_SESSION['duty_schedule'])) {
    // Dữ liệu mẫu ban đầu
    $_SESSION['duty_schedule'] = [
        1 => [
            'id' => 1,
            'ten_sv' => 'Phạm Minh Hoàng',
            'ma_sv' => '1771020296',
            'nganh_hoc' => 'Công nghệ thông tin',
            'lop' => 'cntt1709',
            'ngay_sinh' => '2000-01-01',
            'ngay_truc' => '2025-11-15'
        ],
        2 => [
            'id' => 2,
            'ten_sv' => 'Nguyễn Thị Hoa',
            'ma_sv' => '1881030045',
            'nganh_hoc' => 'Quản trị kinh doanh',
            'lop' => 'qtkd1801',
            'ngay_sinh' => '2001-05-20',
            'ngay_truc' => '2025-11-16'
        ],
    ];
}

$schedule = $_SESSION['duty_schedule'];
$edit_data = null;
$message = '';
$error = '';

// Danh sách các Ngành học và Lớp học cho dropdown
$nganh_hocs = [
    'Công nghệ thông tin', 
    'Quản trị kinh doanh', 
    'Ngôn ngữ Anh', 
    'Du lịch'
];
$lops = [
    'cntt1709', 
    'cntt1802', 
    'qtkd1801', 
    'nnanh1903'
];

// --- LOGIC XỬ LÝ CRUD ---

// 1. Xóa (DELETE)
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id_to_delete = (int)$_GET['id'];
    if (isset($_SESSION['duty_schedule'][$id_to_delete])) {
        unset($_SESSION['duty_schedule'][$id_to_delete]);
        $message = "Đã xóa thành công lịch trực của ID: " . $id_to_delete;
    } else {
        $error = "Không tìm thấy lịch trực có ID: " . $id_to_delete;
    }
    // Chuyển hướng để xóa tham số GET khỏi URL
    header('Location: lichtruc.php');
    exit();
}

// 2. Chỉnh sửa (FETCH EDIT DATA)
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id_to_edit = (int)$_GET['id'];
    if (isset($_SESSION['duty_schedule'][$id_to_edit])) {
        $edit_data = $_SESSION['duty_schedule'][$id_to_edit];
    } else {
        $error = "Không tìm thấy lịch trực cần sửa.";
    }
}

// 3. Thêm mới / Cập nhật (ADD/UPDATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $is_update = isset($_POST['id']) && !empty($_POST['id']);
    
    $ten_sv = trim($_POST['ten_sv'] ?? '');
    $ma_sv = trim($_POST['ma_sv'] ?? '');
    $nganh_hoc = trim($_POST['nganh_hoc'] ?? '');
    $lop = trim($_POST['lop'] ?? '');
    $ngay_sinh = trim($_POST['ngay_sinh'] ?? '');
    $ngay_truc = trim($_POST['ngay_truc'] ?? '');

    // Kiểm tra dữ liệu bắt buộc
    if (empty($ten_sv) || empty($ma_sv) || empty($ngay_truc)) {
        $error = "Vui lòng điền đầy đủ Tên, Mã sinh viên và Ngày trực.";
    } else {
        $new_entry = [
            'ten_sv' => htmlspecialchars($ten_sv),
            'ma_sv' => htmlspecialchars($ma_sv),
            'nganh_hoc' => htmlspecialchars($nganh_hoc),
            'lop' => htmlspecialchars($lop),
            'ngay_sinh' => htmlspecialchars($ngay_sinh),
            'ngay_truc' => htmlspecialchars($ngay_truc),
        ];

        if ($is_update) {
            // Cập nhật (UPDATE)
            $update_id = (int)$_POST['id'];
            if (isset($_SESSION['duty_schedule'][$update_id])) {
                $new_entry['id'] = $update_id;
                $_SESSION['duty_schedule'][$update_id] = $new_entry;
                $message = "Cập nhật lịch trực thành công!";
            } else {
                $error = "Lỗi: Không tìm thấy ID cần cập nhật.";
            }
        } else {
            // Thêm mới (ADD)
            $next_id = empty($schedule) ? 1 : max(array_keys($schedule)) + 1;
            $new_entry['id'] = $next_id;
            $_SESSION['duty_schedule'][$next_id] = $new_entry;
            $message = "Đã thêm lịch trực mới thành công! ID: " . $next_id;
        }

        // Chuyển hướng sau khi thêm/sửa thành công
        header('Location: lichtruc.php');
        exit();
    }
}

// Sau khi xử lý POST, cập nhật lại biến $schedule
$schedule = $_SESSION['duty_schedule'];

// Cấu hình Header
$logo_clb = "OIP (3).jpg";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Lịch Trực</title>
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
            background-color: #0015ffff;
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
        
        /* CSS RIÊNG CHO LỊCH TRỰC */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .page-title {
            font-size: 30px;
            color: #0c0500ff;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Form Styling */
        .form-card {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            border-top: 5px solid #0785edff;
        }

        .form-card h3 {
            color: #007bff;
            margin-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: #0a0400ff;
            outline: none;
        }

        .form-actions {
            grid-column: 1 / -1; /* Kéo dài hết chiều rộng grid */
            margin-top: 15px;
            text-align: right;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 700;
            transition: background-color 0.3s, transform 0.1s;
        }

        .btn-primary {
            background-color: #bfd139ff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #e55e00;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            margin-right: 10px;
        }

        /* Table Styling */
        .table-card {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .schedule-table th, .schedule-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        .schedule-table th {
            background-color: #007bff;
            color: white;
            font-weight: 700;
            text-transform: uppercase;
        }

        .schedule-table tr:hover {
            background-color: #f1f8ff;
        }

        .action-btns a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 13px;
            margin-right: 5px;
            display: inline-block;
            transition: opacity 0.2s;
        }

        .action-btns .edit {
            background-color: #ffc107;
            color: #333;
        }

        .action-btns .delete {
            background-color: #dc3545;
            color: white;
        }

        .action-btns a:hover {
            opacity: 0.8;
        }
        
        /* Message Styling */
        .message-box {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: 700;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        /* Responsive Table */
        @media (max-width: 768px) {
            .schedule-table, .schedule-table thead, .schedule-table tbody, .schedule-table th, .schedule-table td, .schedule-table tr { 
                display: block; 
            }
            .schedule-table thead tr { 
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            .schedule-table tr { 
                border: 1px solid #ccc; 
                margin-bottom: 10px;
                border-radius: 8px;
            }
            .schedule-table td { 
                border: none;
                border-bottom: 1px solid #eee; 
                position: relative;
                padding-left: 50%;
                text-align: right;
            }
            .schedule-table td:before { 
                position: absolute;
                top: 6px;
                left: 6px;
                width: 45%; 
                padding-right: 10px; 
                white-space: nowrap;
                text-align: left;
                font-weight: 700;
                color: #120800ff;
            }
            /* Đặt nhãn cho các cột (Data-title attributes) */
            .schedule-table td:nth-of-type(1):before { content: "ID"; }
            .schedule-table td:nth-of-type(2):before { content: "Tên SV"; }
            .schedule-table td:nth-of-type(3):before { content: "Mã SV"; }
            .schedule-table td:nth-of-type(4):before { content: "Lớp"; }
            .schedule-table td:nth-of-type(5):before { content: "Ngành học"; }
            .schedule-table td:nth-of-type(6):before { content: "Ngày sinh"; }
            .schedule-table td:nth-of-type(7):before { content: "Ngày trực"; }
            .schedule-table td:nth-of-type(8):before { content: "Thao tác"; }
            .action-btns {
                text-align: left;
                margin-top: 10px;
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
                <a href="lienhe.php">Liên Hệ</a>
                <a href="dangnhap.php">Đăng Xuất</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1 class="page-title">Quản Lý Lịch Trực Thành Viên</h1>

        <!-- Hiển thị thông báo (nếu có) -->
        <?php if (!empty($message)): ?>
            <div class="message-box success"><?= $message ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="message-box error"><?= $error ?></div>
        <?php endif; ?>

        <!-- KHỐI FORM THÊM/SỬA -->
        <div class="form-card">
            <h3><?= $edit_data ? 'Cập nhật lịch trực ID: ' . $edit_data['id'] : 'Thêm lịch trực mới' ?></h3>
            
            <form method="POST" action="lichtruc.php">
                <!-- Trường ẩn để xác định chế độ Sửa/Cập nhật -->
                <?php if ($edit_data): ?>
                    <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
                <?php endif; ?>

                <div class="form-grid">
                    <!-- Tên sinh viên -->
                    <div class="form-group">
                        <label for="ten_sv">Họ tên sinh viên:</label>
                        <input type="text" id="ten_sv" name="ten_sv" value="<?= $edit_data ? $edit_data['ten_sv'] : '' ?>" required>
                    </div>

                    <!-- Mã sinh viên -->
                    <div class="form-group">
                        <label for="ma_sv">Mã sinh viên:</label>
                        <input type="text" id="ma_sv" name="ma_sv" value="<?= $edit_data ? $edit_data['ma_sv'] : '' ?>" required>
                    </div>

                    <!-- Ngành học -->
                    <div class="form-group">
                        <label for="nganh_hoc">Ngành học:</label>
                        <select id="nganh_hoc" name="nganh_hoc">
                            <?php foreach ($nganh_hocs as $nganh): ?>
                                <option value="<?= $nganh ?>" <?= ($edit_data && $edit_data['nganh_hoc'] == $nganh) ? 'selected' : '' ?>>
                                    <?= $nganh ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Lớp -->
                    <div class="form-group">
                        <label for="lop">Lớp:</label>
                        <select id="lop" name="lop">
                            <?php foreach ($lops as $l): ?>
                                <option value="<?= $l ?>" <?= ($edit_data && $edit_data['lop'] == $l) ? 'selected' : '' ?>>
                                    <?= $l ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Ngày sinh -->
                    <div class="form-group">
                        <label for="ngay_sinh">Ngày sinh:</label>
                        <input type="date" id="ngay_sinh" name="ngay_sinh" value="<?= $edit_data ? $edit_data['ngay_sinh'] : '' ?>" required>
                    </div>

                    <!-- Ngày trực -->
                    <div class="form-group">
                        <label for="ngay_truc">Ngày trực:</label>
                        <input type="date" id="ngay_truc" name="ngay_truc" value="<?= $edit_data ? $edit_data['ngay_truc'] : '' ?>" required>
                    </div>

                    <div class="form-actions">
                        <?php if ($edit_data): ?>
                            <a href="lichtruc.php" class="btn btn-secondary">Hủy</a>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary">
                            <?= $edit_data ? 'Cập Nhật' : 'Thêm Mới' ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- KHỐI BẢNG HIỂN THỊ LỊCH TRỰC -->
        <div class="table-card">
            <h2 style="color: #3973f0ff;">Danh Sách Lịch Trực Đã Đăng Ký (<?= count($schedule) ?> mục)</h2>
            
            <table class="schedule-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên SV</th>
                        <th>Mã SV</th>
                        <th>Lớp</th>
                        <th>Ngành học</th>
                        <th>Ngày sinh</th>
                        <th>Ngày trực</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($schedule)): ?>
                        <?php foreach ($schedule as $id => $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['id']) ?></td>
                                <td><?= htmlspecialchars($item['ten_sv']) ?></td>
                                <td><?= htmlspecialchars($item['ma_sv']) ?></td>
                                <td><?= htmlspecialchars($item['lop']) ?></td>
                                <td><?= htmlspecialchars($item['nganh_hoc']) ?></td>
                                <td><?= htmlspecialchars($item['ngay_sinh']) ?></td>
                                <td><?= htmlspecialchars($item['ngay_truc']) ?></td>
                                <td class="action-btns">
                                    <a href="lichtruc.php?action=edit&id=<?= $id ?>" class="edit">Sửa</a>
                                    <!-- Sử dụng JavaScript để xác nhận trước khi xóa -->
                                    <a href="#" onclick="if(confirm('Bạn có chắc chắn muốn xóa lịch trực của <?= htmlspecialchars($item['ten_sv']) ?>?')) { window.location.href='lichtruc.php?action=delete&id=<?= $id ?>'; }" class="delete">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center; color: #999;">Chưa có lịch trực nào được đăng ký.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- FOOTER -->
    <footer class="footer">
        &copy; 2025 CLB Tình Nguyện Đại Nam | Phát triển bởi Leaderbook.
    </footer>

</body>
</html>