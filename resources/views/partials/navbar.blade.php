<header class="main-blue text-white py-4 px-6">
  <div class="container mx-auto flex justify-between items-center">
    <div class="flex items-center">
      <span class="font-title text-2xl">EduConnect</span>
    </div>
    <div class="flex-grow mx-10 max-w-2xl">
      <div class="relative">
        <input type="text" placeholder="Search courses, notes, forums..." class="w-full py-2 px-4 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button class="absolute right-3 top-2.5">
          <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </button>
      </div>
    </div>

    @php
    $userTransaction = null;
    @endphp
    
    <div class="flex items-center">
      <div class="relative">
        <a href="{{ route('profiles.index') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-10 focus:outline-none transition-all duration-200">
          <!-- Profile Picture -->
          <div class="w-8 h-8 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
            <span class="text-sm font-semibold text-white">
              {{ strtoupper(substr($user->full_name, 0, 1)) }}
            </span>
          </div>

          <!-- User Info -->
          <div class="flex items-center">
            <span class="font-medium text-white">{{ $user->full_name }}</span>
            @if ($user && isset($user->id))
                @php
                    $userTransaction = \App\Models\Transaction::where('user_id', $user->id)
                                                              ->with('payment')
                                                              ->latest()
                                                              ->first();
                @endphp
            @endif
            
            @if($userTransaction && $userTransaction->payment)
                <span class="package-badge" style="background-color: #10b981; color: white; font-size: 0.75rem; padding: 2px 8px; border-radius: 12px; font-weight: 500; margin-left: 8px;">
                    {{ $userTransaction->payment->package }}
                </span>
            @endif
          </div>
        </a>

        <!-- Optional: Hover Tooltip -->
        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 hidden group-hover:block">
          <a href="{{ route('profiles.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            View Profile
          </a>
        </div>
      </div>
    </div>
  </div>
</header>