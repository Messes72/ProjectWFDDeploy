<div class="fixed top-0 left-0 bg-gray-900 text-white h-screen w-64 overflow-y-auto"> <!-- Sidebar dengan lebar tetap -->
    <!-- Header Sidebar -->
    <div class="p-6 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <i class="fas fa-book text-2xl"></i>
            <p class="text-xl font-bold">Pendaftaran Kursus</p>
        </div>
    </div>

    <!-- Menu Utama -->
    <div class="mt-6 flex flex-col space-y-4">
        <!-- Link Dashboard -->
        <button onclick="window.location='{{ route('teachers.index') }}'" class="w-full py-2 px-4 text-left hover:bg-gray-700 flex items-center space-x-3">
            <i class="fas fa-user-graduate"></i>
            <p>Teachers</p>
        </button>
        
        <!-- Link Courses -->
        <button onclick="window.location='{{ route('courses.index') }}'" class="w-full py-2 px-4 text-left hover:bg-gray-700 flex items-center space-x-3">
            <i class="fas fa-book"></i>
            <p>Courses</p>
        </button>

        <!-- Link Courses Management -->
        <button onclick="window.location='{{ route('course-management.index') }}'" class="w-full py-2 px-4 text-left hover:bg-gray-700 flex items-center space-x-3">
            <i class="fas fa-cogs"></i>
            <p>Course Management</p>
        </button>

        <!-- History Pendaftaran -->
        <button onclick="window.location='{{ route('admin.pendaftaran.index') }}'" class="w-full py-2 px-4 text-left hover:bg-gray-700 flex items-center space-x-3">
            <i class="fas fa-history"></i>
            <p>History Pendaftaran</p>
        </button>

        <!-- Periods -->
        <button onclick="window.location='{{ route('periods.index') }}'" class="w-full py-2 px-4 text-left hover:bg-gray-700 flex items-center space-x-3">
            <i class="fas fa-calendar-alt"></i>
            <p>Periods</p>
        </button>

        <button onclick="window.location='{{ route('lessons.index') }}'" class="w-full py-2 px-4 text-left hover:bg-gray-700 flex items-center space-x-3">
            <i class="fas fa-book-open"></i>
            <p>Lessons</p>
        </button>

        <button onclick="window.location='{{ route('assignments.index') }}'" class="w-full py-2 px-4 text-left hover:bg-gray-700 flex items-center space-x-3">
            <i class="fa-solid fa-file-pen"></i>
            <p>Assignments</p>
        </button>

        <!-- User Management -->
        <button onclick="window.location='{{ route('user-management.index') }}'" class="w-full py-2 px-4 text-left hover:bg-gray-700 flex items-center space-x-3">
            <i class="fas fa-user-cog"></i>
            <p>User Management</p>
        </button>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full py-2 px-4 text-left hover:bg-gray-700 flex items-center space-x-3">
                <i class="fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </button>
        </form>
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

    let Main = document.getElementById("Main");
    let open = document.getElementById("open");
    let close = document.getElementById("close");

    const showNav = (flag) => {
        if (flag) {
            Main.classList.toggle("-translate-x-full");
            Main.classList.toggle("translate-x-0");
            open.classList.toggle("hidden");
            close.classList.toggle("hidden");
        }
    };
</script>
