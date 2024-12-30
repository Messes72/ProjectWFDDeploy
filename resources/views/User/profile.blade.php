@extends('User.layout')

@section('content')
    @include('User.navbar')
    <div class="flex-1 container mx-auto px-6 py-20">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-10">
            <i class="fas fa-user-circle text-blue-600"></i> Profil Saya
        </h1>

        @if (Auth::check() && Auth::user()->student)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div
                    class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-5">
                        <i class="fas fa-address-card text-blue-500"></i> Informasi Profil
                    </h2>
                    <hr class="border-t-2 border-gray-300 mb-5">

                    <div class="space-y-4 text-gray-700">
                        <div>
                            <label class="block font-medium">Nama Lengkap</label>
                            <p><i class="fas fa-user mr-2 text-blue-500"></i>{{ Auth::user()->student->name }}</p>
                        </div>
                        <div>
                            <label class="block font-medium">Email</label>
                            <p><i class="fas fa-envelope mr-2 text-blue-500"></i>{{ Auth::user()->email }}</p>
                        </div>
                        <div>
                            <label class="block font-medium">Umur</label>
                            <p><i class="fas fa-birthday-cake mr-2 text-blue-500"></i>{{ Auth::user()->student->age }} tahun</p>
                        </div>
                        <div>
                            <label class="block font-medium">Nomor Telepon</label>
                            <p><i class="fas fa-phone-alt mr-2 text-blue-500"></i>{{ Auth::user()->student->phone }}</p>
                        </div>
                        <div>
                            <label class="block font-medium">Alamat</label>
                            <p><i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>{{ Auth::user()->student->address }}</p>
                        </div>
                        <div>
                            <label class="block font-medium">Sekolah</label>
                            <p><i class="fas fa-school mr-2 text-blue-500"></i>{{ Auth::user()->student->school }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-5">
                        <i class="fas fa-history text-blue-500"></i> Riwayat Pendaftaran
                    </h2>
                    <hr class="border-t-2 border-gray-300 mb-5">

                    @if (Auth::user()->pendaftaran->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach (Auth::user()->pendaftaran as $pendaftaran)
                                <div
                                    class="bg-blue-50 p-4 rounded-lg shadow-md hover:shadow-lg hover:bg-blue-100 transition duration-300">
                                    <h3 class="text-lg font-semibold text-blue-600">
                                        <i class="fas fa-book mr-2"></i>{{ $pendaftaran->course->name }}
                                    </h3>
                                    <p class="text-gray-600 mt-1">
                                        <i class="fas fa-calendar-alt mr-2 text-gray-500"></i>
                                        {{ $pendaftaran->created_at->format('d-m-Y') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center">Belum ada riwayat pendaftaran.</p>
                    @endif
                </div>
            </div>
        @else
            <div class="text-center p-10 bg-red-100 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-red-600 mb-4">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Akun Tidak Ditemukan
                </h2>
                <p>Silakan <a href="{{ route('user.login') }}" class="text-blue-500 underline">login</a> untuk melihat
                    informasi profil Anda.</p>
            </div>
        @endif
    </div>
@endsection
