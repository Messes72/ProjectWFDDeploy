@extends('User.layout')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <!-- Fixed Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 z-30">
        @include('User.navbar')
    </div>

    <!-- Main Content with left margin for sidebar -->
    <div class="flex-1 ml-64">
        <main class="p-6">
            <div class="max-w-5xl mx-auto">
                <header class="mb-6">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Riwayat Pendaftaran Kursus</h1>
                    <p class="mt-1 text-sm text-gray-600">Berikut adalah daftar kursus yang telah Anda daftar</p>
                </header>

                <div class="space-y-4">
                    @forelse($pendaftarans as $item)
                        <article class="bg-white rounded-lg shadow-sm ring-1 ring-gray-200 hover:shadow-md transition-shadow duration-200">
                            <div class="p-4">
                                <!-- Header Section -->
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <h2 class="text-lg font-semibold text-indigo-600">
                                                {{ $item->course->name }}
                                            </h2>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($item->status === 'pending')
                                                    bg-yellow-50 text-yellow-800
                                                @elseif($item->status === 'accepted')
                                                    bg-green-50 text-green-800
                                                @else
                                                    bg-red-50 text-red-800
                                                @endif">
                                                <i class="fas fa-{{ $item->status === 'pending' ? 'clock' : ($item->status === 'accepted' ? 'check' : 'times') }} mr-1.5"></i>
                                                {{ $item->status === 'pending' ? 'Menunggu Review' : ($item->status === 'accepted' ? 'Diterima' : 'Ditolak') }}
                                            </span>
                                        </div>
                                        <time datetime="{{ $item->created_at }}" class="mt-1 flex items-center text-xs text-gray-500">
                                            <i class="far fa-calendar-alt mr-1.5"></i>
                                            {{ $item->created_at->format('d M Y, H:i') }}
                                        </time>
                                    </div>
                                </div>

                                <!-- Info Grid -->
                                <dl class="grid grid-cols-2 gap-4 text-sm">
                                    <div class="space-y-1">
                                        <div class="flex">
                                            <dt class="text-gray-500">Nama:</dt>
                                            <dd class="text-gray-900 ml-1">{{ $item->name }}</dd>
                                        </div>
                                        <div class="flex">
                                            <dt class="text-gray-500">Email:</dt>
                                            <dd class="text-gray-900 ml-1">{{ $item->email }}</dd>
                                        </div>
                                        <div class="flex">
                                            <dt class="text-gray-500">Telepon:</dt>
                                            <dd class="text-gray-900 ml-1">{{ $item->phone }}</dd>
                                        </div>
                                    </div>
                                    <div class="space-y-1">
                                        <div class="flex">
                                            <dt class="text-gray-500">Sekolah:</dt>
                                            <dd class="text-gray-900 ml-1">{{ $item->school }}</dd>
                                        </div>
                                        <div class="flex">
                                            <dt class="text-gray-500">Pembayaran:</dt>
                                            <dd class="text-gray-900 ml-1">{{ $item->payment_method }}</dd>
                                        </div>
                                    </div>
                                </dl>

                                <div class="mt-3 space-y-2 text-sm border-t border-gray-100 pt-3">
                                    <!-- Alasan Section -->
                                    <div>
                                        <dt class="text-gray-500 mb-1">Alasan Mengikuti Kursus:</dt>
                                        <dd class="text-gray-900">{{ $item->alasan }}</dd>
                                    </div>

                                    <!-- Course Description -->
                                    <div>
                                        <dt class="text-gray-500 mb-1">Deskripsi Kursus:</dt>
                                        <dd class="text-gray-900">{{ $item->course->description }}</dd>
                                    </div>
                                </div>

                                <!-- View Details Button -->
                                <div class="mt-4">
                                    <a href="{{ route('history-detail', ['id' => $item->id]) }}"
                                       class="inline-flex items-center px-3 py-1.5 rounded-md font-medium text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 transition-colors">
                                        <i class="fas fa-eye mr-1.5"></i>
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="text-center py-8 bg-white rounded-lg shadow-sm ring-1 ring-gray-200">
                            <div class="text-base font-medium text-gray-900">Belum ada kursus yang didaftarkan</div>
                            <p class="mt-1 text-sm text-gray-500">Silakan mendaftar kursus terlebih dahulu.</p>
                            <a href="{{ route('courses.index') }}" 
                               class="mt-3 inline-flex items-center px-3 py-1.5 rounded-md font-medium text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 transition-colors">
                                <i class="fas fa-search mr-1.5"></i>
                                Cari Kursus
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
