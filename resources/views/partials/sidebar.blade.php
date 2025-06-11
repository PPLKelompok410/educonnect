<div 
  x-data="{
    open: true,
    ready: false,
    init() {
      this.open = JSON.parse(localStorage.getItem('sidebarOpen')) ?? true;
      this.ready = true;
      this.$watch('open', value => localStorage.setItem('sidebarOpen', JSON.stringify(value)));
    }
  }"
  class="flex min-h-screen bg-gray-100"
  x-cloak
>


  <div
    :class="[
      open ? 'w-64' : 'w-20',
      ready ? 'transition-all duration-300 ease-in-out' : ''
    ]"
    class="bg-white border-r border-gray-200 flex flex-col"
  >
    <!-- Logo & Toggle -->
    <div class="flex items-center justify-between p-4 border-b border-gray-200">
      <div class="flex items-center gap-3">
        <div :class="open ? 'block' : 'hidden'" class="text-xl font-bold text-blue-600">
        </div>
      </div>
      <button @click="open = !open" class="text-gray-500 hover:text-gray-700 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>

    <!-- Menu Items -->
    <nav class="flex-1 px-4 py-4 space-y-2">
      <!-- Dashboard -->
      <a href="{{ route('dashboard') }}" 
         class="sidebar-item flex items-center p-3 rounded-lg transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700' : 'hover:bg-blue-50 text-gray-700 hover:text-blue-600' }}">
        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
        </svg>
        <span class="whitespace-nowrap ml-3 transition-all duration-300 font-medium" :class="open ? 'opacity-100 w-auto' : 'opacity-0 w-0'">Dashboard</span>
      </a>

      <!-- Catatan -->
      <a href="{{ route('matkul.index') }}" 
         class="sidebar-item flex items-center p-3 rounded-lg transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('matkul.*') ? 'bg-blue-100 text-blue-700' : 'hover:bg-blue-50 text-gray-700 hover:text-blue-600' }}">
        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
          <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
        </svg>
        <span class="whitespace-nowrap ml-3 transition-all duration-300 font-medium" :class="open ? 'opacity-100 w-auto' : 'opacity-0 w-0'">Catatan</span>
      </a>

      <!-- Events -->
      <a href="{{ route('events.index') }}" 
         class="sidebar-item flex items-center p-3 rounded-lg transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('events.*') ? 'bg-blue-100 text-blue-700' : 'hover:bg-blue-50 text-gray-700 hover:text-blue-600' }}">
        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
        </svg>
        <span class="whitespace-nowrap ml-3 transition-all duration-300 font-medium" :class="open ? 'opacity-100 w-auto' : 'opacity-0 w-0'">Events</span>
      </a>

      <!-- Top Contributor -->
      <a href="{{ route('topcontributors.index') }}" 
         class="sidebar-item flex items-center p-3 rounded-lg transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('topcontributors.*') ? 'bg-blue-100 text-blue-700' : 'hover:bg-blue-50 text-gray-700 hover:text-blue-600' }}">
        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
          <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
        </svg>
        <span class="whitespace-nowrap ml-3 transition-all duration-300 font-medium" :class="open ? 'opacity-100 w-auto' : 'opacity-0 w-0'">Top Contributor</span>
      </a>

      <!-- Bookmarks -->
      <a href="{{ route('bookmarks.index') }}" 
         class="sidebar-item flex items-center p-3 rounded-lg transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('bookmarks.*') ? 'bg-blue-100 text-blue-700' : 'hover:bg-blue-50 text-gray-700 hover:text-blue-600' }}">
        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
         <path d="M5 3a2 2 0 00-2 2v12a1 1 0 001.447.894L10 16.118l5.553 1.776A1 1 0 0017 17V5a2 2 0 00-2-2H5z"/>
        </svg>
        <span class="whitespace-nowrap ml-3 transition-all duration-300 font-medium" :class="open ? 'opacity-100 w-auto' : 'opacity-0 w-0'">Bookmark</span>
      </a>

      <!-- Upgrade Plan -->
      <a href="{{ route('upgrade.plans') }}" 
         class="sidebar-item flex items-center p-3 rounded-lg transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('upgrade.*') ? 'bg-blue-100 text-blue-700' : 'hover:bg-blue-50 text-gray-700 hover:text-blue-600' }}">
          <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
              <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
              <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
          </svg>
          <span class="whitespace-nowrap ml-3 transition-all duration-300 font-medium" :class="open ? 'opacity-100 w-auto' : 'opacity-0 w-0'">Upgrade Plan</span>
      </a>

    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-gray-200">
      <form action="{{ route('auth.login') }}" method="GET">
        @csrf
        <button type="submit" class="flex items-center p-3 rounded-lg text-red-600 hover:bg-red-50 transition-all duration-300 w-full hover:translate-x-1">
          <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
          </svg>
          <span class="whitespace-nowrap ml-3 transition-all duration-300 font-medium" :class="open ? 'opacity-100 w-auto' : 'opacity-0 w-0'">Logout</span>
        </button>
      </form>
    </div>
  </div>
</div>