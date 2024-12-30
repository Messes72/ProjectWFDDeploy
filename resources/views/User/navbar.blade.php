<nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700 shadow-md fixed top-0 left-0 w-full z-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://img.icons8.com/clouds/100/000000/login-rounded-right.png" class="h-12" alt="Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Pendaftaran Kursus</span>
        </a>

        <!-- Mobile Menu Button -->
        <button data-collapse-toggle="navbar-multi-level" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-multi-level" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <!-- Navbar Content -->
        <div class="hidden w-full md:block md:w-auto" id="navbar-multi-level">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <!-- Profile -->
                <li>
                    <a href="{{ route('profile') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500">Profile</a>
                </li>

                <!-- Dashboard -->
                <li>
                    <a href="{{ route('dashboard') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500">Pendaftaran Kursus</a>
                </li>

                <!-- History Pendaftaran -->
                <li>
                    <a href="{{ route('user.history') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500">History Pendaftaran</a>
                </li>

                <!-- Dropdown Mata Pelajaran -->
                <li class="relative group">
                    <button class="block py-2 px-3 w-full text-left text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 flex items-center justify-between">
                        Mata Pelajaran
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="absolute hidden group-hover:block bg-white dark:bg-gray-800 shadow-md rounded-lg py-2 w-48 z-50">
                        @if (isset($courses) && $courses->isEmpty())
                            <li><span class="block px-4 py-2 text-gray-500">Belum ada mata pelajaran.</span></li>
                        @elseif (isset($courses))
                            @foreach ($courses as $course)
                                <li>
                                    <a href="{{ route('subjects.show', $course->id) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600">
                                        {{ $course->name }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>

                <!-- Dropdown Tugas & Quiz -->
                <li class="relative group">
                    <button class="block py-2 px-3 w-full text-left text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 flex items-center justify-between">
                        Upcoming Tugas
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="absolute hidden group-hover:block bg-white dark:bg-gray-800 shadow-md rounded-lg py-2 w-48 z-10">
                        <li>
                            <span class="block px-4 py-2 text-gray-500">Submenu Tugas & Quiz belum tersedia.</span>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
