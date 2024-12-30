@extends('User.layout')

@section('content')
    @include('User.navbar')
    <div id="main-content" class="flex-1 px-6 py-8 mt-20 overflow-auto">
        <div class="flex justify-between items-center mb-4">
            <div class="relative w-1/3">
                <input type="text" id="search-input" placeholder="Cari..."
                    class="border border-gray-300 rounded-lg px-4 py-2 w-full">
                <button id="clear-search"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-transparent border-none cursor-pointer hidden">
                    <span class="fas fa-times"></span>
                </button>
            </div>
            <div class="relative">
                <button id="profile-button" class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-1">Profil</button>
                <div class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg hidden" id="profile-menu">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Pengaturan</a>
                    <a href="{{ route('user.login') }}" class="block px-4 py-2 hover:bg-gray-200">Keluar</a>
                </div>
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-4">Kursus untuk Periode Aktif</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="matkul-container">
            @if ($courses->isEmpty())
                <p class="text-gray-500">Tidak ada kursus yang tersedia untuk periode aktif.</p>
            @else
                @foreach ($courses as $course)
                    <div class="bg-white p-4 rounded-lg shadow-md matkul-item">
                        <h3 class="font-bold text-gray-700">{{ $course->name }}</h3>
                        <hr class="my-2 border-gray-300">
                        <p class="text-gray-600">{{ $course->description }}</p>
                        <p class="text-gray-500 text-sm mt-2">
                            Period: {{ $course->period ? $course->period->year : 'N/A' }} - Semester {{ $course->period ? $course->period->semester : 'N/A' }}
                        </p>
                        <div class="flex justify-end mt-4">
                            <a href="{{ route('pendaftaran', $course->id) }}"
                                class="bg-blue-500 text-white px-4 py-2 rounded mt-2 inline-block hover:bg-blue-600">
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        // Fitur pencarian
        $('#search-input').on('input', function() {
            var searchValue = $(this).val().toLowerCase();
            $('#clear-search').toggle(searchValue.length > 0);
            $('.matkul-item').each(function() {
                var matkulTitle = $(this).find('h3').text().toLowerCase();
                var matkulDescription = $(this).find('p').text().toLowerCase();
                if (matkulTitle.includes(searchValue) || matkulDescription.includes(searchValue)) {
                    $(this).slideDown(300);
                } else {
                    $(this).slideUp(300);
                }
            });
        });

        // Menghapus teks pencarian
        $('#clear-search').click(function() {
            $('#search-input').val('');
            $('#search-input').trigger('input');
        });
    </script>
@endsection
