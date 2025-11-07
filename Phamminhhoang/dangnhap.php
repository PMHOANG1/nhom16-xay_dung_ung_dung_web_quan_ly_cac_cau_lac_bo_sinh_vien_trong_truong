<?php

// Bắt đầu hoặc tiếp tục session

if (session_status() == PHP_SESSION_NONE) {

    session_start();

}



// Lấy thông báo lỗi (nếu có từ tệp xử lý đăng nhập)

$error_message = $_SESSION['login_error'] ?? '';

unset($_SESSION['login_error']); // Xóa thông báo lỗi sau khi hiển thị



// Cấu hình đường dẫn ảnh thực tế của bạn

// VUI LÒNG THAY THẾ CÁC ĐƯỜNG DẪN NÀY BẰNG ẢNH CỦA BẠN

$logo_dnu = "images/logo_daihoc_dainam.png"; // LOGO ĐẠI HỌC ĐẠI NAM

$img_path_main = "images/campus_main.jpg"; // CHỈ CÒN 1 ẢNH CHÍNH



// Đường dẫn logo CLB mới (OIP (3).jpg)

$logo_clb = "OIP (4).jpg";

?>

<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Đăng nhập vào Hệ Thống Leaderbook</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>

        /* CSS Reset & Cấu trúc chung */

        body {

            margin: 0; padding: 0; font-family: 'Roboto', sans-serif;

            background-color: #f7f7f7; display: flex; min-height: 100vh;

        }

        .container { display: flex; width: 100%; }

        .left-panel {

            flex: 1; min-width: 450px; display: flex; flex-direction: column;

            justify-content: center; align-items: center; padding: 20px;

            background-color: white; position: relative;

        }

        .right-panel {

            flex: 1.5; display: flex; flex-direction: column; justify-content: center;

            align-items: center; background-color: #e5f5e5; padding: 50px;

            position: relative; overflow: hidden;

        }

        .login-content { width: 80%; max-width: 380px; }

        .back-link {

            position: absolute; top: 40px; left: 40px; text-decoration: none;

            color: #333; font-weight: 500; display: flex; align-items: center;

        }

        .back-link:before { content: '←'; margin-right: 8px; font-size: 18px; }

       

        /* LOGO ĐẠI HỌC ĐẠI NAM (CỘT TRÁI) */

        .logo-container {

            width: 100%;

            height: auto;

            margin-bottom: 20px;

        }

        .dnu-logo {

            max-width: 250px; /* Điều chỉnh kích thước tối đa cho logo */

            height: auto;

            display: block;

        }



        .title { font-size: 32px; font-weight: 700; color: #007bff; margin-bottom: 30px; }

       

        /* ĐIỀU CHỈNH CSS CHO INPUT VÀ ICON MẮT */

        .input-group { margin-bottom: 20px; position: relative; }

        .input-wrapper {

            position: relative; /* Khối cha cho input và icon */

            width: 100%;

        }

        .input-group input {

            width: 100%; padding: 12px 10px; border: 1px solid #ddd;

            border-radius: 4px; font-size: 16px; box-sizing: border-box; outline: none;

            padding-right: 40px; /* Tăng padding để icon mắt không che chữ */

        }

        .password-toggle {

            position: absolute;

            right: 10px; /* Di chuyển icon vào trong 10px so với cạnh phải */

            top: 50%;

            transform: translateY(-50%);

            cursor: pointer;

            color: #999;

            font-size: 18px;

            z-index: 20; /* Đảm bảo icon nằm trên input */

            line-height: 1;

            /* Điều chỉnh kích thước và giao diện icon */

            font-weight: 400;

            letter-spacing: -1px; /* Giảm khoảng cách cho ký tự Unicode */

        }

        /* KẾT THÚC ĐIỀU CHỈNH */



        .btn-login {

            width: 100%; padding: 12px; background-color: black; color: white;

            border: none; border-radius: 4px; font-size: 16px; font-weight: 700;

            cursor: pointer; transition: background-color 0.3s;

        }

        .error-msg {

            color: red; background-color: #ffeaea; border: 1px solid red;

            padding: 10px; border-radius: 4px; margin-bottom: 20px; text-align: center;

        }



        /* ------------------ HIỆU ỨNG BÔNG HOA XOAY (3 BÔNG) ------------------ */

        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        @keyframes anti-spin { from { transform: rotate(360deg); } to { transform: rotate(0deg); } }



        .flower {

            position: absolute; z-index: 1; opacity: 0.5;

            color: rgba(144, 238, 144, 0.5);

        }

        .flower:after { content: '🍀'; display: block; }

        /* Vị trí và tốc độ cho từng bông hoa */

        .flower-large { font-size: 350px; top: 0; left: 80%; transform: translate(-50%, -50%); animation: spin 30s linear infinite; }

        .flower-medium { font-size: 250px; bottom: -50px; left: 10%; transform: translate(-50%, -50%); animation: anti-spin 20s linear infinite; }

        .flower-small { font-size: 150px; top: 50%; right: 5%; transform: translate(-50%, -50%); animation: spin 25s linear infinite; }

       

        /* HIỆU ỨNG CHUYỂN ĐỘNG CHO NỘI DUNG LANDING PAGE */

        @keyframes slideUpIn {

            from {

                opacity: 0;

                transform: translateY(50px);

            }

            to {

                opacity: 1;

                transform: translateY(0);

            }

        }

       

        .landing-content > * {

            opacity: 0;

            animation: slideUpIn 0.8s ease-out forwards;

        }

       

        /* Thiết lập độ trễ cho từng phần tử để tạo hiệu ứng nối tiếp */

        .landing-title {

            animation-delay: 0.1s;

        }

        .image-showcase {

            animation-delay: 0.3s; /* Ảnh hiển thị sau tiêu đề */

        }

        .club-intro-box {

            animation-delay: 0.5s; /* Khối giới thiệu hiển thị cuối cùng */

        }



        /* ------------------ CSS CHO KHỐI TRƯNG BÀY ẢNH (CHỈ CÒN 1 ẢNH) ------------------ */

        .image-showcase {

            position: relative;

            width: 320px;

            height: 380px;

            margin: 40px auto 20px;

            border: 5px solid #000;

            border-radius: 10px;

            background-color: white;

            overflow: hidden;

            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); /* Thêm bóng đổ đẹp hơn */

        }

        .showcase-img-single {

            width: 100%;

            height: 100%;

            object-fit: cover;

            display: block;

        }



        /* ------------------ CSS CHO KHỐI GIỚI THIỆU CLB ------------------ */

        .club-intro-box {

            width: 100%; max-width: 500px; margin: 0 auto; padding: 20px;

            background-color: white; border-radius: 8px; text-align: left;

            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);

        }

        .intro-header {

            display: flex;

            align-items: center;

            margin-bottom: 10px;

        }

        /* CSS MỚI CHO LOGO CLB */

        .club-logo {

            width: 40px; /* Chiều rộng nhỏ */

            height: 40px; /* Chiều cao nhỏ */

            object-fit: contain; /* Đảm bảo ảnh không bị biến dạng */

            margin-right: 15px;

            border-radius: 4px;

        }

        .intro-header h3 {

            font-size: 24px; font-weight: 700; color: #333; margin: 5px 0 0;

        }

        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-bottom: 25px; text-align: center; }

        .stat-item { border-right: 1px solid #eee; }

        .stat-item:last-child { border-right: none; }

        .stat-number { display: block; font-size: 28px; font-weight: 700; color: #ff6a00; }

        .stat-label { display: block; font-size: 12px; color: #666; text-transform: uppercase; margin-top: -5px; }

        .about-us { margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee; }

        .about-us h4 { font-size: 20px; font-weight: 700; color: #333; margin: 5px 0 10px; }



        /* Media Query */

        @media (max-width: 900px) {

            .right-panel { display: none; }

            .left-panel { width: 100%; min-width: unset; }

        }

    </style>

</head>

<body>



    <div class="container">

       

        <!-- Cột Trái: Form Đăng nhập -->

        <div class="left-panel">

            <a href="trangchu.php" class="back-link">Quay lại</a>



            <div class="login-content">

                <!-- KHỐI LOGO ĐẠI NAM -->

                <div class="logo-container">

                    <img src="<?= $logo_dnu ?>" onerror="this.onerror=null;this.src='OIP (4).jpg'" alt="Logo Đại học Đại Nam" class="dnu-logo">

                </div>

               

                <h1 class="title">Đăng Nhập Hệ Thống</h1>

               

                <?php if ($error_message): ?>

                    <div class="error-msg">

                        <?= htmlspecialchars($error_message) ?>

                    </div>

                <?php endif; ?>



                <form action="xuly_dangnhap.php" method="POST">

                    <div class="input-group">

                        <input type="text" id="username" name="username" placeholder="Tên đăng nhập" required>

                    </div>



                    <div class="input-group">

                        <div class="input-wrapper">

                            <!-- Input Mật khẩu -->

                            <input type="password" id="password" name="password" placeholder="Mật khẩu" required>

                            <!-- Icon Mắt nằm bên trong Input -->

                            <span class="password-toggle" onclick="togglePassword()">🚫</span>

                        </div>

                    </div>



                    <div class="options">

                        <label>

                            <input type="checkbox" name="remember_me"> Ghi nhớ tôi

                        </label>

                        <a href="quen_mat_khau.php">Quên mật khẩu</a>

                    </div>



                    <button type="submit" class="btn-login">Đăng nhập</button>

                </form>



                <div class="register-link">

                    Bạn chưa có tài khoản? <a href="dangky.php">Đăng ký</a>

                </div>

            </div>

        </div>



        <!-- Cột Phải: Landing Page CLB -->

        <div class="right-panel">

           

            <!-- 3 BÔNG HOA XOAY TRÒN (Hiệu ứng nền) -->

            <div class="flower flower-large"></div>

            <div class="flower flower-medium"></div>

            <div class="flower flower-small"></div>

               

                <!-- KHỐI CHỨA CHỈ 1 HÌNH ẢNH (Có hiệu ứng trượt lên) -->

                <div class="image-showcase">

                    <img src="<?= $img_path_main ?>" onerror="this.onerror=null;this.src='mh.jpg'" alt="Ảnh chính" class="showcase-img-single">

                </div>

               

                <!-- KHỐI NỘI DUNG GIỚI THIỆU MỚI (Có hiệu ứng trượt lên) -->

                <div class="club-intro-box">

                    <div class="intro-header">

                        <!-- LOGO CLB MỚI VỚI KÍCH THƯỚC NHỎ -->

                        <img src="<?= $logo_clb ?>" onerror="this.onerror=null;this.src='https://placehold.co/40x40/ff6a00/fff?text=TNN'" alt="Logo CLB" class="club-logo">

                        <h3>CLB Sinh Viên Tình Nguyện </h3>

                    </div>

                   

                    <!-- Khối số liệu thống kê -->

                    <div class="stats-grid">

                        <div class="stat-item">

                            <span class="stat-number">10</span>

                            <span class="stat-label">Năm đồng hành</span>

                        </div>

                        <div class="stat-item">

                            <span class="stat-number">25+</span>

                            <span class="stat-label">Dự án thiện nguyện</span>

                        </div>

                        <div class="stat-item">

                            <span class="stat-number">120+</span>

                            <span class="stat-label">Tình nguyện viên</span>

                        </div>

                        <div class="stat-item">

                            <span class="stat-number">1000+</span>

                            <span class="stat-label">Người được giúp đỡ</span>

                        </div>

                    </div>

                   

                    <div class="about-us">

                        <span class="sub-header">Tâm huyết</span>

                        <h4>Về Chúng Tôi</h4>

                        <p>Câu Lạc Bộ Tình Nguyện là nơi hội tụ của những sinh viên nhiệt huyết, mang trong mình tinh thần "Cho đi là còn mãi". Chúng tôi cam kết tổ chức các hoạt động thiện nguyện ý nghĩa, kết nối cộng đồng và lan tỏa những giá trị tích cực, góp phần xây dựng một xã hội tốt đẹp hơn. Tham gia cùng chúng tôi để rèn luyện kỹ năng, trưởng thành và tạo nên khác biệt!</p>

                    </div>

                </div>

            </div>

        </div>



    </div>



    <!-- Script đơn giản để ẩn hiện mật khẩu -->

    <script>

        function togglePassword() {

            const passwordField = document.getElementById('password');

            const toggleIcon = document.querySelector('.password-toggle');

            if (passwordField.type === 'password') {

                passwordField.type = 'text';

                // Biểu tượng khi mật khẩu được hiện (mắt mở)

                toggleIcon.textContent = '👁';

            } else {

                passwordField.type = 'password';

                // Biểu tượng khi mật khẩu bị ẩn (mắt gạch chéo)

                toggleIcon.textContent = '🚫';

            }

        }

    </script>

</body>

</html>