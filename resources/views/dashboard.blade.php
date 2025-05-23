@extends('layouts.app')

@section('content')

<!-- Main Content -->
<div class="flex-1 p-8 bg-gray-50">
  <div class="mb-8">
    <h1 class="font-title text-3xl text-gray-800">Good Morning, {{ session('user')->full_name }}</h1>
    <p class="text-gray-600">We wish you have a productive day!</p>
  </div>

  <!-- Progress Tracker -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="card p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="card-header">To-Do List</h2>
        <span class="text-sm text-gray-500">3-10 MIN</span>
      </div>
      <p class="text-gray-600 text-sm mb-4">A to-do list is a list of tasks to help organize your activities.</p>
      <button class="main-blue text-white py-1 px-4 rounded-full text-sm font-medium">START</button>
    </div>

    <div class="card p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="card-header">Study Goals</h2>
        <span class="text-sm text-gray-500">3-10 MIN</span>
      </div>
      <p class="text-gray-600 text-sm mb-4">Study goals are learning targets set to improve understanding.</p>
      <button class="main-blue text-white py-1 px-4 rounded-full text-sm font-medium">START</button>
    </div>
  </div>

  <!-- Progress Section -->
  <div class="mb-8">
    <h2 class="font-title text-xl text-gray-800 mb-4">Study Goals Progress</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div class="card p-5">
        <h3 class="font-medium text-gray-800 mb-2">Backend Development</h3>
        <div class="w-full bg-gray-200 rounded-full mb-2">
          <div class="main-blue progress-bar rounded-full" style="width: 75%"></div>
        </div>
        <span class="text-sm text-gray-600">75% Complete</span>
      </div>

      <div class="card p-5">
        <h3 class="font-medium text-gray-800 mb-2">Laravel Authentication</h3>
        <div class="w-full bg-gray-200 rounded-full mb-2">
          <div class="main-blue progress-bar rounded-full" style="width: 50%"></div>
        </div>
        <span class="text-sm text-gray-600">50% Complete</span>
      </div>

      <div class="card p-5">
        <h3 class="font-medium text-gray-800 mb-2">Database Normalization</h3>
        <div class="w-full bg-gray-200 rounded-full mb-2">
          <div class="main-blue progress-bar rounded-full" style="width: 90%"></div>
        </div>
        <span class="text-sm text-gray-600">90% Complete</span>
      </div>

      <div class="card p-5">
        <h3 class="font-medium text-gray-800 mb-2">UI/UX Planning</h3>
        <div class="w-full bg-gray-200 rounded-full mb-2">
          <div class="main-blue progress-bar rounded-full" style="width: 25%"></div>
        </div>
        <span class="text-sm text-gray-600">Started • 25%</span>
      </div>
    </div>
  </div>

  <!-- To Do List Section -->
  <div class="mb-8">
    <h2 class="font-title text-xl text-gray-800 mb-4">To-Do List Progress</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div class="card p-5">
        <div class="flex justify-between">
          <h3 class="font-medium text-gray-800">Framework Assignment</h3>
          <span class="text-red-500 text-sm">Deadline • 2 HOURS LEFT</span>
        </div>
      </div>

      <div class="card p-5">
        <div class="flex justify-between">
          <h3 class="font-medium text-gray-800">Write Project Report</h3>
          <span class="text-yellow-600 text-sm">In Progress • Due Tomorrow</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Top Contributors & Notes Section -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Top Contributors -->
    <div class="card p-6">
      <h2 class="card-header mb-4">Top Contributors</h2>
      <div class="space-y-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <img src="/api/placeholder/40/40" alt="Contributor" class="top-contributor-avatar mr-3">
            <div>
              <p class="font-medium">Queen PM Kak Fathya</p>
              <p class="text-sm text-gray-600">120 points • Web Development</p>
            </div>
          </div>
          <span class="text-xs bg-blue-100 text-main-blue py-1 px-2 rounded-full">#1</span>
        </div>
        
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <img src="/api/placeholder/40/40" alt="Contributor" class="top-contributor-avatar mr-3">
            <div>
              <p class="font-medium">Aswangga Asprak of the year</p>
              <p class="text-sm text-gray-600">95 points • Database Design</p>
            </div>
          </div>
          <span class="text-xs bg-blue-100 text-main-blue py-1 px-2 rounded-full">#2</span>
        </div>
        
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <img src="/api/placeholder/40/40" alt="Contributor" class="top-contributor-avatar mr-3">
            <div>
              <p class="font-medium">Caca Umayah</p>
              <p class="text-sm text-gray-600">87 points • Laravel Expert</p>
            </div>
          </div>
          <span class="text-xs bg-blue-100 text-main-blue py-1 px-2 rounded-full">#3</span>
        </div>
      </div>
    </div>

    <!-- Latest Notes -->
    <div class="card p-6">
      <h2 class="card-header mb-4">Recent Notes</h2>
      <div class="space-y-4">
        <div class="border-l-4 border-main-blue pl-3">
          <p class="font-medium">Belajar PPL</p>
          <p class="text-sm text-gray-600">Updated 2 hours ago • Web Programming</p>
        </div>
        
        <div class="border-l-4 border-main-blue pl-3">
          <p class="font-medium">DWBI Tugas 2</p>
          <p class="text-sm text-gray-600">Created yesterday • Database Management</p>
        </div>
        
        <div class="border-l-4 border-main-blue pl-3">
          <p class="font-medium">Integrasi Aplikasi Enterprise</p>
          <p class="text-sm text-gray-600">Created 3 days ago • Web Programming</p>
        </div>
      </div>
      <button class="text-main-blue font-medium text-sm mt-4 inline-flex items-center">
        View all notes
        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
      </button>
    </div>
  </div>
</div>
@endsection