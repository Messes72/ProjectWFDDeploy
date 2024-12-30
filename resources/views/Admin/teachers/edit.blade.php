@extends('Admin.layout')

@section('content')

    <div class="flex w-full">
        {{-- Sidebar --}}
        @include('Admin.sidebar')

        {{-- Main Content --}}
        <div class="flex-grow bg-gray-100 pl-64">
            {{-- Notifikasi --}}
            @if(session('success'))
                <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div id="error-alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" class="bg-white shadow-md rounded p-6">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Teacher</label>
                        <input type="text" name="name" id="name" class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full" value="{{ old('name', $teacher->name) }}">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full" value="{{ old('email', $teacher->user->email) }}">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full" placeholder="Leave blank to keep current password">
                    </div>
                    <div class="form-group">
                        <label for="qualification" class="form-label">Qualification</label>
                        <textarea name="qualification" id="qualification" class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full" rows="4">{{ old('qualification', $teacher->qualification) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="experiences" class="form-label">Experiences</label>
                        <textarea name="experiences" id="experiences" class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full" rows="4">{{ old('experiences', $teacher->experiences) }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end mt-4 space-x-2">
                    <a href="{{ route('teachers.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">Kembali</a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
