@php
    use Illuminate\Support\Facades\Route;

    // Ambil nama rute saat ini, contoh: 'medication.schedules.create'
    $routeName = request()->route()->getName();

    // Jika tidak ada nama rute, hentikan eksekusi
    if (!$routeName) {
        return;
    }

    // Pecah nama rute menjadi segmen: ['admin', 'users', 'edit']
    $segments = explode('.', $routeName);

    // Peta Terjemahan (Hanya untuk kata-kata inti dan aksi)
    $segmentMap = [
        'dashboard' => 'Dashboard',
        'patient' => 'Data Pasien',
        'educations' => 'Edukasi',
        'medication' => 'Jadwal Obat',
        'schedules' => 'Jadwal Obat',
        'index' => 'Daftar',
        'create' => 'Tambah Baru',
        'edit' => 'Edit',
        'show' => 'Detail',
        'admin' => 'Admin',
        'users' => 'Akun Petugas',
        'roles' => 'Kelola Role',
        'telenursing' => 'Telenursing',
        'questionnaire' => 'Kuisioner',
        'question_answer' => 'Hasil Kuisioner',
    ];

    $breadcrumbs = [];
    $currentPath = [];

    // Iterasi melalui segmen untuk membangun jalur breadcrumb
    foreach ($segments as $segment) {
        // Abaikan segmen 'dashboard' dan 'index' jika bukan yang pertama
        if ($segment === 'dashboard' || ($segment === 'index' && count($currentPath) > 0)) {
            continue;
        }

        // Simpan segmen saat ini
        $currentPath[] = $segment;

        // Gunakan $segmentMap, jika tidak ada, gunakan ucfirst() dan ganti underscore
        $label = $segmentMap[$segment] ?? ucfirst(str_replace('_', ' ', $segment));

        $routeNameAttempt = implode('.', $currentPath);
        $url = null;

        // 💡 LOGIKA UNTUK MENCEGAH UrlGenerationException:

        // 1. Cek apakah ini adalah rute Resource (collection/index), yang tidak butuh ID
        if (Route::has($routeNameAttempt . '.index')) {
            // Jika rute resource, arahkan ke rute index (cth: admin.users.index)
            $url = route($routeNameAttempt . '.index');
        } elseif (Route::has($routeNameAttempt)) {
            // 2. Cek apakah ini rute biasa (non-resource)

            // Pastikan rute tidak memerlukan parameter (cth: dashboard, telenursing.index)
            $route = Route::getRoutes()->getByName($routeNameAttempt);
            if ($route && empty($route->parameterNames())) {
                $url = route($routeNameAttempt);
            }
        }

        $breadcrumbs[] = [
            'label' => $label,
            'url' => $url, // URL akan null jika rute butuh parameter (cth: {user})
        ];

        // Item terakhir tidak memiliki tautan
        if (end($segments) === $segment) {
            $breadcrumbs[count($breadcrumbs) - 1]['url'] = null;
            break;
        }
    }
@endphp

<nav class="flex mb-5" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">

        <!-- 💡 ITEM DASHBOARD DITAMBAHKAN SECARA MANUAL DI SINI (SELALU PERTAMA) -->
        <li class="inline-flex items-center">
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                </svg>
                Dashboard
            </a>
        </li>

        <!-- ITEM DINAMIS DARI SEGMENT RUTE -->
        @foreach ($breadcrumbs as $breadcrumb)
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>

                    @if ($breadcrumb['url'])
                        <a href="{{ $breadcrumb['url'] }}"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            {{ $breadcrumb['label'] }}
                        </a>
                    @else
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                            {{ $breadcrumb['label'] }}
                        </span>
                    @endif
                </div>
            </li>
        @endforeach

    </ol>
</nav>
