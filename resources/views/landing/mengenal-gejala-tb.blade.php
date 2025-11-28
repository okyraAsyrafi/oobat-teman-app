<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edukasi Tuberkulosis - Obat Teman TB</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white font-sans text-teal-800">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.png') }}" class="h-8" alt="Obat Teman TB">
                <span class="text-2xl font-semibold">Obat Teman TB</span>
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="w-full">
        <!-- Judul & Tombol Kembali -->
        <div class="max-w-screen-xl mx-auto px-4 py-6">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3">
                Edukasi
            </h1>
            <a href="{{ url('/') }}"
                class="inline-flex items-center text-teal-700 hover:text-teal-800 font-medium transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        <!-- Gambar Full Width -->
        <div class="relative">
            <img src="{{ asset('images/img-edu1.jpg') }}" alt="Ilustrasi Tuberkulosis"
                class="w-full h-[400px] md:h-[550px] object-cover brightness-90">
            <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                <div class="text-center text-white px-4">
                    <h2 class="text-3xl md:text-5xl font-extrabold mb-3 drop-shadow-lg">
                        Mengenal Tuberkulosis (TB)
                    </h2>
                    <p class="text-base md:text-lg text-gray-100 max-w-2xl mx-auto drop-shadow">
                        Edukasi lengkap tentang penyebab, gejala, dan pencegahan TB agar kita lebih peduli terhadap
                        kesehatan paru.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="content" class="py-12 px-4 mx-auto max-w-screen-lg leading-relaxed text-gray-700 space-y-8">
        <h2 class="text-3xl font-bold text-gray-900">Apa itu Tuberkulosis (TB)?</h2>
        <p>
            <strong>Tuberkulosis (TB)</strong> adalah penyakit menular yang disebabkan oleh kuman
            <em>Mycobacterium tuberculosis</em>. Kuman ini dapat menyerang siapa saja, tanpa memandang usia, jenis
            kelamin,
            ataupun latar belakang sosial. TB paling sering menyerang paru-paru, tetapi juga bisa mengenai bagian tubuh
            lain seperti tulang, kelenjar getah bening, kulit, hingga otak.
            Penyakit ini bukanlah penyakit keturunan, bukan pula karena guna-guna, dan sama sekali bukan karena diracuni
            orang.
            TB adalah penyakit yang bisa dijelaskan secara medis dan dapat disembuhkan sepenuhnya jika diobati dengan
            baik.
        </p>
        <p>
            Di Indonesia, TB masih menjadi salah satu penyebab kematian tertinggi dari penyakit menular.
            Hal ini karena banyak penderita yang tidak menyadari gejalanya sejak awal, atau berhenti minum obat sebelum
            waktunya.
            Padahal, dengan pengobatan yang teratur dan dukungan dari keluarga serta tenaga kesehatan, TB bisa sembuh
            total.
            Pemahaman yang benar tentang TB adalah langkah pertama untuk mencegah penyebarannya.
        </p>

        <div class="bg-teal-50 border-l-4 border-teal-400 p-4 rounded-md">
            <h3 class="font-semibold text-teal-800 mb-1">TB adalah…</h3>
            <p>
                Penyakit infeksi menular yang disebabkan oleh kuman <em>Mycobacterium tuberculosis</em>,
                yang dapat hidup di lingkungan lembab tanpa sinar matahari selama beberapa jam.
                Namun, kuman ini mudah mati bila terkena sinar matahari langsung.
                TB menyebar terutama melalui udara, sehingga tempat tinggal yang tertutup dan kurang ventilasi menjadi
                lokasi berisiko tinggi.
                Jika tidak diobati, TB dapat merusak jaringan paru-paru secara perlahan dan menyebabkan komplikasi
                serius
                seperti gagal napas, bahkan kematian. Karena itu, penanganan dini sangat penting.
            </p>
        </div>

        <h3 class="text-2xl font-semibold text-teal-800">Cara Penularan TB</h3>
        <p>
            Penularan TB terjadi melalui udara. Ketika penderita TB paru batuk, bersin, atau bahkan berbicara,
            percikan dahak (droplet) yang berisi kuman TB akan keluar ke udara dan melayang-layang dalam waktu tertentu.
            Seseorang bisa tertular TB ketika menghirup udara yang sudah terkontaminasi kuman tersebut,
            terutama jika berada di tempat tertutup tanpa sirkulasi udara yang baik.
        </p>
        <p>
            Kuman TB masuk melalui saluran pernapasan, mengendap di paru-paru, lalu berkembang biak di dalam tubuh.
            Pada beberapa orang, sistem kekebalan tubuh mampu menahan kuman agar tidak aktif, namun pada orang lain
            (terutama dengan daya tahan tubuh lemah), kuman dapat menjadi aktif dan menyebabkan penyakit TB.
            Itulah sebabnya orang dengan penyakit kronis seperti diabetes, HIV/AIDS, atau gizi buruk lebih rentan
            terkena TB.
        </p>

        <div class="grid md:grid-cols-2 gap-6 mt-6">
            <img src="{{ asset('images/img-educat2.png') }}" alt="Ilustrasi penularan TB"
                class="rounded-lg shadow-md object-cover w-full h-64 md:h-80">
            <img src="{{ asset('images/img-edu1.jpg') }}" alt="Kuman TB"
                class="rounded-lg shadow-md object-cover w-full h-64 md:h-80">
        </div>


        <h3 class="text-2xl font-semibold text-teal-800">Gejala Utama TB</h3>
        <p>
            Gejala utama TB paru adalah batuk yang tidak kunjung sembuh selama lebih dari dua minggu,
            biasanya disertai dengan dahak yang kental. Kadang-kadang penderita juga dapat mengeluarkan
            dahak bercampur darah. Batuk ini bukan batuk biasa — batuk TB biasanya berlangsung lama, terasa berat,
            dan tidak mereda dengan obat batuk biasa.
            Karena itu, siapa pun yang mengalami batuk berkepanjangan sebaiknya segera memeriksakan diri ke puskesmas
            untuk mendapatkan pemeriksaan dahak secara gratis.
        </p>

        <h3 class="text-2xl font-semibold text-teal-800">Gejala Lain yang Perlu Diwaspadai</h3>
        <p>
            Selain batuk, TB juga sering disertai dengan gejala tambahan yang menunjukkan bahwa tubuh sedang melawan
            infeksi.
            Gejala-gejala ini bisa berbeda pada tiap orang, namun umumnya meliputi sesak napas, nyeri dada, badan terasa
            lemah,
            penurunan berat badan tanpa sebab, dan demam ringan yang tak kunjung hilang.
            Penderita juga bisa mengalami keringat malam walau tidak beraktivitas berat.
            Karena gejala TB berkembang perlahan, banyak orang yang tidak menyadarinya sampai penyakit sudah cukup
            parah.
        </p>

        <ul class="list-disc pl-6 space-y-1">
            <li>Batuk berdahak selama dua minggu atau lebih</li>
            <li>Dahak bisa bercampur darah</li>
            <li>Sesak napas dan nyeri dada saat menarik napas dalam</li>
            <li>Penurunan berat badan yang cepat tanpa sebab jelas</li>
            <li>Nafsu makan berkurang dan tubuh terasa lemah</li>
            <li>Berkeringat di malam hari meskipun tidak melakukan kegiatan</li>
            <li>Demam ringan yang datang dan pergi selama lebih dari sebulan</li>
        </ul>

        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
            <h3 class="font-semibold text-yellow-800 mb-2">💡 Pencegahan Penularan untuk Penderita TB</h3>
            <p class="mb-2">
                TB bisa dicegah. Penderita TB memiliki peran penting dalam menghentikan rantai penularan penyakit.
                Selain rutin minum obat, ada beberapa kebiasaan sehat yang perlu dilakukan setiap hari.
                Langkah-langkah sederhana berikut tidak hanya membantu proses penyembuhan, tapi juga melindungi keluarga
                dan orang-orang di sekitar dari risiko tertular.
            </p>
            <ol class="list-decimal pl-6 space-y-1">
                <li>Minum obat TB secara teratur sesuai anjuran dokter hingga pengobatan selesai.</li>
                <li>Selalu menutup mulut dan hidung saat batuk atau bersin menggunakan tisu atau siku bagian dalam.</li>
                <li>Hindari meludah sembarangan di lantai atau tempat umum yang bisa menjadi media penularan.</li>
                <li>Gunakan wadah khusus berisi sabun atau cairan desinfektan untuk meludah, dan buang secara aman.</li>
                <li>Jemur kasur dan bantal secara rutin agar kuman yang menempel bisa mati karena panas matahari.</li>
                <li>Buka jendela rumah setiap pagi agar udara segar dan sinar matahari bisa masuk, karena kuman TB cepat
                    mati di bawah sinar matahari.</li>
                <li>Gunakan masker saat berada di tempat umum atau saat berinteraksi dengan orang lain di dalam rumah.
                </li>
            </ol>
        </div>

        <div class="text-center mt-12">
            <h3 class="text-3xl font-extrabold text-teal-700 mb-2">Ayo Berantas TB…!!!</h3>
            <p class="text-gray-600 mb-4">
                Tuberkulosis bukan kutukan — penyakit ini bisa disembuhkan dengan pengobatan yang benar, teratur, dan
                tuntas.
                Mari dukung gerakan nasional <strong>TOSS TB</strong> (Temukan, Obati, Sampai Sembuh) yang bertujuan
                memutus rantai penularan di masyarakat. Dengan mendeteksi TB sedini mungkin, memberikan obat sesuai
                aturan,
                serta memastikan pasien sembuh sepenuhnya, kita semua turut berperan dalam menciptakan lingkungan bebas
                TB.
            </p>
            <p class="text-gray-600 mb-4">
                Dukung teman, keluarga, dan masyarakat sekitar untuk tidak takut memeriksakan diri.
                TB bukan aib, tapi ujian kesehatan yang bisa dihadapi bersama dengan kepedulian dan semangat sembuh.
            </p>
            <div class="flex justify-center">
                <div class="bg-teal-600 text-white rounded-xl px-6 py-3 shadow-md">
                    <p class="font-semibold tracking-wide">T • TEMUKAN</p>
                    <p class="font-semibold tracking-wide">O • OBATI</p>
                    <p class="font-semibold tracking-wide">SS • SAMPAI SEMBUH</p>
                </div>
            </div>
        </div>
    </section>




    <!-- Footer -->
    <footer class="p-6 bg-gray-800 text-white mt-12">
        <div class="max-w-screen-xl mx-auto text-center">
            <div class="flex justify-center items-center mb-4">
                <img src="{{ asset('images/logo.png') }}" class="h-8 mr-2" alt="logo">
                <span class="text-lg font-semibold">Obat Teman TB</span>
            </div>
            <p class="text-gray-400 text-sm mb-4">
                Edukasi dan sistem manajemen TB terpadu. Bersama kita bisa memutus rantai penularan.
            </p>
            <hr class="border-gray-700 mb-4">
            <p class="text-gray-500 text-sm">© {{ date('Y') }} Obat Teman TB. Semua hak dilindungi.</p>
        </div>
    </footer>

</body>

</html>
