<header class="main-blue text-white py-4 px-6">
  <div class="container mx-auto flex justify-between items-center">
    <div class="flex items-center">
      <span class="font-title text-2xl">EduConnect</span>
    </div>

    <!-- Search -->
    <div class="flex-grow mx-10 max-w-2xl">
      <div class="relative">
        <input type="text" placeholder="Search courses, notes, forums..."
          class="w-full py-2 px-4 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button class="absolute right-3 top-2.5">
          <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </button>
      </div>
    </div>

    <!-- User Dropdown -->
    <div class="flex items-center">
      <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" class="flex items-center focus:outline-none text-white">
          <!-- Icon User -->
          <svg class="w-6 h-6 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196zM15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <!-- User Name -->
          <span class="hidden sm:inline">{{ session('user')->full_name }}</span>
          <!-- Arrow -->
          <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <!-- Dropdown -->
        <div x-show="open" @click.away="open = false" x-transition
          class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg text-gray-800 z-50">
          <a href="{{ route('profiles.index') }}"
            class="block px-4 py-2 hover:bg-gray-100 transition">Profil</a>
          <form action="{{ route('auth.login') }}" method="GET">
            @csrf
            <button type="submit" class="flex items-center text-red-600 hover:text-red-800 transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
              <span x-show="open" class="ml-3">Logout</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</header>