<nav class="bg-blue-900 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo / Judul -->
            <div class="flex items-center">
                <span class="text-xl font-bold">Galery Sekolah</span>
            </div>

            <!-- Menu -->
            <div class="hidden space-x-8 sm:flex">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                   class="hover:text-yellow-400 {{ request()->routeIs('dashboard') ? 'text-yellow-400 font-semibold' : '' }}">
                   Dashboard
                </a>

                <!-- Galeri -->
                <a href="{{ route('galleries.index') }}"
                   class="hover:text-yellow-400 {{ request()->routeIs('galleries.*') ? 'text-yellow-400 font-semibold' : '' }}">
                   Galeri
                </a>

                <!-- Kategori -->
                <a href="{{ route('categories.index') }}"
                   class="hover:text-yellow-400 {{ request()->routeIs('categories.*') ? 'text-yellow-400 font-semibold' : '' }}">
                   Kategori
                </a>
            </div>

            <!-- Tombol Logout -->
            <div class="flex items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg font-semibold shadow">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
