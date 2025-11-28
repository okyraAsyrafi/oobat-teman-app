<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pentingnya Minum Obat Rutin - Obat Teman TB</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white font-sans text-teal-800">

    <!-- Section Edukasi Header + Gambar -->
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
            <img src="{{ asset('images/img-edu2.jpg') }}" alt="Ilustrasi Pengobatan TB"
                class="w-full h-[400px] md:h-[550px] object-cover brightness-90">
            <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                <div class="text-center text-white px-4">
                    <h2 class="text-3xl md:text-5xl font-extrabold mb-3 drop-shadow-lg">
                        Pentingnya Minum Obat Rutin
                    </h2>
                    <p class="text-base md:text-lg text-gray-100 max-w-2xl mx-auto drop-shadow">
                        Konsistensi minum obat adalah kunci utama menuju kesembuhan total dari Tuberkulosis (TB).
                        Setiap dosis yang diminum tepat waktu membawa tubuh selangkah lebih dekat untuk benar-benar
                        sembuh.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Konten Edukasi -->
    <div class="py-12 px-6 mx-auto max-w-screen-lg">
        <article class="prose prose-lg max-w-none text-gray-700">
            <h2 class="text-2xl font-bold text-teal-700 mb-4">Tuberkulosis Resisten Obat (MDR-TB)</h2>
            <p>
                <strong>MDR-TB (Multi Drug Resistant Tuberculosis)</strong> adalah bentuk TB yang lebih sulit
                disembuhkan
                karena kuman penyebabnya sudah kebal terhadap dua obat utama, yaitu Isoniazid (INH) dan Rifampisin.
                Kondisi ini muncul akibat pengobatan yang tidak tuntas atau minum obat yang tidak sesuai jadwal.
                Setiap kali pasien melewatkan dosis, kuman TB mendapatkan kesempatan untuk bertahan dan beradaptasi.
                Akibatnya, obat yang sebelumnya efektif menjadi tidak lagi mampu membunuh kuman tersebut.
            </p>
            <p>
                Inilah sebabnya mengapa kepatuhan dalam minum obat sangat penting. TB bukan hanya tentang meminum obat
                saat
                merasa sakit, melainkan komitmen jangka panjang untuk benar-benar mematikan semua kuman di dalam tubuh.
                Sekali pengobatan berhenti di tengah jalan, kuman bisa “belajar” melawan obat — dan inilah awal dari
                resistensi obat yang berbahaya.
            </p>

            <h3 class="text-xl font-semibold text-teal-700 mt-8">Jenis Resistensi Obat TB</h3>
            <ul class="list-disc pl-5 space-y-2">
                <li><strong>Resisten Primer:</strong> Terjadi pada pasien yang belum pernah menjalani pengobatan TB
                    sebelumnya atau baru meminum obat kurang dari satu bulan. Artinya, pasien sudah tertular kuman TB
                    yang
                    memang kebal terhadap obat sejak awal.</li>
                <li><strong>Resisten Sekunder:</strong> Terjadi pada pasien yang sudah pernah menjalani pengobatan TB
                    selama minimal satu bulan, namun pengobatannya tidak teratur sehingga kuman dalam tubuh menjadi
                    kebal
                    terhadap obat yang digunakan.</li>
            </ul>

            <h3 class="text-xl font-semibold text-teal-700 mt-8">Mengapa Resistensi Obat Bisa Terjadi?</h3>
            <p>
                Resistensi obat TB sering kali berawal dari kebiasaan yang tampak sepele: lupa minum obat, merasa sudah
                sehat lalu berhenti, atau takut dengan efek samping obat. Padahal, tindakan-tindakan kecil ini bisa
                berdampak besar bagi keberhasilan pengobatan. Selain itu, beberapa faktor seperti gangguan penyerapan
                obat,
                efek samping yang tidak tertangani, atau kendala transportasi untuk kontrol ke puskesmas juga bisa
                memperparah situasi.
            </p>
            <ul class="list-disc pl-5 space-y-2">
                <li>Tidak patuh minum obat sesuai jadwal harian.</li>
                <li>Masalah penyerapan obat di saluran pencernaan (malabsorpsi).</li>
                <li>Efek samping obat yang membuat pasien enggan melanjutkan pengobatan.</li>
                <li>Keterbatasan informasi, jarak ke fasilitas kesehatan, atau biaya perjalanan.</li>
            </ul>

            <div class="grid md:grid-cols-2 gap-6 mt-8">
                <img src="{{ asset('images/img-edu3.jpg') }}" alt="Ilustrasi Resistensi TB"
                    class="rounded-lg shadow-md object-cover w-full h-72 md:h-80">
                <img src="{{ asset('images/img-edu2.jpg') }}" alt="Pasien TB minum obat"
                    class="rounded-lg shadow-md object-cover w-full h-72 md:h-80">
            </div>

            <h3 class="text-xl font-semibold text-teal-700 mt-8">Tanda-Tanda Awal Kegagalan Pengobatan</h3>
            <p>
                Mengetahui tanda awal kegagalan pengobatan sangat penting agar pasien bisa segera mendapatkan
                penanganan lanjutan. Jangan abaikan jika batuk tidak kunjung membaik dalam dua minggu pertama setelah
                mulai minum obat. Demam yang tetap tinggi, keringat malam, dan berat badan yang tidak naik juga bisa
                menjadi sinyal bahwa pengobatan belum berjalan efektif.
            </p>
            <ul class="list-disc pl-5 space-y-2">
                <li>Batuk tidak membaik setelah dua minggu pengobatan.</li>
                <li>Demam dan keringat malam terus berlanjut.</li>
                <li>Tidak ada peningkatan berat badan meskipun sudah rutin minum obat.</li>
            </ul>

            <h3 class="text-xl font-semibold text-teal-700 mt-8">Lama dan Tahapan Pengobatan TB</h3>
            <p>
                Pengobatan TB terdiri dari dua tahap penting: fase intensif dan fase lanjutan. Pada fase intensif,
                pasien akan mendapatkan pengawasan ketat untuk memastikan jumlah kuman berkurang secara signifikan.
                Setelah itu, fase lanjutan dilakukan untuk benar-benar menuntaskan sisa kuman yang masih tersisa.
            </p>
            <ul class="list-disc pl-5 space-y-2">
                <li><strong>Fase Intensif:</strong> Minimal 2 bulan, tergantung hasil pemeriksaan BTA dan kultur dahak.
                </li>
                <li><strong>Fase Lanjutan:</strong> Minimal 4 bulan untuk memastikan tubuh bebas dari kuman TB aktif.
                </li>
                <li><strong>Total Pengobatan:</strong> Biasanya berlangsung 6–9 bulan, dapat diperpanjang sesuai kondisi
                    medis pasien.</li>
            </ul>

            <h3 class="text-xl font-semibold text-teal-700 mt-8">Sebelum Pulang dari Rumah Sakit</h3>
            <p>
                Sebelum pasien TB diizinkan pulang dari rumah sakit, ada beberapa hal penting yang harus dipahami.
                Pasien perlu tahu cara minum obat yang benar, jadwal kontrol berikutnya, serta kepada siapa harus
                melapor bila muncul keluhan. Edukasi tentang etika batuk dan pentingnya menjaga sirkulasi udara di rumah
                juga sangat ditekankan untuk mencegah penularan ke anggota keluarga.
            </p>
            <ul class="list-disc pl-5 space-y-2">
                <li>Memahami cara minum obat TB dengan benar dan disiplin.</li>
                <li>Mengetahui jadwal kontrol dan pemeriksaan rutin.</li>
                <li>Memiliki kontak petugas kesehatan untuk konsultasi.</li>
                <li>Menjalankan etika batuk dan menjaga kebersihan rumah.</li>
            </ul>

            <div class="mt-10 p-6 bg-teal-50 border-l-4 border-teal-600 rounded-md">
                <p class="text-teal-800 font-semibold text-lg mb-2">Jangan Kucilkan Penderita TB!</p>
                <p class="text-gray-700 leading-relaxed">
                    TB bukanlah kutukan, bukan pula penyakit keturunan. Dengan pengobatan yang teratur, penderita TB
                    bisa sembuh total dan kembali beraktivitas seperti biasa. Dukungan keluarga dan lingkungan sekitar
                    berperan besar dalam proses pemulihan. Jika ada gejala TB, segera periksa diri ke fasilitas
                    kesehatan terdekat. Semua obat TB disediakan <strong>gratis</strong> di puskesmas dan rumah sakit
                    pemerintah.
                    Mari bersama kita wujudkan Indonesia bebas TB melalui gerakan <strong>TOSS TB:
                        Temukan, Obati, Sampai Sembuh.</strong>
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
