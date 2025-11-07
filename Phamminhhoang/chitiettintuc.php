<?php
// Tên file: gayquy.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$logo_clb = "OIP (3).jpg"; 

// Dữ liệu gây quỹ
$fund_info = [
    'project_title' => 'Ủng Hộ Quỹ "Ánh Sáng Yêu Thương" cho Mùa Hè Xanh 2025',
    'bank_name' => 'MB BANK',
    'account_number' => '203138686', // Vui lòng thay thế bằng Số TK thực tế của CLB
    'account_name' => 'PHẠM MINH HOÀNG',
    'qr_code_path' => 'mb_qr_code.png', // Đường dẫn đến file ảnh QR code thực tế
    'note' => 'Cảm ơn sự đồng hành của bạn! Mọi đóng góp đều minh bạch và được sử dụng đúng mục đích.'
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gây Quỹ - CLB Tình Nguyện</title>
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
        
        /* CSS RIÊNG CHO TRANG GÂY QUỸ */
        .container { max-width: 800px; margin: 30px auto; padding: 30px; background-color: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); text-align: center; }
        
        .section-title { color: #ff6a00; font-size: 32px; margin-bottom: 10px; }
        .sub-title { color: #0022ffff; font-size: 24px; margin-bottom: 30px; font-weight: 500; }
        
        .bank-info { 
            border: 2px solid #0022ffff; 
            border-radius: 10px; 
            padding: 20px; 
            margin-bottom: 30px;
            background-color: #e6f7ff; /* Nền xanh nhạt của MB */
        }
        .bank-info p { margin: 10px 0; font-size: 18px; }
        .bank-info strong { 
            display: inline-block; 
            min-width: 150px; 
            text-align: left; 
            color: #333;
        }
        .account-number, .bank-name-display {
            font-size: 28px;
            font-weight: 700;
            color: #ff6a00; /* Màu nổi bật cho Số TK */
            display: block;
            margin-top: 5px;
        }
        
        /* KHU VỰC QR CODE */
        .qr-section { margin-top: 30px; }
        .qr-code { 
            width: 250px; 
            height: 250px; 
            border: 5px solid #0022ffff; 
            border-radius: 5px; 
            display: block;
            margin: 20px auto;
            object-fit: cover;
        }
        .transfer-guide { font-size: 16px; color: #555; margin-top: 15px; }

        .note-text { 
            margin-top: 30px; 
            font-style: italic; 
            color: #666; 
            border-top: 1px dashed #ccc; 
            padding-top: 15px;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .container { padding: 15px; }
            .section-title { font-size: 28px; }
            .sub-title { font-size: 20px; }
            .bank-info strong { min-width: 100%; text-align: center; display: block; margin-bottom: 5px; }
            .account-number { font-size: 24px; }
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
                <a href="hoatdong.php">Hoạt Động</a>
                <a href="gayquy.php" style="background-color: rgba(255, 255, 255, 0.2);">Gây Quỹ</a> <a href="lienhe.php">Liên Hệ</a> 
                <a href="logout.php">Đăng Xuất</a>
            </nav>
        </div>
    </header>

    <div class="container">
        
        <h1 class="section-title">CHUNG TAY VÌ CỘNG ĐỒNG</h1>
        <p class="sub-title"><?= htmlspecialchars($fund_info['project_title']) ?></p>

        <div class="bank-info">
            <h2>THÔNG TIN CHUYỂN KHOẢN HỖ TRỢ</h2>
            
            <p><strong>Tên Ngân Hàng:</strong> <span class="bank-name-display"><?= htmlspecialchars($fund_info['bank_name']) ?></span></p>
            <p><strong>Số Tài Khoản:</strong> <span class="account-number" id="accountNumber"><?= htmlspecialchars($fund_info['account_number']) ?></span></p>
            <p><strong>Chủ Tài Khoản:</strong> <span><?= htmlspecialchars($fund_info['account_name']) ?></span></p>
            
            <button onclick="copyAccountNo()" style="padding: 10px 20px; background-color: #0022ffff; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 15px; font-weight: 700;">
                <span id="copyText">Sao chép Số Tài Khoản</span>
            </button>
        </div>

        <div class="qr-section">
            <h2>HOẶC QUÉT MÃ QR ĐỂ CHUYỂN KHOẢN NHANH</h2>
            <img src="<?= htmlspecialchars($fund_info['qr_code_path']) ?>" 
                 onerror="this.onerror=null;this.src='qr.jpg';" 
                 alt="Mã QR Chuyển Khoản MB Bank" 
                 class="qr-code">
            
            <p class="transfer-guide">Vui lòng ghi rõ nội dung chuyển khoản: **[Tên bạn] - UNGHOMHX** (Ví dụ: NguyenVanA - UNGHOMHX)</p>
        </div>
        
        <p class="note-text"><?= htmlspecialchars($fund_info['note']) ?></p>

    </div>

    <footer class="footer">
        &copy; 2025 CLB Tình Nguyện Đại Nam | Phát triển bởi Leaderbook.
    </footer>
    
    <script>
        function copyAccountNo() {
            const accountNumber = document.getElementById('accountNumber').textContent;
            const copyText = document.getElementById('copyText');
            
            // Sử dụng API Clipboard hiện đại
            navigator.clipboard.writeText(accountNumber).then(() => {
                const originalText = copyText.textContent;
                copyText.textContent = 'Đã sao chép!';
                copyText.style.backgroundColor = '#4CAF50'; // Màu xanh lá khi thành công
                
                // Trở lại trạng thái ban đầu sau 2 giây
                setTimeout(() => {
                    copyText.textContent = originalText;
                    copyText.style.backgroundColor = '#0022ffff'; // Màu ban đầu
                }, 2000);
            }).catch(err => {
                console.error('Không thể sao chép: ', err);
                copyText.textContent = 'Lỗi sao chép!';
            });
        }
    </script>
</body>
</html>