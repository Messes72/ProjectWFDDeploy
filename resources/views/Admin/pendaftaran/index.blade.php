@extends('Admin.layout')

@section('content')
<div class="flex h-full">
    <!-- Fixed Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-gray-900 z-40">
        @include('Admin.sidebar')
    </div>

    <!-- Main Content -->
    <div class="ml-64 flex-1 min-h-screen bg-gray-100">
        <main class="p-8">
            <div class="max-w-7xl mx-auto">
                <!-- Header Section -->
                <div class="mb-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">History Pendaftaran</h1>
                            <p class="mt-1 text-sm text-gray-600">Kelola dan pantau pendaftaran kursus dari siswa</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                <i class="fas fa-users mr-1.5"></i>
                                Total: {{ $pendaftaran->count() }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="mb-6 bg-white rounded-lg shadow-sm p-4">
                    <form action="{{ route('admin.pendaftaran.index') }}" method="GET" class="flex flex-wrap gap-4">
                        <!-- Course Filter -->
                        <div class="flex-1 min-w-[200px]">
                            <label for="course" class="block text-sm font-medium text-gray-700 mb-1">Kursus</label>
                            <select name="course" id="course" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Semua Kursus</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ request('course') == $course->id ? 'selected' : '' }}>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status Filter -->
                        <div class="flex-1 min-w-[200px]">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" id="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Diterima</option>
                                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="flex items-end space-x-2">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <i class="fas fa-filter mr-1.5"></i>
                                Filter
                            </button>
                            <a href="{{ route('admin.pendaftaran.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                <i class="fas fa-undo mr-1.5"></i>
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Table Section -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="min-w-full divide-y divide-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kursus</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($pendaftaran as $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-gray-500"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $item->email }}</div>
                                                    <div class="text-sm text-gray-500">{{ $item->phone }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-indigo-600">{{ $item->course->name }}</div>
                                            <div class="text-xs text-gray-500 mt-1">
                                                <i class="fas fa-school mr-1"></i>
                                                {{ $item->school }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
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
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <i class="far fa-calendar-alt mr-1.5 text-gray-400"></i>
                                                {{ $item->created_at->format('d M Y') }}
                                                <span class="text-gray-400 mx-1">·</span>
                                                <i class="far fa-clock mr-1.5 text-gray-400"></i>
                                                {{ $item->created_at->format('H:i') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center space-x-3">
                                                <button type="button" 
                                                        onclick="showDetails('{{ $item->id }}')"
                                                        class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-sm font-medium text-indigo-600 rounded-md hover:bg-indigo-100 transition-colors duration-150">
                                                    <i class="fas fa-eye mr-1.5"></i>
                                                    Detail
                                                </button>

                                                @if($item->status === 'pending')
                                                    <form action="{{ route('admin.pendaftaran.updateStatus', $item->id) }}" method="POST" class="flex space-x-2">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" name="status" value="accepted"
                                                                class="inline-flex items-center px-3 py-1.5 bg-green-50 text-sm font-medium text-green-600 rounded-md hover:bg-green-100 transition-colors duration-150">
                                                            <i class="fas fa-check mr-1.5"></i>
                                                            Terima
                                                        </button>
                                                        <button type="submit" name="status" value="failed"
                                                                class="inline-flex items-center px-3 py-1.5 bg-red-50 text-sm font-medium text-red-600 rounded-md hover:bg-red-100 transition-colors duration-150">
                                                            <i class="fas fa-times mr-1.5"></i>
                                                            Tolak
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Details Modal -->
                                    <div id="details-{{ $item->id }}" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden z-50">
                                        <div class="flex items-center justify-center min-h-screen p-4">
                                            <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full overflow-hidden">
                                                <!-- Modal Header -->
                                                <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                                                    <h3 class="text-lg font-semibold text-gray-900">Detail Pendaftaran</h3>
                                                    <button onclick="hideDetails('{{ $item->id }}')" class="text-gray-400 hover:text-gray-500 transition-colors">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                                
                                                <!-- Modal Content -->
                                                <div class="p-6 space-y-6">
                                                    <div>
                                                        <h4 class="text-sm font-medium text-gray-500 mb-2">Alasan Mengikuti Kursus</h4>
                                                        <p class="text-gray-900 bg-gray-50 rounded-lg p-3">{{ $item->alasan }}</p>
                                                    </div>
                                                    
                                                    <div class="grid grid-cols-2 gap-6">
                                                        <div>
                                                            <h4 class="text-sm font-medium text-gray-500 mb-2">Metode Pembayaran</h4>
                                                            <div class="flex items-center text-gray-900">
                                                                <i class="fas fa-credit-card mr-2 text-indigo-500"></i>
                                                                {{ $item->payment_method }}
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h4 class="text-sm font-medium text-gray-500 mb-2">Status Pendaftaran</h4>
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
                                                    </div>

                                                    <div>
                                                        <h4 class="text-sm font-medium text-gray-500 mb-2">Deskripsi Kursus</h4>
                                                        <p class="text-gray-900 bg-gray-50 rounded-lg p-3">{{ $item->course->description }}</p>
                                                    </div>
                                                </div>

                                                <!-- Modal Footer -->
                                                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                                                    <button onclick="hideDetails('{{ $item->id }}')" 
                                                            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-500 transition-colors">
                                                        Tutup
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="h-24 w-24 text-gray-200 mb-4">
                                                    <i class="fas fa-inbox text-6xl"></i>
                                                </div>
                                                <p class="text-gray-500 text-lg font-medium">Belum ada pendaftaran</p>
                                                <p class="text-gray-400 text-sm mt-1">Pendaftaran baru akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>

<!-- Modal Scripts -->
<script>
function showDetails(id) {
    document.getElementById(`details-${id}`).classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function hideDetails(id) {
    document.getElementById(`details-${id}`).classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}
</script>
@endsection 