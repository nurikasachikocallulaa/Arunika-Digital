<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SMKN 4 BOGOR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        <!-- Top Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">@yield('page-title')</h1>
                <div class="text-sm text-gray-600">
                    Admin Panel
                </div>
            </div>
        </header>
        
        <!-- Main Content -->
        <main class="p-6 bg-gray-50 min-h-screen">
            @yield('content')
        </main>
    </div>

</body>
</html>
