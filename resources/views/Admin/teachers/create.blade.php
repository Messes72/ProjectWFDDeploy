@extends('Admin.layout')

@section('content')
    <div class="flex w-full"> <!-- Parent container -->
        @include('Admin.sidebar')

        <div class="flex-grow bg-gray-100 pl-64"> 
            <form action="{{ route('teachers.store') }}" method="POST" class="bg-white shadow-md rounded p-6">
                @csrf
                @method('POST')

                <div class="space-y-4">
                    <!-- Input Nama -->
                    <div class="form-group">
                        <label for="name" class="form-label text-gray-700 font-bold">Nama Teacher</label>
                        <input type="text" name="name" id="name"
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('name') is-invalid @enderror"
                            value="{{ old('name') }}">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input Email -->
                    <div class="form-group">
                        <label for="email" class="form-label text-gray-700 font-bold">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('email') is-invalid @enderror"
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input Password -->
                    <div class="form-group">
                        <label for="password" class="form-label text-gray-700 font-bold">Password</label>
                        <input type="password" name="password" id="password"
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('password') is-invalid @enderror">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input Qualification -->
                    <div class="form-group">
                        <label for="qualification" class="form-label text-gray-700 font-bold">Qualification</label>
                        <textarea name="qualification" id="qualification"
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('qualification') is-invalid @enderror"
                            rows="4">{{ old('qualification') }}</textarea>
                        @error('qualification')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input Experiences -->
                    <div class="form-group">
                        <label for="experiences" class="form-label text-gray-700 font-bold">Experiences</label>
                        <textarea name="experiences" id="experiences"
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('experiences') is-invalid @enderror"
                            rows="4">{{ old('experiences') }}</textarea>
                        @error('experiences')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end mt-4 space-x-2">
                    <a href="{{ route('teachers.index') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Kembali</a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
