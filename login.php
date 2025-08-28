<?php 
session_start(); 
include('db.php'); 

// Redirect jika sudah login
if(isset($_SESSION['status_login']) && $_SESSION['status_login'] == true) {
    if($_SESSION['level'] == 'admin') {
        header('location: admin/dashboard.php');
    } elseif($_SESSION['level'] == 'pelanggan') {
        header('location: user/dashboard_user.php');
    } else {
        header('location: index.php');
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login ke Teen Dream - Fashion Remaja Terkini">
    <title>Login - Teen Dream Fashion</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-pink: #ff69b4;
            --light-pink: #ffb6c1;
            --dark-pink: #e1477f;
            --pale-pink: #ffeef2;
            --white: #ffffff;
            --gray: #666666;
            --light-gray: #f8f9fa;
            --shadow: rgba(255, 105, 180, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--dark-pink) 50%, var(--light-pink) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated Background Elements */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            animation: float 20s linear infinite;
            pointer-events: none;
        }

        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            100% { transform: translateY(-100px) rotate(360deg); }
        }

        /* Back to Home Button */
        .back-home {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 10;
        }

        .back-home a {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--white);
            text-decoration: none;
            background: rgba(255, 255, 255, 0.2);
            padding: 12px 20px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .back-home a:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(-5px);
        }

        /* Login Container */
        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .box-login {
            background: var(--white);
            padding: 3rem 2.5rem;
            border-radius: 20px;
            box-shadow: 0 20px 60px var(--shadow);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .box-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-pink), var(--light-pink), var(--dark-pink));
        }

        /* Header */
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-pink), var(--dark-pink));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 20px var(--shadow);
        }

        .login-header .logo i {
            color: var(--white);
            font-size: 2rem;
        }

        .box-login h2 {
            color: var(--dark-pink);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: var(--gray);
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        /* Form Styling */
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .input-group {
            position: relative;
        }

        .input-control {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: 2px solid var(--light-gray);
            border-radius: 12px;
            font-size: 16px;
            font-family: 'Quicksand', sans-serif;
            transition: all 0.3s ease;
            background: var(--light-gray);
        }

        .input-control:focus {
            outline: none;
            border-color: var(--primary-pink);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .input-control:focus + .input-icon {
            color: var(--primary-pink);
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            cursor: pointer;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary-pink);
        }

        /* Button */
        .btn {
            background: linear-gradient(135deg, var(--primary-pink), var(--dark-pink));
            color: var(--white);
            padding: 15px 30px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            font-family: 'Quicksand', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px var(--shadow);
        }

        .btn:active {
            transform: translateY(0);
        }

        /* Loading State */
        .btn.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn.loading::after {
            content: '';
            width: 20px;
            height: 20px;
            border: 2px solid var(--white);
            border-top: 2px solid transparent;
            border-radius: 50%;
            display: inline-block;
            animation: spin 1s linear infinite;
            margin-left: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Register Link */
        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--light-gray);
        }

        .register-link p {
            color: var(--gray);
            margin-bottom: 0;
        }

        .register-link a {
            color: var(--primary-pink);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: var(--dark-pink);
            text-decoration: underline;
        }

        /* Error Message */
        .error-message {
            background: #ffe6e6;
            color: #d63384;
            padding: 12px 16px;
            border-radius: 8px;
            border-left: 4px solid #d63384;
            margin-bottom: 1rem;
            font-weight: 500;
            display: none;
        }

        .error-message.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Success Message */
        .success-message {
            background: #e6ffe6;
            color: #28a745;
            padding: 12px 16px;
            border-radius: 8px;
            border-left: 4px solid #28a745;
            margin-bottom: 1rem;
            font-weight: 500;
            display: none;
        }

        .success-message.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                max-width: 90%;
                padding: 10px;
            }

            .box-login {
                padding: 2rem 1.5rem;
            }

            .back-home {
                position: relative;
                top: auto;
                left: auto;
                margin-bottom: 20px;
                text-align: center;
            }

            body {
                padding: 20px 0;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {
            .box-login h2 {
                font-size: 1.5rem;
            }

            .input-control {
                padding: 12px 15px 12px 45px;
                font-size: 14px;
            }

            .btn {
                padding: 12px 25px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="back-home">
        <a href="index.php">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Beranda
        </a>
    </div>

    <div class="login-container">
        <div class="box-login">
            <div class="login-header">
                <div class="logo">
                    <i class="fas fa-heart"></i>
                </div>
                <h2>Selamat Datang!</h2>
                <p class="login-subtitle">Masuk ke akun Teen Dream kamu</p>
            </div>

            <div id="errorMessage" class="error-message"></div>
            <div id="successMessage" class="success-message"></div>

            <form class="login-form" method="post" id="loginForm">
                <div class="input-group">
                    <input type="text" name="user" placeholder="Username" class="input-control" required>
                    <i class="fas fa-user input-icon"></i>
                </div>

                <div class="input-group">
                    <input type="password" name="pass" placeholder="Password" class="input-control" id="passwordInput" required>
                    <i class="fas fa-lock input-icon"></i>
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                </div>

                <button type="submit" name="submit" class="btn" id="loginBtn">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>
            </form>

            <div class="register-link">
                <p>Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
            </div>
        </div>
    </div>

    <?php
    if(isset($_POST['submit'])){
        $username = trim($_POST['user']);
        $password = $_POST['pass'];
        
        // Validasi input
        if(empty($username) || empty($password)) {
            echo "<script>
                document.getElementById('errorMessage').textContent = 'Username dan password harus diisi!';
                document.getElementById('errorMessage').classList.add('show');
            </script>";
        } else {
            // Menggunakan prepared statements untuk mencegah SQL injection
            $stmt = $conn->prepare("SELECT * FROM tb_admin WHERE username=? AND password=?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows == 0){
                echo "<script>
                    document.getElementById('errorMessage').textContent = 'Username atau password salah!';
                    document.getElementById('errorMessage').classList.add('show');
                    setTimeout(function() {
                        window.location.href = 'login.php';
                    }, 2000);
                </script>";
            } else {
                $row = $result->fetch_assoc();
                $_SESSION['id_login'] = $row['admin_id'];
                $_SESSION['level'] = $row['level'];
                $_SESSION['status_login'] = true;
                $_SESSION['username'] = $row['username'];

                echo "<script>
                    document.getElementById('successMessage').textContent = 'Login berhasil! Mengalihkan...';
                    document.getElementById('successMessage').classList.add('show');
                    document.getElementById('loginBtn').classList.add('loading');
                    document.getElementById('loginBtn').innerHTML = '<i class=\"fas fa-spinner fa-spin\"></i> Memproses...';
                </script>";

                if($row['level'] == 'admin'){
                    echo '<script type="text/javascript">
                        setTimeout(function() {
                            window.location.href = "admin/dashboard.php";
                        }, 1500);
                    </script>';
                } elseif($row['level'] == 'pelanggan'){
                    echo '<script type="text/javascript">
                        setTimeout(function() {
                            window.location.href = "user/dashboard_user.php";
                        }, 1500);
                    </script>';
                } else {
                    echo '<script type="text/javascript">
                        setTimeout(function() {
                            window.location.href = "index.php";
                        }, 1500);
                    </script>';
                }
            }
            $stmt->close();
        }
    }
    ?>

    <script>
        // Password Toggle
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('passwordInput');
            const toggleIcon = this;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });

        // Form Enhancement
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const username = document.querySelector('input[name="user"]').value.trim();
            const password = document.querySelector('input[name="pass"]').value;
            const errorDiv = document.getElementById('errorMessage');
            
            // Reset error message
            errorDiv.classList.remove('show');
            
            if (username === '' || password === '') {
                e.preventDefault();
                errorDiv.textContent = 'Semua field harus diisi!';
                errorDiv.classList.add('show');
                return false;
            }
            
            // Show loading state
            const loginBtn = document.getElementById('loginBtn');
            loginBtn.classList.add('loading');
            loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
        });

        // Input Focus Effects
        document.querySelectorAll('.input-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('.input-icon').style.color = 'var(--primary-pink)';
            });
            
            input.addEventListener('blur', function() {
                if (this.value === '') {
                    this.parentElement.querySelector('.input-icon').style.color = 'var(--gray)';
                }
            });
        });

        // Auto-hide messages
        setTimeout(function() {
            const errorMsg = document.getElementById('errorMessage');
            const successMsg = document.getElementById('successMessage');
            
            if (errorMsg.classList.contains('show')) {
                errorMsg.classList.remove('show');
            }
            if (successMsg.classList.contains('show')) {
                successMsg.classList.remove('show');
            }
        }, 5000);
    </script>
</body>
</html>