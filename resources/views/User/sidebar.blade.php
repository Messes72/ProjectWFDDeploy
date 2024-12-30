<div class="flex flex-col bg-gray-900 text-white h-screen w-64 fixed overflow-y-auto"> <!-- Sidebar dengan lebar tetap -->
    <!-- Header Sidebar -->
    <div class="p-6 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <i class="fas fa-book text-2xl"></i>
            <p class="text-xl font-bold">Pendaftaran Kursus</p>
        </div>
    </div>

    <!-- Menu Utama -->
    <div class="mt-6 flex flex-col space-y-4">
        <!-- Link Profile -->
        <button id="user-icon"
            class="w-full py-2 px-4 text-left hover:bg-gray-700 flex items-center space-x-3"
            onclick="window.location='{{ route('profile') }}'">
            <i class="fas fa-user text-xl"></i>
            <p class="text-base leading-4">Profile</p>
        </button>
    </div>
    
    <div class="mt-6 flex flex-col space-y-4">
        <!-- Link Dashboard -->
        <button id="dashboard-icon"
            class="w-full py-2 px-4 text-left hover:bg-gray-700 flex items-center space-x-3"
            onclick="window.location='{{ route('dashboard') }}'">
            <i class="fas fa-dashboard text-xl"></i>
            <p class="text-base leading-4">Pendaftaran Kursus</p>
        </button>
    </div>

    <div class="mt-6 flex flex-col space-y-4">
        <!-- Link History Pendaftaran -->
        <button id="history-icon"
            class="w-full py-2 px-4 text-left hover:bg-gray-700 flex items-center space-x-3"
            onclick="window.location='{{ route('user.history') }}'">
            <i class="fas fa-history text-xl"></i>
            <p class="text-base leading-4">History Pendaftaran</p>
        </button>

        <!-- Dropdown: Mata Pelajaran -->
        <div class="flex flex-col justify-start items-start px-6 border-b border-gray-600 w-full">
            <button onclick="showMenu(1)"
                class="focus:outline-none focus:text-indigo-400 text-white flex justify-between items-center w-full py-5 space-x-14">
                <p class="text-sm leading-5 uppercase">Mata Pelajaran</p>
                <i id="icon1" class="fas fa-chevron-down"></i>
            </button>
            <div id="menu1" class="hidden flex flex-col space-y-2 pl-3 mb-4">
                @if (isset($courses) && $courses->isEmpty())
                    <p class="text-white">Belum ada mata pelajaran yang tersedia.</p>
                @elseif (isset($courses))
                    @foreach ($courses as $course)
                        <button class="text-white flex items-center space-x-2"
                            onclick="window.location='{{ route('subjects.show', $course->id) }}'">
                            <i class="fas fa-book text-lg"></i>
                            <span>{{ $course->name }}</span>
                        </button>
                    @endforeach
                @else
                    <p class="text-gray-400">Data tidak tersedia.</p>
                @endif
            </div>
        </div>

        <!-- Dropdown: Tugas & Quiz -->
        <div class="flex flex-col justify-start items-start px-6 border-b border-gray-600 w-full">
            <button onclick="showMenu(2)"
                class="focus:outline-none focus:text-indigo-400 text-white flex justify-between items-center w-full py-5 space-x-14">
                <p class="text-sm leading-5 uppercase">Upcoming Tugas</p>
                <i id="icon2" class="fas fa-chevron-down"></i>
            </button>
            <div id="menu2" class="hidden flex flex-col pl-6 mt-2 space-y-2">
                <!-- Tambahkan submenu tugas dan quiz di sini -->
                <p class="text-sm text-gray-400">Submenu Tugas & Quiz (belum diisi)</p>
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script>
    const showMenu = (index) => {
        let icon = document.getElementById(`icon${index}`);
        let menu = document.getElementById(`menu${index}`);
        icon.classList.toggle("rotate-180");
        menu.classList.toggle("hidden");
    };
</script>
