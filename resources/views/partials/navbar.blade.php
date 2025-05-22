<header class="main-blue text-white py-4 px-6">
  <div class="container mx-auto flex justify-between items-center">
    <div class="flex items-center">
      <span class="font-title text-2xl">EduConnect</span>
    </div>
    <div class="flex-grow mx-10 max-w-2xl">
      <div class="relative">
        <input type="text" placeholder="Search courses, notes, forums..." class="w-full py-2 px-4 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button class="absolute right-3 top-2.5">
          <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </button>
      </div>
    </div>
    <div class="flex items-center">
      <div class="relative">
        <button class="flex items-center focus:outline-none">
          <img src="/api/placeholder/40/40" alt="Profile" class="rounded-full w-8 h-8 mr-2">
          <span>{{ session('user')->full_name }}</span>
          <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
</header>
