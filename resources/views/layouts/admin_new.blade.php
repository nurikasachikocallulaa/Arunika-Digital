<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SMKN 4 BOGOR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        .sidebar {
            transition: all 0.3s;
        }
        .content-area {
            margin-left: 16rem;
            width: calc(100% - 16rem);
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .content-area {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Mobile menu button -->
    <button id="sidebarToggle" class="md:hidden fixed top-4 left-4 z-50 p-2 rounded-md bg-blue-600 text-white">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
    </button>

    <!-- Sidebar -->
    <aside class="sidebar fixed inset-y-0 left-0 w-64 bg-blue-900 text-white shadow-lg overflow-y-auto z-40">
        <!-- Header with Logo -->
        <div class="p-4 border-b border-blue-800">
            <div class="flex items-center justify-center space-x-3">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo SMKN 4 Bogor" class="h-10 w-10 rounded-full border-2 border-white">
                <div class="text-left">
                    <div class="text-lg font-bold">SMKN 4 Bogor</div>
                    <div class="text-xs text-blue-200">Galeri Sekolah</div>
                </div>
            </div>
        </div>
    
        <!-- Navigation Menu -->
        <nav class="mt-6">
            <div class="px-4 space-y-1">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('dashboard') ? 'bg-blue-800 border-r-4 border-yellow-300' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    </svg>
                    Dashboard
                </a>
                
                <a href="{{ route('galleries.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('galleries*') ? 'bg-blue-800 border-r-4 border-yellow-300' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Galeri
                </a>
                
                <a href="{{ route('categories.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('categories*') ? 'bg-blue-800 border-r-4 border-yellow-300' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Kategori
                </a>
                
                <a href="{{ route('beritas.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('beritas*') ? 'bg-blue-800 border-r-4 border-yellow-300' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    Berita
                </a>
                
                <a href="{{ route('petugas.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('petugas*') ? 'bg-blue-800 border-r-4 border-yellow-300' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20H4v-2a4 4 0 013-3.87" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a4 4 0 10-6 0 4 4 0 006 0z" />
                    </svg>
                    Petugas
                </a>
                
                <a href="{{ route('admin.settings.edit') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('admin/settings*') ? 'bg-blue-800 border-r-4 border-yellow-300' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Pengaturan
                </a>
            </div>
        </nav>
        
        <!-- Logout Button -->
        <div class="absolute bottom-0 w-full p-4 border-t border-blue-800">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="content-area">
        <!-- Page Title -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <h1 class="text-lg font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h1>
        </div>
    </div>

        <!-- Page Content -->
        <main class="min-h-[calc(100vh-4rem)] bg-gray-50">
            <div class="p-4 sm:p-6">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    sidebar.classList.toggle('active');
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = sidebarToggle.contains(event.target);
                
                if (!isClickInsideSidebar && !isClickOnToggle && window.innerWidth < 768) {
                    sidebar.classList.remove('active');
                }
            });
        });
    </script>
    @stack('scripts')
  </body>
</html>