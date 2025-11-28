<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bernafas Lega dengan ACBT - Obat Teman TB</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white font-sans text-teal-800">

    <!-- Header Section -->
    <section class="w-full">
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
            <img src="{{ asset('images/img-edu4.jpg') }}" alt="Latihan Pernapasan ACBT"
                class="w-full h-[400px] md:h-[550px] object-cover brightness-90">
            <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                <div class="text-center text-white px-4">
                    <h2 class="text-3xl md:text-5xl font-extrabold mb-3 drop-shadow-lg">
                        Bernafas Lega dengan ACBT
                    </h2>
                    <p class="text-base md:text-lg text-gray-100 max-w-2xl mx-auto drop-shadow">
                        Teknik pernapasan sederhana untuk membantu pasien TB membersihkan dahak, memperkuat paru-paru,
                        dan membuat napas terasa lebih lega setiap hari.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Konten Edukasi -->
    <div class="py-12 px-6 mx-auto max-w-screen-lg">
        <article class="prose prose-lg max-w-none text-gray-700">

            <h2 class="text-2xl font-bold text-teal-700 mb-4">Apa itu Tuberkulosis (TB)?</h2>
            <p>
                Tuberkulosis atau TB paru adalah penyakit infeksi serius yang menyerang paru-paru dan disebabkan oleh
                bakteri
                <em>Mycobacterium tuberculosis</em>. Penyakit ini dapat menyerang siapa saja tanpa memandang usia maupun
                latar belakang.
                Walaupun pengobatan TB sudah tersedia dan efektif, perjalanan penyembuhan membutuhkan kesabaran dan
                kedisiplinan tinggi.
                Banyak pasien yang, meskipun sudah mengonsumsi obat secara rutin, masih merasakan sesak napas, nyeri di
                dada,
                cepat lelah, dan kesulitan mengeluarkan dahak.
            </p>
            <p>
                Untuk membantu pemulihan paru-paru secara optimal, pasien perlu melakukan latihan pernapasan.
                Salah satu teknik yang terbukti bermanfaat adalah <strong>Active Cycle of Breathing Technique
                    (ACBT)</strong>,
                latihan sederhana yang bisa dilakukan di rumah untuk membantu mengeluarkan dahak dan memperkuat paru.
            </p>

            <div class="grid md:grid-cols-2 gap-6 mt-6">
                <img src="{{ asset('images/img-edu4.jpg') }}" alt="Ilustrasi penularan TB"
                    class="rounded-lg shadow-md object-cover w-full h-64 md:h-80">
                <img src="{{ asset('images/img-edu5.jpg') }}" alt="Kuman TB"
                    class="rounded-lg shadow-md object-cover w-full h-64 md:h-80">
            </div>

            <h3 class="text-xl font-semibold text-teal-700 mt-10 flex items-center gap-2">
                🫁 Apa itu ACBT?
            </h3>


            <p>
                <strong>Active Cycle of Breathing Technique (ACBT)</strong> adalah teknik latihan pernapasan yang
                dikembangkan
                untuk membantu pasien dengan masalah paru, termasuk penderita TB, agar dapat bernapas lebih efisien.
                Teknik ini terdiri dari serangkaian langkah yang bertujuan untuk mengatur pola napas, membuka saluran
                udara,
                dan mengeluarkan lendir atau dahak dari paru-paru. Latihan ini bisa dilakukan di mana saja, tanpa alat
                khusus,
                dan aman dilakukan oleh semua usia di bawah pengawasan tenaga kesehatan.
            </p>

            <h3 class="text-xl font-semibold text-teal-700 mt-8">🎯 Tujuan ACBT</h3>
            <ul class="list-disc pl-5 space-y-2">
                <li>Meningkatkan kemampuan paru-paru dalam mengatur napas dan mengeluarkan dahak.</li>
                <li>Melatih otot pernapasan agar lebih kuat dan efisien.</li>
                <li>Mengurangi rasa sesak yang sering dirasakan pasien TB.</li>
                <li>Meningkatkan stamina tubuh dan mempercepat proses penyembuhan.</li>
                <li>Menjadikan pasien merasa lebih nyaman dan percaya diri menjalani aktivitas sehari-hari.</li>
            </ul>

            <h3 class="text-xl font-semibold text-teal-700 mt-10 flex items-center gap-2">
                🪶 Persiapan Sebelum Latihan
            </h3>
            <p>
                Sebelum memulai latihan ACBT, penting untuk memastikan tubuh dalam kondisi siap dan rileks.
                Suasana yang tenang akan membantu pasien fokus pada napasnya sehingga hasil latihan menjadi maksimal.
            </p>
            <ul class="list-disc pl-5 space-y-2">
                <li>Duduk tegak di kursi atau posisi setengah duduk di tempat tidur.</li>
                <li>Pastikan ruangan memiliki sirkulasi udara yang baik dan bebas gangguan.</li>
                <li>Kenakan pakaian longgar agar dada dan perut bisa mengembang bebas.</li>
                <li>Siapkan tisu atau wadah bersih untuk membuang dahak setelah latihan.</li>
            </ul>

            <h3 class="text-xl font-semibold text-teal-700 mt-10">🫀 Langkah-langkah ACBT</h3>
            <div class="space-y-6">
                <div>
                    <h4 class="font-bold text-gray-800">Langkah 1: Kontrol Pernapasan</h4>
                    <p>
                        Tarik napas perlahan melalui hidung, lalu hembuskan secara lembut lewat mulut.
                        Lakukan 5–10 kali pernapasan tenang selama 20–30 detik. Gerakan ini membantu menenangkan napas
                        dan mempersiapkan paru untuk latihan berikutnya. Pastikan bahu tetap rileks dan tidak terangkat.
                        <span class="block text-teal-700 font-medium mt-2">💡 Tujuannya:</span>
                        Menenangkan ritme napas dan mengurangi ketegangan otot pernapasan.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-gray-800">Langkah 2: Tarik Napas Dalam</h4>
                    <p>
                        Tarik napas dalam melalui hidung hingga dada terasa mengembang.
                        Tahan napas selama 2–3 detik, lalu hembuskan perlahan lewat mulut.
                        Lakukan sebanyak 3–4 kali dengan ritme tenang.
                        <span class="block text-teal-700 font-medium mt-2">💡 Tujuannya:</span>
                        Membuka bagian paru yang tertutup dan meningkatkan kapasitas paru-paru.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-gray-800">Langkah 3: Huffing (Keluarkan Udara Kuat)</h4>
                    <p>
                        Tarik napas sedang, buka mulut lebar, lalu hembuskan dengan kuat namun terkontrol seperti
                        mengembus
                        kaca agar berembun. Ulangi 1–2 kali. Jika dahak mulai terasa di tenggorokan, keluarkan secara
                        perlahan.
                        <span class="block text-teal-700 font-medium mt-2">💡 Tujuannya:</span>
                        Membantu dahak naik ke saluran napas besar agar lebih mudah dikeluarkan.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-gray-800">Langkah 4: Ulangi Siklus</h4>
                    <p>
                        Lakukan kombinasi keempat langkah di atas secara berulang hingga dahak terasa berkurang.
                        Jika muncul batuk, biarkan terjadi secara alami — itu pertanda dahak sudah mulai keluar dari
                        paru.
                    </p>
                </div>
            </div>

            <h3 class="text-xl font-semibold text-teal-700 mt-10">🌿 Tips Agar Latihan Lebih Efektif</h3>
            <p>
                Beberapa kebiasaan kecil dapat membuat latihan ACBT terasa lebih mudah dan memberikan hasil yang lebih
                cepat.
                Kunci utamanya adalah konsistensi dan kenyamanan selama latihan berlangsung.
            </p>
            <ul class="list-disc pl-5 space-y-2">
                <li>Minum air hangat sebelum latihan agar dahak lebih encer dan mudah keluar.</li>
                <li>Lakukan peregangan ringan atau berjalan santai setelah latihan.</li>
                <li>Usahakan latihan dilakukan pada waktu yang sama setiap hari.</li>
                <li>Catat perubahan yang dirasakan, seperti napas yang lebih lega atau batuk yang berkurang.</li>
                <li>Hindari paparan asap rokok, debu, dan udara kotor selama masa pemulihan.</li>
            </ul>

            <h3 class="text-xl font-semibold text-teal-700 mt-10">⚠️ Hal yang Perlu Diperhatikan</h3>
            <ul class="list-disc pl-5 space-y-2">
                <li>Hentikan latihan jika merasa pusing, nyeri dada, atau kelelahan berlebih.</li>
                <li>Jangan memaksakan napas terlalu dalam jika terasa sesak.</li>
                <li>Konsultasikan kepada tenaga kesehatan sebelum memulai latihan baru.</li>
                <li>Lakukan latihan 2–3 kali sehari atau sesuai saran dokter atau perawat.</li>
            </ul>

            <h3 class="text-xl font-semibold text-teal-700 mt-10">💖 Manfaat yang Akan Dirasakan</h3>
            <ul class="list-disc pl-5 space-y-2">
                <li>Napas menjadi lebih lega dan ritme pernapasan membaik.</li>
                <li>Dahak lebih mudah keluar dan paru terasa bersih.</li>
                <li>Tidur lebih nyenyak karena saluran napas terasa longgar.</li>
                <li>Energi tubuh meningkat dan aktivitas terasa lebih ringan.</li>
                <li>Kualitas hidup pasien dan keluarga meningkat secara nyata.</li>
            </ul>

            <div class="mt-10 p-6 bg-teal-50 border-l-4 border-teal-600 rounded-md">
                <p class="text-teal-800 font-semibold text-lg mb-2 flex items-center gap-2">
                    🤝 Peran Keluarga
                </p>
                <p class="text-gray-700 leading-relaxed">
                    Keluarga memiliki peran yang sangat penting dalam keberhasilan pengobatan TB.
                    Dukungan moral dan perhatian kecil, seperti mengingatkan jadwal latihan dan memberi semangat,
                    dapat membuat pasien lebih termotivasi untuk sembuh.
                    Lingkungan rumah yang bersih, penuh kasih, dan bebas asap rokok menjadi kunci utama dalam pemulihan.
                    <br><br>
                    Catat setiap perkembangan yang terlihat, misalnya frekuensi batuk berkurang atau napas terasa lebih
                    ringan,
                    dan laporkan kepada petugas kesehatan saat kontrol rutin.
                    <strong>“Dukungan keluarga adalah obat terbaik untuk kesembuhan.”</strong>
                </p>
            </div>
        </article>
    </div>

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
