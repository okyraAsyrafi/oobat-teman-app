<aside
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0"
    aria-label="Sidenav" id="drawer-navigation">
    <div class="overflow-y-auto py-5 px-3 h-full bg-white">

        <!-- ===================== MENU UTAMA ===================== -->
        <ul class="space-y-2">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}" {{-- APLIKASI WARNA TEMA: Active Link Background Mint Green, Text Putih --}}
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group
                    {{ request()->routeIs('dashboard') ? 'text-white' : '' }}"
                    style="{{ request()->routeIs('dashboard') ? 'background-color: #3CC39F;' : '' }}">
                    <svg class="w-6 h-6 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-500 group-hover:text-gray-900' }}"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>

            <!-- Data Pasien -->
            @if (Route::has('patient.index'))
                <li>
                    <a href="{{ route('patient.index') }}" {{-- APLIKASI WARNA TEMA: Active Link Background Mint Green, Text Putih --}}
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group
                        {{ request()->routeIs('patient.*') ? 'text-white' : '' }}"
                        style="{{ request()->routeIs('patient.*') ? 'background-color: #3CC39F;' : '' }}">
                        <svg class="w-6 h-6 {{ request()->routeIs('patient.*') ? 'text-white' : 'text-gray-500 group-hover:text-gray-900' }}"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-3">Data Pasien</span>
                    </a>
                </li>
            @endif

            <!-- Jadwal Obat (Single Link) -->
            @if (Route::has('medication.schedules.index'))
                <li>
                    <a href="{{ route('medication.schedules.index') }}" {{-- APLIKASI WARNA TEMA: Active Link Background Mint Green, Text Putih --}}
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group
                        {{ request()->routeIs('medication.schedules.*') ? 'text-white' : '' }}"
                        style="{{ request()->routeIs('medication.schedules.*') ? 'background-color: #3CC39F;' : '' }}">
                        <svg class="w-6 h-6 {{ request()->routeIs('medication.schedules.*') ? 'text-white' : 'text-gray-500 group-hover:text-gray-900' }}"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-3">Jadwal Obat</span>
                    </a>
                </li>
            @endif

            <!-- Data Edukasi -->
            @if (Route::has('educations.index'))
                <li>
                    <a href="{{ route('educations.index') }}" {{-- APLIKASI WARNA TEMA: Active Link Background Mint Green, Text Putih --}}
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group
                        {{ request()->routeIs('educations.*') ? 'text-white' : '' }}"
                        style="{{ request()->routeIs('educations.*') ? 'background-color: #3CC39F;' : '' }}">
                        <svg class="w-6 h-6 {{ request()->routeIs('educations.*') ? 'text-white' : 'text-gray-500 group-hover:text-gray-900' }}"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M20 14h-2.722L11 20.278a5.511 5.511 0 0 1-.9.722H20a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1ZM9 3H4a1 1 0 0 0-1 1v13.5a3.5 3.5 0 1 0 7 0V4a1 1 0 0 0-1-1ZM6.5 18.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2ZM19.132 7.9 15.6 4.368a1 1 0 0 0-1.414 0L12 6.55v9.9l7.132-7.132a1 1 0 0 0 0-1.418Z" />
                        </svg>

                        <span class="ml-3">Edukasi</span>
                    </a>
                </li>
            @endif


            <!-- Quisioner (Dropdown - Persisten) -->
            @php
                $isQuestionnaireActive =
                    request()->routeIs('questionnaire.*') || request()->routeIs('question_answer.*');
            @endphp
            @if (Route::has('questionnaire.index') || Route::has('question_answer.index'))
                <li>
                    <button type="button" {{-- APLIKASI WARNA TEMA: Dropdown utama berwarna Mint Green jika aktif --}}
                        class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group
                        {{ $isQuestionnaireActive ? 'text-white' : '' }}"
                        style="{{ $isQuestionnaireActive ? 'background-color: #3CC39F;' : '' }}"
                        data-collapse-toggle="dropdown-questionnaire"
                        aria-expanded="{{ $isQuestionnaireActive ? 'true' : 'false' }}">

                        <svg class="w-6 h-6 {{ $isQuestionnaireActive ? 'text-white' : 'text-gray-500 group-hover:text-gray-900' }}"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 0 0-1 1H6a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-2a1 1 0 0 0-1-1H9Zm1 2h4v2h1a1 1 0 1 1 0 2H9a1 1 0 0 1 0-2h1V4Zm5.707 8.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="flex-1 ml-3 text-left">Kuisioner</span>
                        <svg class="w-6 h-6 {{ $isQuestionnaireActive ? 'text-white' : 'text-gray-500' }}"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <ul id="dropdown-questionnaire"
                        class="py-2 space-y-2 {{ $isQuestionnaireActive ? 'block' : 'hidden' }}">
                        <li>
                            <a href="{{ Route::has('questionnaire.index') ? route('questionnaire.index') : '#' }}"
                                class="flex items-center p-2 pl-11 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 {{ request()->routeIs('questionnaire.index') ? 'bg-gray-100 font-semibold text-blue-700' : '' }}">
                                Semua Kuisioner
                            </a>
                        </li>
                        <li>
                            <a href="{{ Route::has('question_answer.index') ? route('question_answer.index') : '#' }}"
                                class="flex items-center p-2 pl-11 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 {{ request()->routeIs('question_answer.*') ? 'bg-gray-100 font-semibold text-blue-700' : '' }}">
                                Hasil Kuisioner
                            </a>
                        </li>
                    </ul>
                </li>
            @endif


            <!-- Telenursing -->
            @if (Route::has('telenursing.index'))
                <li>
                    <a href="{{ route('telenursing.index') }}" {{-- APLIKASI WARNA TEMA: Active Link Background Mint Green, Text Putih --}}
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group
                        {{ request()->routeIs('telenursing.*') ? 'text-white' : '' }}"
                        style="{{ request()->routeIs('telenursing.*') ? 'background-color: #3CC39F;' : '' }}">
                        <svg class="w-6 h-6 {{ request()->routeIs('telenursing.*') ? 'text-white' : 'text-gray-500 group-hover:text-gray-900' }}"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ml-3">Telenursing</span>
                    </a>
                </li>
            @endif

        </ul>

        <!-- ===================== MASTER DATA (Hanya Admin) ===================== -->
        @role('superadmin')
            <div class="mt-8 pt-8 border-t border-gray-300">
                {{-- APLIKASI WARNA TEMA: Judul Master Data menggunakan Vibrant Blue --}}
                <h3 class="px-3 mb-3 text-xs font-bold uppercase tracking-wider" style="color: #3D94F8;">
                    Master Data
                </h3>
                <ul class="space-y-2">

                    <!-- Akun User -->
                    <li>
                        <a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : '#' }}"
                            {{-- APLIKASI WARNA TEMA: Active Link Background Mint Green, Text Putih --}}
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group
                            {{ request()->routeIs('admin.users.*') ? 'text-white' : '' }}"
                            style="{{ request()->routeIs('admin.users.*') ? 'background-color: #3CC39F;' : '' }}">
                            <svg class="w-6 h-6 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-500 group-hover:text-gray-900' }}"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <span class="ml-3">Akun User</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route::has('admin.roles.index') ? route('admin.roles.index') : '#' }}"
                            {{-- APLIKASI WARNA TEMA: Active Link Background Mint Green, Text Putih --}}
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group
                            {{ request()->routeIs('admin.roles.*') ? 'text-white' : '' }}"
                            style="{{ request()->routeIs('admin.roles.*') ? 'background-color: #3CC39F;' : '' }}">
                            <svg class="w-6 h-6 {{ request()->routeIs('admin.roles.*') ? 'text-white' : 'text-gray-500 group-hover:text-gray-900' }}"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.356 3.066a1 1 0 0 0-.712 0l-7 2.666A1 1 0 0 0 4 6.68a17.695 17.695 0 0 0 2.022 7.98 17.405 17.405 0 0 0 5.403 6.158 1 1 0 0 0 1.15 0 17.406 17.406 0 0 0 5.402-6.157A17.694 17.694 0 0 0 20 6.68a1 1 0 0 0-.644-.949l-7-2.666Z" />
                            </svg>
                            <span class="ml-3">Role</span>
                        </a>
                    </li>

                </ul>
            </div>
        @endrole


        <!-- Footer -->
        <div class="absolute bottom-0 left-0 w-full p-4 bg-white border-t border-gray-200 z-20">
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-500">Versi 1.0.0</span>
                {{-- APLIKASI WARNA TEMA: Link Footer menggunakan Vibrant Blue --}}
                <a href="https://obatteman.id" class="hover:underline font-medium" style="color: #3D94F8;">OBAT
                    TEMAN</a>
            </div>
        </div>
</aside>
