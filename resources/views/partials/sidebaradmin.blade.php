<div class="w-64 bg-white border-r border-gray-200 p-4">
    <nav class="space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-line mr-3"></i>
            <span>Dashboard</span>
        </a>

        <!-- Add Course -->
        <a href="{{ route('matkul.manage') }}" class="sidebar-item {{ request()->routeIs('matkul.manage') ? 'active' : '' }}">
            <i class="fas fa-book mr-3"></i>
            <span>Add Course</span>
        </a>

        <!-- Manage Events -->
        <a href="{{ route('admin.index') }}" class="sidebar-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <i class="fas fa-calendar-alt mr-3"></i>
            <span>Manage Events</span>
        </a>

        <!-- Manage Upgrade Plan -->
        <a href="{{ route('payments.index') }}" class="sidebar-item {{ request()->routeIs('payments.index') ? 'active' : '' }}">
            <i class="fas fa-money-check-alt mr-3"></i>
            <span>Manage Upgrade Plan</span>
        </a>

        <!-- Logout -->
        <a href="{{ route('auth.logout') }}" class="sidebar-item text-red-600 mt-8">
            <i class="fas fa-sign-out-alt mr-3"></i>
            <span>Logout</span>
        </a>
    </nav>
</div>