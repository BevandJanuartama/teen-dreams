<?php include('session.php') ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Teen Dream Admin Dashboard - Fashion Management System">
    <title>Teen Dream Admin - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
    
    <style>
        :root {
            --primary-pink: #ff69b4;
            --light-pink: #ffb6c1;
            --dark-pink: #e1477f;
            --pale-pink: #ffeef2;
            --white: #ffffff;
            --gray: #666666;
            --light-gray: #f8f9fa;
            --dark-gray: #333333;
            --shadow: rgba(255, 105, 180, 0.3);
            --gradient: linear-gradient(135deg, var(--primary-pink), var(--dark-pink));
            --sidebar-width: 280px;
            --header-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(135deg, var(--pale-pink) 0%, var(--white) 100%);
            color: var(--dark-gray);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Layout Wrapper */
        .wrapper {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--white);
            box-shadow: 2px 0 20px var(--shadow);
            transition: all 0.3s ease;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 1000;
            overflow-y: auto;
            transform: translateX(0);
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        /* Sidebar Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: var(--light-gray);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--light-pink);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--primary-pink);
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Header */
        .header {
            background: var(--white);
            height: var(--header-height);
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .openbtn {
            background: var(--gradient);
            border: none;
            color: var(--white);
            padding: 12px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px var(--shadow);
        }

        .openbtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px var(--shadow);
        }

        .header-title {
            color: var(--dark-pink);
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--pale-pink);
            padding: 8px 16px;
            border-radius: 25px;
            color: var(--dark-pink);
            font-weight: 600;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
        }

        /* Content Section */
        .section {
            flex: 1;
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .welcome-section {
            background: var(--white);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--gradient);
        }

        .welcome-section h1 {
            color: var(--dark-pink);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .welcome-section .admin-name {
            color: var(--primary-pink);
            text-shadow: 0 2px 4px var(--shadow);
        }

        .welcome-description {
            color: var(--gray);
            font-size: 1.1rem;
            margin-bottom: 25px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .stat-card {
            background: var(--white);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.3s ease;
            border-left: 5px solid var(--primary-pink);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.15);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--white);
            font-size: 1.5rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-pink);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--gray);
            font-weight: 500;
        }

        /* Quick Actions */
        .quick-actions {
            background: var(--white);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: 30px;
        }

        .quick-actions h2 {
            color: var(--dark-pink);
            font-size: 1.5rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            background: var(--pale-pink);
            color: var(--dark-pink);
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .action-btn:hover {
            background: var(--gradient);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px var(--shadow);
        }

        .action-btn i {
            font-size: 1.2rem;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .header {
                padding: 0 20px;
            }

            .header-title {
                font-size: 1.4rem;
            }

            .section {
                padding: 20px;
            }

            .welcome-section {
                padding: 25px;
            }

            .welcome-section h1 {
                font-size: 2rem;
                flex-direction: column;
                gap: 10px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }

            .user-info span {
                display: none;
            }
        }

        /* Overlay for mobile */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        .overlay.active {
            display: block;
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid var(--light-pink);
            border-radius: 50%;
            border-top-color: var(--primary-pink);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Fade in animation */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar (included from separate file) -->
        <div class="sidebar" id="sidebar">
            <?php include 'sidebar.php' ?>
        </div>

        <!-- Overlay for mobile -->
        <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <button class="openbtn" onclick="toggleSidebar()" title="Toggle Menu">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="header-title">
                        <i class="fas fa-heart" style="color: var(--primary-pink);"></i>
                        Teen Dream Admin
                    </h1>
                </div>
                <div class="header-right">
                    <div class="user-info">
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <span><?php echo htmlspecialchars($user_row["admin_name"]) ?></span>
                    </div>
                </div>
            </header>

            <!-- Main Content Section -->
            <main class="section">
                <!-- Welcome Section -->
                <div class="welcome-section fade-in">
                    <h1>
                        <i class="fas fa-crown" style="color: var(--primary-pink);"></i>
                        Selamat Datang, <span class="admin-name"><?php echo htmlspecialchars($user_row["admin_name"]) ?></span>!
                    </h1>
                    <p class="welcome-description">
                        Kelola toko fashion Teen Dream dengan mudah melalui dashboard admin yang modern dan user-friendly.
                    </p>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid fade-in" style="animation-delay: 0.2s;">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="stat-number" id="productCount">
                            <div class="loading"></div>
                        </div>
                        <div class="stat-label">Total Produk</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="stat-number" id="categoryCount">
                            <div class="loading"></div>
                        </div>
                        <div class="stat-label">Kategori</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="stat-number" id="orderCount">
                            <div class="loading"></div>
                        </div>
                        <div class="stat-label">Pesanan Baru</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-number" id="userCount">
                            <div class="loading"></div>
                        </div>
                        <div class="stat-label">Pelanggan</div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions fade-in" style="animation-delay: 0.4s;">
                    <h2>
                        <i class="fas fa-bolt"></i>
                        Aksi Cepat
                    </h2>
                    <div class="action-buttons">
                        <a href="produk_data.php" class="action-btn">
                            <i class="fas fa-plus-circle"></i>
                            Tambah Produk
                        </a>
                        <a href="kategori_data.php" class="action-btn">
                            <i class="fas fa-folder-plus"></i>
                            Kelola Kategori
                        </a>
                        <a href="chart.php" class="action-btn">
                            <i class="fas fa-shopping-cart"></i>
                            Lihat Pesanan
                        </a>
                        <a href="profil.php" class="action-btn">
                            <i class="fas fa-user-edit"></i>
                            Edit Profil
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Sidebar Toggle Functions
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.getElementById('overlay');
            
            if (window.innerWidth <= 768) {
                // Mobile behavior
                sidebar.classList.toggle('open');
                overlay.classList.toggle('active');
            } else {
                // Desktop behavior
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            }
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                const sidebar = document.getElementById('sidebar');
                const openBtn = document.querySelector('.openbtn');
                
                if (!sidebar.contains(e.target) && !openBtn.contains(e.target)) {
                    closeSidebar();
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.getElementById('overlay');
            
            if (window.innerWidth > 768) {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
            }
        });

        // Load stats data (you would replace this with actual AJAX calls)
        function loadStats() {
            // Simulate loading delay
            setTimeout(() => {
                document.getElementById('productCount').textContent = '124';
                document.getElementById('categoryCount').textContent = '8';
                document.getElementById('orderCount').textContent = '15';
                document.getElementById('userCount').textContent = '89';
            }, 1000);
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadStats();
            
            // Add stagger animation to cards
            const cards = document.querySelectorAll('.stat-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${0.1 * index}s`;
            });
        });

        // Real-time clock (optional)
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID');
            const dateString = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            
            // You can add this to header if needed
            console.log(`${dateString} - ${timeString}`);
        }

        setInterval(updateTime, 1000);
    </script>
</body>
</html>