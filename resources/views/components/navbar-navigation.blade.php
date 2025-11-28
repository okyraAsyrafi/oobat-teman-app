<nav class="bg-white border-b border-gray-200 px-4 py-2.5 fixed left-0 right-0 top-0 z-50">
    <div class="flex flex-wrap justify-between items-center">
        <!-- Left: Logo + Hamburger + Search -->
        <div class="flex justify-start items-center">

            <!-- Hamburger (Mobile) - Toggle Sidebar -->
            <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
                aria-controls="drawer-navigation" type="button"
                class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100">
                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Buka sidebar</span>
            </button>

            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logo.png') }}" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap ">Obat Teman TB</span>
            </a>

        </div>

        <!-- Right: Notifications + User Dropdown -->
        <div class="flex items-center space-x-3">

            <!-- Notifications (Opsional) -->
            <button type="button" data-dropdown-toggle="notification-dropdown"
                class="p-2 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                    </path>
                </svg>
                <span class="sr-only">Notifikasi</span>
            </button>

            <!-- User Dropdown -->
            <div class="relative">
                <button type="button" id="user-menu-button" data-dropdown-toggle="user-dropdown"
                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300">
                    <span class="sr-only">Buka menu pengguna</span>
                    @if (Auth::user()->profile_photo_path)
                        <img class="w-8 h-8 rounded-full object-cover"
                            src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}">
                    @else
                        <div
                            class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold text-sm">
                            {{ Str::substr(Auth::user()->name, 0, 2) }}
                        </div>
                    @endif
                </button>

                <!-- Dropdown Menu -->
                <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded-lg shadow-lg border border-gray-200"
                    id="user-dropdown">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <span class="block text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</span>
                        <span class="block text-sm text-gray-500 truncate">{{ Auth::user()->email }}</span>
                    </div>
                    <ul class="py-1">
                        <li>
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profil Saya
                            </a>
                        </li>
                        <li>
                            <hr class="my-1 border-gray-200">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Notification Dropdown (Opsional) -->
<div class="hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded-lg shadow-lg border border-gray-200"
    id="notification-dropdown">
    <div class="px-4 py-3 text-sm font-medium text-center text-gray-900 border-b border-gray-200">
        Notifikasi
    </div>
    <div class="divide-y divide-gray-100">
        <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                    <span class="text-indigo-600 font-bold text-sm">P</span>
                </div>
            </div>
            <div class="pl-3 w-full">
                <div class="text-gray-800 text-sm mb-1">Pasien baru mendaftar</div>
                <div class="text-xs text-gray-500">2 menit yang lalu</div>
            </div>
        </a>
        <!-- Tambah notifikasi lain di sini -->
    </div>
    <a href="#"
        class="block py-2 text-sm font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100 rounded-b-lg">
        Lihat Semua
    </a>
</div>
