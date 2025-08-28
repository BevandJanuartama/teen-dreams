<?php
// sidebar.php - Teen Dream Admin Sidebar Component

// Get current page for active menu detection
$current_page = basename($_SERVER['PHP_SELF']);

// Menu items configuration
$menu_items = [
    [
        'title' => 'Dashboard',
        'url' => 'dashboard.php',
        'icon' => 'fas fa-home',
        'badge' => null
    ],
    [
        'title' => 'Profile',
        'url' => 'profil.php',
        'icon' => 'fas fa-user-circle',
        'badge' => null
    ],
    [
        'title' => 'Category',
        'url' => 'kategori_data.php',
        'icon' => 'fas fa-tags',
        'badge' => null
    ],
    [
        'title' => 'Product',
        'url' => 'produk_data.php',
        'icon' => 'fas fa-shopping-bag',
        'badge' => null
    ],
    [
        'title' => 'Cart',
        'url' => 'chart.php',
        'icon' => 'fas fa-shopping-cart',
        'badge' => null
    ],
    [
        'title' => 'Checkout',
        'url' => 'checkout.php',
        'icon' => 'fas fa-credit-card',
        'badge' => null
    ],
    [
        'title' => 'Finish',
        'url' => 'selesai.php',
        'icon' => 'fas fa-check-circle',
        'badge' => null
    ]
];
?>

<style>
    /* Sidebar specific styles */
    .sidebar-header {
        background: linear-gradient(135deg, var(--primary-pink), var(--dark-pink));
        color: var(--white);
        padding: 25px 20px;
        text-align: center;
        position: relative;
        margin-bottom: 20px;
    }

    .sidebar-header::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 4px;
        background: var(--primary-pink);
        border-radius: 2px;
    }

    .sidebar-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .sidebar-subtitle {
        font-size: 0.9rem;
        opacity: 0.9;
        font-weight: 400;
    }

    .logo-icon {
        width: 45px;
        height: 45px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 1.3rem;
        backdrop-filter: blur(10px);
    }

    /* Navigation Menu */
    .nav-menu {
        list-style: none;
        padding: 0 15px 20px;
        margin: 0;
    }

    .nav-menu li {
        margin-bottom: 5px;
    }

    .nav-menu a {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 14px 18px;
        color: var(--gray);
        text-decoration: none;
        font-weight: 500;
        font-size: 15px;
        border-radius: 12px;
        transition: all 0.3s ease;
        position: relative;
        border: 2px solid transparent;
    }

    .nav-menu a:hover {
        background: var(--pale-pink);
        color: var(--dark-pink);
        border-color: var(--light-pink);
        transform: translateX(5px);
    }

    .nav-menu a.active {
        background: linear-gradient(135deg, var(--primary-pink), var(--dark-pink));
        color: var(--white);
        font-weight: 600;
        box-shadow: 0 4px 15px var(--shadow);
    }

    .nav-menu a.active i {
        color: var(--white);
    }

    .nav-menu i {
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
        color: var(--primary-pink);
        transition: color 0.3s ease;
    }

    .nav-menu a:hover i {
        color: var(--dark-pink);
    }

    /* Badge Styles */
    .menu-badge {
        background: var(--primary-pink);
        color: var(--white);
        font-size: 11px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 12px;
        margin-left: auto;
        min-width: 20px;
        text-align: center;
        animation: pulse 2s infinite;
    }

    .nav-menu a.active .menu-badge {
        background: rgba(255,255,255,0.3);
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* Logout Section */
    .logout-section {
        border-top: 1px solid var(--light-gray);
        margin-top: 20px;
        padding: 20px 15px 0;
    }

    .nav-menu a.logout {
        color: #dc3545;
        background: #ffe6e6;
        border-color: transparent;
    }

    .nav-menu a.logout:hover {
        background: #dc3545;
        color: var(--white);
        border-color: #dc3545;
    }

    .nav-menu a.logout i {
        color: #dc3545;
    }

    .nav-menu a.logout:hover i {
        color: var(--white);
    }

    /* User Info in Sidebar */
    .sidebar-user-info {
        padding: 15px 20px;
        background: var(--pale-pink);
        margin: 0 15px 20px;
        border-radius: 12px;
        text-align: center;
    }

    .sidebar-user-avatar {
        width: 50px;
        height: 50px;
        background: var(--gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        color: var(--white);
        font-size: 1.2rem;
    }

    .sidebar-user-name {
        font-weight: 600;
        color: var(--dark-pink);
        font-size: 14px;
        margin-bottom: 5px;
    }

    .sidebar-user-role {
        font-size: 12px;
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .sidebar-header {
            padding: 20px 15px;
        }
        
        .sidebar-title {
            font-size: 1.2rem;
        }
        
        .nav-menu {
            padding: 0 10px 15px;
        }
        
        .nav-menu a {
            padding: 12px 15px;
            font-size: 14px;
        }
        
        .logout-section {
            padding: 15px 10px 0;
        }
    }
</style>

<!-- Sidebar Header -->
<div class="sidebar-header">
    <div class="logo-icon">
        <i class="fas fa-heart"></i>
    </div>
    <div class="sidebar-title">
        <i class="fas fa-crown"></i>
        Teen Dream
    </div>
    <div class="sidebar-subtitle">Fashion Admin Panel</div>
</div>

<!-- User Info (if needed) -->
<?php if (isset($user_row) && !empty($user_row["admin_name"])): ?>
<div class="sidebar-user-info">
    <div class="sidebar-user-avatar">
        <i class="fas fa-user"></i>
    </div>
    <div class="sidebar-user-name"><?php echo htmlspecialchars($user_row["admin_name"]) ?></div>
    <div class="sidebar-user-role">Administrator</div>
</div>
<?php endif; ?>

<!-- Navigation Menu -->
<ul class="nav-menu">
    <?php foreach ($menu_items as $item): ?>
        <li>
            <a href="<?php echo $item['url'] ?>" 
               class="<?php echo ($current_page == $item['url']) ? 'active' : '' ?>"
               title="<?php echo $item['title'] ?>">
                <i class="<?php echo $item['icon'] ?>"></i>
                <span><?php echo $item['title'] ?></span>
                <?php if ($item['badge']): ?>
                    <span class="menu-badge"><?php echo $item['badge'] ?></span>
                <?php endif; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<!-- Logout Section -->
<div class="logout-section">
    <ul class="nav-menu">
        <li>
            <a href="../logout.php" 
               class="logout" 
               onclick="return confirmLogout()"
               title="Logout dari sistem">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>

<script>
    // Logout confirmation function
    function confirmLogout() {
        return confirm('Apakah Anda yakin ingin keluar dari Teen Dream Admin?');
    }

    // Update badge numbers dynamically (example)
    function updateMenuBadges() {
        // This would typically come from AJAX calls to your backend
        const badges = {
            'kategori_data.php': '8',
            'produk_data.php': '124',
            'chart.php': '3'
        };

        Object.keys(badges).forEach(page => {
            const link = document.querySelector(`a[href="${page}"]`);
            if (link) {
                const badge = link.querySelector('.menu-badge');
                if (badge) {
                    badge.textContent = badges[page];
                    // Add animation when updated
                    badge.style.animation = 'none';
                    setTimeout(() => {
                        badge.style.animation = '';
                    }, 10);
                }
            }
        });
    }

    // Contoh pemanggilan fungsi (misal setelah AJAX atau saat dokumen siap)
    document.addEventListener('DOMContentLoaded', () => {
        updateMenuBadges();
    });
</script>
