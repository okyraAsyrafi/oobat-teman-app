@php
    // Warna Tema Aplikasi
    $primaryMint = '#3CC39F'; // Mint Green (Aksen Positif)
    $primaryMintHover = '#32A888'; // Hover state 💡 DITAMBAHKAN
    $primaryBlue = '#3D94F8'; // Vibrant Blue (Aksen Utama)
@endphp

{{-- Menghilangkan x-guest-layout bawaan Breeze untuk membuat layout Split-Screen penuh --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Obat Teman') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- 💡 BODY: Tambahkan overflow-x-hidden untuk mencegah scroll horizontal yang tidak diinginkan --}}

<body class="font-sans antialiased bg-gray-50 overflow-x-hidden">

    {{-- min-h-screen memastikan tinggi minimal 100vh --}}
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

        <!-- KIRI: Area Form Login -->
        <div class="flex items-center justify-center p-6 sm:p-8 lg:p-12">
            <!-- Form Container - Menggunakan lebar yang proporsional -->
            <div class="w-full lg:max-w-lg">

                <!-- Logo & Judul -->
                <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
                    <img class="w-8 h-8 mr-2" src="{{ asset('images/logo.png') }}" alt="Logo Obat Teman">
                    <span style="color: {{ $primaryBlue }};">Obat Teman TB</span>
                </a>

                <h1 class="text-3xl font-extrabold text-gray-900 mb-2">
                    Selamat Datang Kembali
                </h1>
                <p class="text-gray-500 mb-8">
                    Silakan masuk ke akun Petugas Anda.
                </p>

                <!-- Session Status / Error -->
                <x-auth-session-status class="mb-4 text-red-500" :status="session('status')" />
                <x-input-error :messages="$errors->get('username')" class="mb-2" />
                <x-input-error :messages="$errors->get('password')" class="mb-4" />


                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Username / NIK -->
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                            class="bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-2 focus:ring-opacity-50 block w-full p-2.5"
                            style="--tw-ring-color: {{ $primaryBlue }}; border-color: {{ $primaryBlue }};"
                            placeholder="Masukkan Username Anda" required autofocus>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-2 focus:ring-opacity-50 block w-full p-2.5"
                            style="--tw-ring-color: {{ $primaryBlue }}; border-color: {{ $primaryBlue }};" required
                            autocomplete="current-password">
                    </div>

                    <div class="flex items-center justify-between">
                        <!-- Remember Me -->
                        {{-- <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember_me" name="remember" type="checkbox"
                                    class="w-4 h-4 border border-gray-300 rounded focus:ring-2 focus:ring-opacity-50"
                                    style="color: {{ $primaryMint }}; border-color: {{ $primaryMint }}; --tw-ring-color: {{ $primaryMint }};">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="remember_me" class="text-gray-500">Ingat Saya</label>
                            </div>
                        </div>

                        <!-- Forgot Password Link -->
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-medium hover:underline"
                                style="color: {{ $primaryBlue }};">
                                Lupa Password?
                            </a>
                        @endif --}}
                    </div>

                    <!-- Submit Button - FIXED HOVER -->
                    <button type="submit"
                        class="w-full text-white font-medium rounded-lg text-lg px-5 py-3 text-center transition duration-200 shadow-md focus:outline-none focus:ring-4"
                        style="background-color: {{ $primaryMint }};"
                        onmouseover="this.style.backgroundColor='{{ $primaryMintHover }}'"
                        onmouseout="this.style.backgroundColor='{{ $primaryMint }}'">
                        Masuk ke Akun
                    </button>

                </form>
            </div>
        </div>

        <!-- KANAN: Area Visual / Ilustrasi (Hanya Tampil di Layar Besar) -->
        <div class="hidden lg:flex items-center justify-center p-10">
            <!-- Menampilkan Ilustrasi -->
            <div class="w-full h-full flex items-center justify-center">
                <img src="{{ asset('images/img-login.png') }}" alt="Ilustrasi Petugas Kesehatan" {{-- 💡 PERBAIKAN: Mengganti max-w-[80vw] menjadi max-w-full agar gambar tidak melebihi kolom parent --}}
                    class="object-contain max-h-[80vh] max-w-full mx-auto">
            </div>
        </div>

    </div>
</body>

</html>
