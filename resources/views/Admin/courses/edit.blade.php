@extends('Admin.layout')

@section('content')
    <div class="flex w-full">
        @include('Admin.sidebar')

        <div class="flex-grow bg-gray-100 pl-64">
            <form action="/courses/{{ $course->id }}" method="POST" class="bg-white shadow-md rounded p-6">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <!-- Input Nama Course -->
                    <div class="form-group">
                        <label for="name" class="form-label font-bold text-gray-700">Nama Course</label>
                        <input type="text" name="name" id="name"
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-blue-500 @error('name') is-invalid @enderror"
                            value="{{ old('name', $course->name) }}">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input Deskripsi -->
                    <div class="form-group">
                        <label for="description" class="form-label font-bold text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description"
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-blue-500 @error('description') is-invalid @enderror"
                            rows="4">{{ old('description', $course->description) }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input Teacher -->
                    <div class="form-group">
                        <label for="teacher_id" class="form-label font-bold text-gray-700">Teacher</label>
                        <select name="teacher_id" id="teacher_id"
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('teacher_id') is-invalid @enderror">
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ $course->teacher_id == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Input Harga -->
                    <div class="form-group">
                        <label for="price" class="form-label font-bold text-gray-700">Harga</label>
                        <input type="text" name="price" id="price"
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-blue-500 @error('price') is-invalid @enderror"
                            value="{{ old('price', $course->price) }}">
                        @error('price')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="period_id" class="form-label">Periode</label>
                    <select name="period_id" id="period_id"
                        class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('period_id') is-invalid @enderror">
                        @foreach ($periods as $period)
                            <option value="{{ $period->id }}" {{ $course->period_id == $period->id ? 'selected' : '' }}>
                                {{ $period->year }} - {{ $period->semester }} {{ $period->active ? '(Aktif)' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('period_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>



                <!-- Tombol Simpan dan Kembali -->
                <div class="flex justify-end mt-4 space-x-2">
                    <a href="/courses"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200">Kembali</a>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
