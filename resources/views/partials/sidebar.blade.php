<div x-data="{ open: true }" class="flex min-h-screen bg-gray-100">
  <!-- Sidebar -->
  <div :class="open ? 'w-64' : 'w-16'" class="bg-white border-r border-gray-200 transition-all duration-300 ease-in-out flex flex-col">

    <!-- Logo & Toggle -->
    <div class="flex items-center justify-between p-4 border-b border-gray-200">
      <span x-show="open" class="text-lg font-semibold">Menu</span>
      <button @click="open = !open" class="text-gray-500 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>

    <!-- Menu Items -->
    <nav class="flex-1 px-2 py-4 space-y-2">

      <!-- Item: Dashboard -->
      <a href="{{ route('dashboard') }}" class="flex items-center p-2 rounded-md hover:bg-gray-100 text-gray-700 transition">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
        </svg>
        <span
          class="ml-3 whitespace-nowrap inline-block overflow-hidden transition-all duration-300"
          :class="open ? 'opacity-100 w-auto' : 'opacity-0 w-0'">Dashboard</span>
      </a>

      <!-- Item: Catatan -->
      <a href="{{ route('matkul.index') }}" class="flex items-center p-2 rounded-md hover:bg-gray-100 text-gray-700 transition">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
        </svg>
        <span class="ml-3 whitespace-nowrap inline-block overflow-hidden transition-all duration-300"
          :class="open ? 'opacity-100 w-auto' : 'opacity-0 w-0'">Catatan</span>
      </a>

      <!-- Item: Forum Diskusi -->
      <a href="#" class="flex items-center p-2 rounded-md hover:bg-gray-100 text-gray-700 transition">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6zm4 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
        </svg>
        <span class="ml-3 whitespace-nowrap inline-block overflow-hidden transition-all duration-300"
          :class="open ? 'opacity-100 w-auto' : 'opacity-0 w-0'">Forum Diskusi</span>
      </a>

      <!-- Item: Progress Belajar -->
      <a href="#" class="flex items-center p-2 rounded-md hover:bg-gray-100 text-gray-700 transition">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm9 4a1 1 0 10-2 0v6a1 1 0 102 0V7zm-3 2a1 1 0 10-2 0v4a1 1 0 102 0V9zm-3 3a1 1 0 10-2 0v1a1 1 0 102 0v-1z" clip-rule="evenodd" />
        </svg>
        <span class="ml-3 whitespace-nowrap inline-block overflow-hidden transition-all duration-300"
          :class="open ? 'opacity-100 w-auto' : 'opacity-0 w-0'">Progress Belajar</span>
      </a>

      <!-- Item: Top Contributor -->
      <a href="{{ route('topcontributors.index') }}" class="flex items-center p-2 rounded-md hover:bg-gray-100 text-gray-700 transition">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
        </svg>
        <span class="ml-3 whitespace-nowrap inline-block overflow-hidden transition-all duration-300"
          :class="open ? 'opacity-100 w-auto' : 'opacity-0 w-0'">Top Contributor</span>
      </a>

    </nav>


    <!-- Logout -->
    <!-- <div class="p-4 border-t border-gray-200">
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
    </div> -->
  </div>
</div>