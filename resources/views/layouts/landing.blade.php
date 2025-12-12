<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.9s ease-out, transform 0.9s ease-out;
        }

        .animate-on-scroll.appear {
            opacity: 1;
            transform: translateY(0);
        }

        .animate-img {
            opacity: 0;
            transform: scale(0.95);
            transition: opacity 1s ease, transform 1s ease;
        }

        .animate-img.appear {
            opacity: 1;
            transform: scale(1);
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-white font-sans text-teal-800">
    <nav id="navbar-default" class="bg-white border-gray-200 ">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#navbar-default" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logo.png') }}" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap ">Obat Teman TB</span>
            </a>

            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-teal-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>

            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white md:items-center">
                    <li>
                        <a href="#fitur-section"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-teal-100 md:hover:bg-transparent md:border-0 md:hover:text-teal-700 md:p-0">Fitur</a>
                    </li>
                    <li>
                        <a href="#tb-section"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-teal-100 md:hover:bg-transparent md:border-0 md:hover:text-teal-700 md:p-0">TB</a>
                    </li>
                    <li>
                        <a href="#education-section"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-teal-100 md:hover:bg-transparent md:border-0 md:hover:text-teal-700 md:p-0">Edukasi</a>
                    </li>
                    <li>
                        <a href="#download-section"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-teal-100 md:hover:bg-transparent md:border-0 md:hover:text-teal-700 md:p-0">Download</a>
                    </li>
                    <li class="mt-2 md:mt-0">
                        <a href="{{ route('login') }}"
                            class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-4 py-2 text-center block w-full md:w-auto">
                            Login Petugas
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="hero-section" class="py-12 md:py-16 relative">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ asset('images/GEDUNG-RSUD3.jpg') }}'); ">
        </div>

        <div class="absolute inset-0" style="background-color: rgba(20, 184, 166, 0.7); ">
        </div>

        <div class="mx-auto grid max-w-screen-xl px-4 pb-8 md:grid-cols-12 lg:gap-12 lg:pb-16 xl:gap-0 relative z-10">
            <div class="content-center justify-self-start md:col-span-7 md:text-start text-white">
                <span
                    class="bg-teal-100 text-teal-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm border border-teal-400 shadow-md">
                    Sistem Manajemen TB Terpadu
                </span>
                <h1
                    class="my-8 text-4xl font-extrabold leading-none tracking-tight md:max-w-2xl md:text-5xl xl:text-6xl">
                    Kelola Pengobatan TB<br />Dengan Mudah
                </h1>
                <p class="mb-4 max-w-2xl text-gray-100 md:mb-12 md:text-lg mb-3 lg:mb-5 lg:text-xl">
                    Platform terintegrasi untuk pasien TB dan petugas kesehatan. Tingkatkan compliance pasien,
                    monitor progress, dan edukasi kesehatan dalam satu sistem.
                </p>

                <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                    <button type="button"
                        class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center shadow-lg transition duration-150">
                        <svg class="mr-3 w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01" />
                        </svg>
                        Download Aplikasi Gratis
                    </button>

                    <a href="{{ route('login') }}"
                        class="text-white bg-transparent border border-white hover:bg-white hover:text-teal-700 focus:ring-4 focus:outline-none focus:ring-white/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center transition duration-150">
                        <svg class="mr-2 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                        </svg>
                        Login Petugas
                    </a>
                </div>
            </div>

            <div class="hidden md:col-span-5 md:mt-0 md:flex relative z-10">
                <img src="{{ asset('images/img-hero2.png') }}" alt="gambar hero section" />
            </div>
        </div>
    </section>

    <section id="fitur-section" class="bg-teal-50 ">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="max-w-screen-md mb-8 mx-auto text-center lg:mb-16">
                <h2 class="mb-4 text-5xl tracking-tight font-extrabold text-gray-900 ">
                    Fitur Unggulan
                </h2>
                <p class="text-gray-500 text-3xl sm:text-xl">
                    Solusi lengkap untuk pengelolaan pengobatan TB yang efektif dan efisien bagi kenyamanan pasien.
                </p>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div class="max-w-sm p-8 bg-white border border-gray-200 rounded-lg shadow-sm">
                    <div class="flex flex-col items-center text-center">
                        <span
                            class="inline-flex items-center justify-center w-16 h-16 mb-4 text-sm font-semibold text-teal-800 bg-teal-100 rounded-full ">
                            <svg class="w-6 h-6 text-teal-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.133 12.632v-1.8a5.406 5.406 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.955.955 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z" />
                            </svg>
                        </span>
                        <a href="#" class="mb-2">
                            <h5 class="text-2xl font-semibold tracking-tight text-gray-900 ">Alarm Pengingat</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-500 ">
                            Memberikan kemudahan bagi pasien dalam mendapatkan informasi mengenai pengobatan TB melalui
                            alarm pengingat.
                        </p>
                    </div>
                </div>
                <div class="max-w-sm p-8 bg-white border border-gray-200 rounded-lg shadow-sm">
                    <div class="flex flex-col items-center text-center">
                        <span
                            class="inline-flex items-center justify-center w-16 h-16 mb-4 text-sm font-semibold text-teal-800 bg-teal-100 rounded-full ">
                            <svg class="w-[24px] h-[24px] text-teal-800 " aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z" />
                            </svg>
                        </span>
                        <a href="#" class="mb-2">
                            <h5 class="text-2xl font-semibold tracking-tight text-gray-900 ">Monitoring Obat</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-500 ">
                            Pemantauan penggunaan obat dipantau langsung untuk memastikan kepatuhan pasien terhadap
                            jadwal pengobatan.
                        </p>
                    </div>
                </div>
                <div class="max-w-sm p-8 bg-white border border-gray-200 rounded-lg shadow-sm">
                    <div class="flex flex-col items-center text-center">
                        <span
                            class="inline-flex items-center justify-center w-16 h-16 mb-4 text-sm font-semibold text-teal-800 bg-teal-100 rounded-full ">
                            <svg class="w-[24px] h-[24px] text-teal-800 " aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M20 14h-2.722L11 20.278a5.511 5.511 0 0 1-.9.722H20a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1ZM9 3H4a1 1 0 0 0-1 1v13.5a3.5 3.5 0 1 0 7 0V4a1 1 0 0 0-1-1ZM6.5 18.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2ZM19.132 7.9 15.6 4.368a1 1 0 0 0-1.414 0L12 6.55v9.9l7.132-7.132a1 1 0 0 0 0-1.418Z" />
                            </svg>
                        </span>
                        <a href="#" class="mb-2">
                            <h5 class="text-2xl font-semibold tracking-tight text-gray-900 ">Edukasi</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-500 ">
                            Pemantauan penggunaan obat dipantau langsung untuk memastikan kepatuhan pasien terhadap
                            jadwal pengobatan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="tb-section" class="bg-white ">
        <div
            class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:pt-16 lg:pb-1 lg:px-6">
            <div class="font-light text-gray-500 sm:text-lg ">
                <h2 class="mb-4 text-5xl tracking-tight font-extrabold text-gray-900 ">
                    Apa itu Tuberkulosis (TB)&nbsp;&nbsp;?
                </h2>
                <p class="mb-4 text-xxl text-gray-700">
                    Tuberkulosis (TB) adalah penyakit infeksi yang disebabkan oleh bakteri *Mycobacterium tuberculosis*.
                    Penyakit ini umumnya menyerang paru-paru, tetapi dapat juga menyerang organ tubuh lainnya.
                </p>
                <p class="mb-4 text-xl leading-relaxed text-gray-700">
                    TB menular melalui udara saat penderita batuk, bersin, atau bicara. Droplet yang mengandung bakteri
                    TB bisa masuk ke paru-paru orang lain.
                </p>
                <p class="text-xl leading-relaxed text-gray-700">
                    TB **tidak menular** melalui berjabat tangan, berbagi makanan, atau memakai pakaian/peralatan yang
                    sama.
                </p>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8">
                <img class="w-full rounded-lg object-cover" src="{{ asset('images/img-educat1.png') }}"
                    alt="img-edu-section-1">
                <img class="mt-6 w-full lg:mt-10 rounded-lg object-cover" src="{{ asset('images/img-educat2.png') }}"
                    alt="img-edu-section-2">
            </div>
        </div>
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="max-w bg-teal-600 border border-gray-200 rounded-3xl shadow-sm">
                <div class="max-w-screen-md mb-8 lg:mt-8 px-4">
                    <h2 class="mb-4 text-3xl tracking-tight font-extrabold text-white ">
                        Penting Pengobatan Teratur
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-6 rounded-lg">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-400 mr-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 6l-6-6l-6 6" />
                            </svg>
                            <h3 class="text-2xl font-extrabold text-white">Sembuh Total</h3>
                        </div>
                        <p class="font-light text-white text-base leading-relaxed">
                            Pengobatan yang teratur dan konsisten dapat menyembuhkan TB hingga 95% dalam 6 bulan.
                        </p>
                    </div>
                    <div class="p-6 rounded-lg">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-400 mr-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 6l-6-6l-6 6" />
                            </svg>
                            <h3 class="text-2xl font-extrabold text-white">Cegah Resistensi</h3>
                        </div>
                        <p class="font-light text-white text-base leading-relaxed">
                            Minum obat sesuai jadwal mencegah bakteri menjadi kebal obat (MDR-TB).
                        </p>
                    </div>
                    <div class="p-6 rounded-lg">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3d.org/2000/svg" class="h-8 w-8 text-teal-400 mr-3"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 6l-6-6l-6 6" />
                            </svg>
                            <h3 class="text-2xl font-extrabold text-white">Lindungi Orang Terdekat</h3>
                        </div>
                        <p class="font-light text-white text-base leading-relaxed">
                            Pengobatan mengurangi penularan ke keluarga dan orang sekitar.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="education-section" class=" bg-gray-100">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">

            <div class="max-w-screen-md mb-8 mx-auto text-center lg:mb-16">
                <h2 class="mb-4 text-5xl tracking-tight font-extrabold text-gray-900">
                    Edukasi Terbaru
                </h2>
                <p class="text-gray-500 sm:text-lg">
                    Informasi penting seputar TB, pengobatan, dan tips kesehatan dari petugas kesehatan.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <a href="/edukasi/mengenal-gejala-tb" class="block h-full">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                        <img class="w-full h-48 object-cover" src="{{ asset('images/img-edu1.jpg') }}"
                            alt="Mengenal Gejala TB">
                        <div class="p-5">
                            <span class="text-xs text-teal-600 font-medium">12 Mei 2025</span>
                            <h3 class="mt-2 text-xl font-bold text-gray-900">Mengenal Gejala TB</h3>
                            <p class="mt-2 text-gray-600 text-sm">
                                Kenali gejala awal TB agar bisa segera mendapatkan penanganan.
                            </p>
                        </div>
                    </div>
                </a>
                <a href="/edukasi/pentingnya-minum-obat" class="block h-full">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                        <img class="w-full h-48 object-cover" src="{{ asset('images/img-edu2.jpg') }}"
                            alt="Pentingnya Minum Obat Rutin">
                        <div class="p-5">
                            <span class="text-xs text-teal-600 font-medium">5 Mei 2025</span>
                            <h3 class="mt-2 text-xl font-bold text-gray-900">Pentingnya Minum Obat Rutin</h3>
                            <p class="mt-2 text-gray-600 text-sm">
                                Mengapa jadwal minum obat tidak boleh dilewatkan?
                            </p>
                        </div>
                    </div>
                </a>
                <a href="/edukasi/bernafas-lega-acbt" class="block h-full">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                        <img class="w-full h-48 object-cover" src="{{ asset('images/img-edu4.jpg') }}"
                            alt="Nutrisi untuk Pasien TB">
                        <div class="p-5">
                            <span class="text-xs text-teal-600 font-medium">28 Apr 2025</span>
                            <h3 class="mt-2 text-xl font-bold text-gray-900">Bernafas Lega dengan ACBT</h3>
                            <p class="mt-2 text-gray-600 text-sm">
                                Panduan praktis latihan pernapasan ACBT untuk pasien TB.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section class="bg-white py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="max-w-screen-md mb-8 mx-auto text-center lg:mb-16">
            <h2 class="mb-4 text-5xl tracking-tight font-extrabold text-gray-900">
                Video Edukasi
            </h2>
            <p class="text-gray-500 sm:text-lg">
                Tonton video edukasi langsung dari petugas kesehatan setempat.
            </p>
        </div>
        <div class="flex justify-center">
            <div class="w-full max-w-3xl rounded-xl overflow-hidden shadow-sm border border-gray-200">
                <video class="w-full" controls preload="metadata" poster="{{ asset('images/video-poster.jpg') }}">
                    <source src="{{ asset('videos/etika-batuk.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutaran video.
                </video>
            </div>
        </div>
    </section>

    <section id="download-section" class="py-12 md:py-16 relative">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ asset('images/img-hero7.jpg') }}'); ">
        </div>

        <div class="absolute inset-0" style="background-color: rgba(20, 184, 166, 0.7); ">
        </div>

        <div class="py-6 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6 relative z-10">
            <div class="mx-auto max-w-screen-sm">
                <h2 class="mb-4 text-5xl tracking-tight font-extrabold text-white">
                    Mulai Management TB Sekarang
                </h2>
                <p class="mb-4 text-6xl text-black lg:mb-16 sm:text-xl">
                    Download aplikasi Obat Teman TB sebagai Management System dan dapatkan pengingat minum obat otomatis
                    dan akses ke edukasi TB dari petugas kesehatan profesional.
                </p>
                <button type="button"
                    class="text-white bg-teal-600 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2">
                    <svg class="mr-4 w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01" />
                    </svg>
                    Download Aplikasi Gratis
                </button>
            </div>
        </div>
    </section>

    <footer class="p-4 bg-gray-900 text-white sm:p-8 ">
        <div class="mx-auto max-w-screen-xl">
            <div class="md:flex md:justify-between pb-8 border-b border-gray-700">
                <div class="mb-6 md:mb-0">
                    <a href="#navbar-default" class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" class="mr-3 h-8" alt="Obat Teman TB Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap text-teal-400">Obat Teman
                            TB</span>
                    </a>
                    <p class="mt-3 max-w-xs text-sm text-gray-400">
                        Sistem Manajemen Tuberkulosis (TB) Terpadu, dikembangkan untuk mendukung upaya kesehatan
                        nasional.
                    </p>
                </div>

                <div class="flex flex-wrap gap-8 sm:gap-16 sm:mt-6 md:mt-0">
                    <div class="flex items-center space-x-3 text-white">
                        <svg class="w-6 h-6 text-teal-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M18.427 1.19a2.33 2.33 0 0 0-2.33 2.33V7.21a2.33 2.33 0 0 1-2.33 2.33h-2.12c-2.3 0-4.18 1.88-4.18 4.18v2.12c0 1.28-1.04 2.32-2.32 2.32H3.6c-2.3 0-4.18 1.88-4.18 4.18a3.1 3.1 0 0 0 3.1 3.1h16.2c2.3 0 4.18-1.88 4.18-4.18v-8.49c0-3.32-2.69-6.01-6.01-6.01Z" />
                        </svg>
                        <span class="text-lg font-bold">(0761) 21618</span>
                    </div>

                    <div class="flex items-center space-x-3 text-white">
                        <svg class="w-6 h-6 text-teal-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m3.5 5.5 7.8 7.8 7.8-7.8m-15.6 0H20.2c.4 0 .8.4.8.8v11.4c0 .4-.4.8-.8.8H3.5c-.4 0-.8-.4-.8-.8V6.3c0-.4.4-.8.8-.8Z" />
                        </svg>
                        <span class="text-lg font-bold">rsudarifinachmad@riau.go.id</span>
                    </div>
                </div>
            </div>


            <div class="mt-8 grid grid-cols-2 gap-8 sm:gap-6 lg:grid-cols-4">

                <div>
                    <h2 class="mb-6 text-sm font-semibold text-teal-400 uppercase">Institusi</h2>
                    <ul class="text-gray-400 text-sm">
                        <li class="mb-2">
                            RSUD Arifin Achmad Prov. Riau
                        </li>
                        <li class="mb-2">
                            <span class="font-medium text-white block">Lokasi:</span>
                            Jl. Diponegoro No.2 Sumahilang, Kec. Pekanbaru Kota, Kota Pekanbaru, Riau 28156
                        </li>
                        <li>
                            <span class="font-medium text-white block">Komitmen:</span>
                            Meningkatkan kualitas hidup pasien TB. Serta berkomitmen memberikan pelayanan kesehatan yang
                            meningkatkan kualitas hidup dan harapan masa depan pasien.
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-teal-400 uppercase">Menu Cepat</h2>
                    <ul class="text-gray-400 ">
                        <li class="mb-4"><a href="#fitur-section" class="hover:underline">Fitur Aplikasi</a></li>
                        <li class="mb-4"><a href="#tb-section" class="hover:underline">TB</a></li>
                        <li class="mb-4"><a href="#education-section" class="hover:underline">Edukasi</a></li>
                        <li><a href="#download-section" class="hover:underline">Download Aplikasi</a></li>
                    </ul>
                </div>

                <div>
                    <h2 class="mb-6 text-sm font-semibold text-teal-400 uppercase">Layanan Lain</h2>
                    <ul class="text-gray-400 ">
                        <li class="mb-4"><a href="https://rsudarifinachmad.riau.go.id/dokterkami/#"
                                class="hover:underline">Jadwal Dokter</a></li>
                        <li class="mb-4"><a href="https://rsudarifinachmad.riau.go.id/berita/"
                                class="hover:underline">Berita RSUD</a></li>
                        <li class="mb-4"><a href="#" class="hover:underline">Tim Kesehatan TB</a></li>
                        <li><a href="http://rsudarifinachmad.riau.go.id/" class="hover:underline">Pelayanan RSUD </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="mb-6 text-sm font-semibold text-teal-400 uppercase">Legal & Media</h2>
                    <ul class="text-gray-400 ">
                        <li class="mb-4"><a href="#" class="hover:underline">Privacy Policy</a></li>
                        <li class="mb-4"><a href="#" class="hover:underline">Terms &amp; Conditions</a></li>
                        <li><a href="https://maps.app.goo.gl/Ynbhs4GPmy3f7DWx9" class="hover:underline">Peta RSUD
                                Arifin Achmad</a></li>
                    </ul>
                </div>
            </div>

            <hr class="my-8 border-gray-700 sm:mx-auto lg:my-10" />

            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-400 sm:text-center ">
                    © 2025 <a href="#navbar-default" class="hover:underline">Obat Teman TB</a>. All Rights Reserved.
                    Dikelola oleh RSUD Arifin Achmad Provinsi Riau.
                </span>

                <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                    <a href="http://facebook.com/Rsud%20Arifin%20Achmad"
                        class="text-gray-400 hover:text-teal-400 transition duration-150">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/rsudarifinachmad_official/"
                        class="text-gray-400 hover:text-teal-400 transition duration-150">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-teal-400 transition duration-150">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('appear');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -30px 0px'
            });

            document.querySelectorAll('section.bg-white').forEach(section => {
                section.classList.add('animate-on-scroll');
                observer.observe(section);
            });

            document.querySelectorAll('section.bg-white img').forEach(img => {
                img.classList.add('animate-img');
                observer.observe(img);
            });

            const hero = document.querySelector('section.bg-white.py-8');
            if (hero) {
                hero.classList.add('animate-on-scroll');
                observer.observe(hero);
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
