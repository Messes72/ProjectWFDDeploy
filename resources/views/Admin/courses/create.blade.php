@extends('Admin.layout')

@section('content')
    <div class="flex w-full">
        @include('Admin.sidebar')
        <div class="flex-grow bg-gray-100 pl-64">

            {{-- Session Success dan Error --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            
            {{-- Form Tambah Course --}}
            <form action="/courses/store" method="POST" class="bg-white shadow-md rounded p-6">
                @csrf
                @method('POST')
                <div class="space-y-6">
                    <!-- Nama Course -->
                    <div class="form-group">
                        <label for="name" class="form-label text-gray-700 font-bold">Nama Course</label>
                        <input type="text" name="name" id="name"
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500 @error('name') is-invalid @enderror" 
                            value="{{ old('name') }}">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label for="description" class="form-label text-gray-700 font-bold">Deskripsi</label>
                        <textarea name="description" id="description" 
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500 @error('description') is-invalid @enderror" 
                            rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="price" class="form-label text-gray-700 font-bold">Harga</label>
                        <textarea name="price" id="price" 
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500 @error('price') is-invalid @enderror" 
                            rows="4">{{ old('price') }}</textarea>
                        @error('price')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Teacher Dropdown -->
                    <div class="form-group">
                        <label for="teacher_id" class="form-label text-gray-700 font-bold">Teacher</label>
                        <div class="relative">
                            <select name="teacher_id" id="teacher_id" required
                                class="appearance-none w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500 text-gray-700">
                                <option value="" disabled selected>Choose Teacher</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                            <!-- Custom Arrow Icon -->
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        @error('teacher_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="period_id" class="form-label text-gray-700 font-bold">Periode</label>
                        <select name="period_id" id="period_id" 
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('period_id') is-invalid @enderror">
                            <option value="">Pilih Periode</option>
                            @foreach($periods as $period)
                                <option value="{{ $period->id }}">
                                    {{ $period->year }} - {{ $period->semester }} {{ $period->active ? '(Aktif)' : '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('period_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end mt-6 space-x-4">
                    <a href="/courses" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200">Kembali</a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
