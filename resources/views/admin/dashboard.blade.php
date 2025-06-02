<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EduConnect</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-family: 'Inter', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo i {
            font-size: 1.8rem;
        }

        .search-container {
            flex: 1;
            max-width: 500px;
            margin: 0 2rem;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: none;
            border-radius: 50px;
            font-size: 0.9rem;
            font-family: 'Poppins', sans-serif;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            backdrop-filter: blur(10px);
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.2);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .add-course-btn {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 25px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .add-course-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 25px;
            transition: background 0.3s ease;
        }

        .profile:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .profile-avatar {
            width: 35px;
            height: 35px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .profile-name {
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Layout */
        .layout {
            display: flex;
            min-height: calc(100vh - 80px);
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: white;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
            padding: 1.5rem 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar-menu {
            flex: 1;
            list-style: none;
        }

        .sidebar-item {
            margin-bottom: 0.5rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.5rem;
            color: #64748b;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .sidebar-link:hover, .sidebar-link.active {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            margin: 0 0.75rem;
            border-radius: 12px;
            transform: translateX(4px);
        }

        .sidebar-link i {
            width: 20px;
            font-size: 1.1rem;
        }

        .logout-btn {
            margin: 1rem 0.75rem 0;
            padding: 0.875rem 1.5rem;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logout-btn:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem;
        }

        .welcome-section {
            margin-bottom: 2rem;
        }

        .welcome-title {
            font-family: 'Inter', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .welcome-subtitle {
            font-size: 1rem;
            color: #64748b;
            font-weight: 400;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .stat-title {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
        }

        .stat-icon.blue { background: linear-gradient(135deg, #2563eb, #1d4ed8); }
        .stat-icon.green { background: linear-gradient(135deg, #10b981, #059669); }
        .stat-icon.purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
        .stat-icon.orange { background: linear-gradient(135deg, #f59e0b, #d97706); }

        .stat-value {
            font-family: 'Inter', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .stat-change {
            font-size: 0.8rem;
            color: #10b981;
            font-weight: 500;
        }

        .stat-change.negative {
            color: #ef4444;
        }

        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .chart-card {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .chart-title {
            font-family: 'Inter', sans-serif;
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .chart-placeholder {
            height: 300px;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 0.9rem;
        }

        /* Recent Activity */
        .activity-section {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .activity-title {
            font-family: 'Inter', sans-serif;
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            font-size: 0.9rem;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .activity-time {
            font-size: 0.8rem;
            color: #64748b;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .charts-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 1rem;
            }
            
            .search-container {
                display: none;
            }
            
            .sidebar {
                position: fixed;
                left: -250px;
                height: 100%;
                z-index: 1000;
                transition: left 0.3s ease;
            }
            
            .sidebar.active {
                left: 0;
            }
            
            .main-content {
                padding: 1rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Action Buttons */
        .action-btn {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
        }

        .action-btn.secondary {
            background: #f8fafc;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .action-btn.secondary:hover {
            background: #f1f5f9;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            EduConnect
        </div>
        
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search courses, users, analytics...">
        </div>
        
        <div class="header-right">
            <button class="add-course-btn" onclick="showAddCourseModal()">
                <i class="fas fa-plus"></i> Add Course
            </button>
            
            <div class="profile" onclick="toggleProfileMenu()">
                <div class="profile-avatar">
                    <i class="fas fa-user-shield"></i>
                </div>
                <span class="profile-name">Admin</span>
            </div>
        </div>
    </header>

    <!-- Layout -->
    <div class="layout">
        <!-- Sidebar -->
        <nav class="sidebar">
            <ul class="sidebar-menu">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-book"></i>
                        Add Course
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-users"></i>
                        Pengguna
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-comments"></i>
                        Forum Diskusi
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-chart-bar"></i>
                        Analytics
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-trophy"></i>
                        Top Contributors
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('payments.index') }}" class="sidebar-link" target="_self">
                        <i class="fas fa-money-check-alt"></i>
                        Manage Upgrade Plan
                    </a>
                </li>

            </ul>
            
            <a href="{{ route('auth.login') }}" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>

        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <h1 class="welcome-title">Admin Dashboard</h1>
                <p class="welcome-subtitle">Kelola platform EduConnect dengan mudah dan efisien</p>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Total Pengguna</div>
                        <div class="stat-icon blue">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-value">2,847</div>
                    <div class="stat-change">+12% dari bulan lalu</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Mata Kuliah Aktif</div>
                        <div class="stat-icon green">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                    <div class="stat-value">156</div>
                    <div class="stat-change">+8% dari bulan lalu</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Forum Diskusi</div>
                        <div class="stat-icon purple">
                            <i class="fas fa-comments"></i>
                        </div>
                    </div>
                    <div class="stat-value">1,243</div>
                    <div class="stat-change">+15% dari bulan lalu</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Penyelesaian Kursus</div>
                        <div class="stat-icon orange">
                            <i class="fas fa-medal"></i>
                        </div>
                    </div>
                    <div class="stat-value">89%</div>
                    <div class="stat-change stat-change negative">-2% dari bulan lalu</div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-section">
                <div class="chart-card">
                    <h3 class="chart-title">Aktivitas Pengguna (30 Hari Terakhir)</h3>
                    <div class="chart-placeholder">
                        <i class="fas fa-chart-line" style="margin-right: 0.5rem;"></i>
                        Grafik Aktivitas Pengguna
                    </div>
                </div>

                <div class="chart-card">
                    <h3 class="chart-title">Distribusi Mata Kuliah</h3>
                    <div class="chart-placeholder">
                        <i class="fas fa-chart-pie" style="margin-right: 0.5rem;"></i>
                        Pie Chart Distribusi
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="activity-section">
                <h3 class="activity-title">Aktivitas Terbaru</h3>
                
                <div class="activity-item">
                    <div class="activity-avatar">JD</div>
                    <div class="activity-content">
                        <div class="activity-text">John Doe mendaftar mata kuliah "Advanced React Development"</div>
                        <div class="activity-time">2 menit yang lalu</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-avatar">MA</div>
                    <div class="activity-content">
                        <div class="activity-text">Maria Anderson menyelesaikan quiz "Database Fundamentals"</div>
                        <div class="activity-time">15 menit yang lalu</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-avatar">RK</div>
                    <div class="activity-content">
                        <div class="activity-text">Robert Kim membuat post baru di Forum Diskusi</div>
                        <div class="activity-time">1 jam yang lalu</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-avatar">SL</div>
                    <div class="activity-content">
                        <div class="activity-text">Sarah Lee menambahkan mata kuliah baru "UI/UX Design Principles"</div>
                        <div class="activity-time">3 jam yang lalu</div>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 1rem;">
                    <button class="action-btn secondary">
                        <i class="fas fa-eye"></i>
                        Lihat Semua Aktivitas
                    </button>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Sidebar functionality
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }

        // Profile menu functionality
        function toggleProfileMenu() {
            alert('Profile menu clicked! Implement dropdown menu here.');
        }

        // Add course modal
        function showAddCourseModal() {
            alert('Add Course modal would open here!');
        }

        // Logout functionality
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                // In Laravel, you would redirect to logout route
                window.location.href = '/admin/logout';
            }
        }

        // Search functionality
        document.querySelector('.search-input').addEventListener('input', function(e) {
            const searchTerm = e.target.value;
            console.log('Searching for:', searchTerm);
            // Implement search functionality here
        });

        // Sidebar link clicks
        document.querySelectorAll('.sidebar-link').forEach(item => {
            item.addEventListener('click', function(e) {
                if (this.getAttribute('href') === '#') {
                    e.preventDefault(); // hanya untuk link kosong
                }
            });
        });

        // Real-time updates simulation
        function updateStats() {
            const stats = document.querySelectorAll('.stat-value');
            stats.forEach(stat => {
                const currentValue = parseInt(stat.textContent.replace(/,/g, ''));
                const change = Math.floor(Math.random() * 10) - 5;
                const newValue = Math.max(0, currentValue + change);
                
                if (stat.textContent.includes('%')) {
                    stat.textContent = Math.min(100, Math.max(0, parseInt(stat.textContent) + change)) + '%';
                } else {
                    stat.textContent = newValue.toLocaleString();
                }
            });
        }

        // Update stats every 30 seconds (for demo purposes)
        setInterval(updateStats, 30000);

        // Responsive handling
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.querySelector('.sidebar').classList.remove('active');
            }
        });

        // Add mobile menu toggle (you can add a hamburger button for mobile)
        function addMobileMenuToggle() {
            if (window.innerWidth <= 768) {
                const header = document.querySelector('.header');
                const menuButton = document.createElement('button');
                menuButton.innerHTML = '<i class="fas fa-bars"></i>';
                menuButton.className = 'mobile-menu-btn';
                menuButton.style.cssText = `
                    background: none;
                    border: none;
                    color: white;
                    font-size: 1.2rem;
                    cursor: pointer;
                    display: block;
                `;
                menuButton.onclick = toggleSidebar;
                header.insertBefore(menuButton, header.firstChild.nextSibling);
            }
        }

        // Initialize mobile menu on load and resize
        window.addEventListener('load', addMobileMenuToggle);
        window.addEventListener('resize', function() {
            const existingBtn = document.querySelector('.mobile-menu-btn');
            if (existingBtn) existingBtn.remove();
            addMobileMenuToggle();
        });
    </script>
</body>
</html>