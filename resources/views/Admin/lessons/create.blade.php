@extends('Admin.layout')

@section('content')
    <div class="flex w-full">
        @include('Admin.sidebar')

        <div class="flex-grow bg-gray-100 p-6">
            <div class="max-w-4xl mx-auto mt-10 w-full">
                <h2 class="text-2xl font-semibold mb-6">Create Lesson for {{ $course->name }}</h2>
                <form action="{{ route('lessons.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    
                    <!-- Lesson Title -->
                    <div class="form-group">
                        <label for="title" class="form-label">Lesson Title</label>
                        <input type="text" name="title" id="title"
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" required>
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Lesson Content -->
                    <div class="form-group">
                        <label for="content" class="form-label">Lesson Content</label>
                        <textarea name="content" id="content" rows="4"
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('content') is-invalid @enderror"
                            placeholder="Enter lesson content" required>{{ old('content') }}</textarea>
                        @error('content')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Lesson Date -->
                    <div class="form-group">
                        <label for="date" class="form-label">Lesson Date</label>
                        <input type="date" name="date" id="date"
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('date') is-invalid @enderror"
                            value="{{ old('date') }}" required>
                        @error('date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Lesson Image -->
                    <div class="form-group">
                        <label for="image" class="form-label">Lesson Image</label>
                        <input type="file" name="image" id="image"
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('image') is-invalid @enderror"
                            accept="image/*">
                        @error('image')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Lesson PDF -->
                    <div class="form-group">
                        <label for="pdf" class="form-label">Lesson PDF</label>
                        <input type="file" name="pdf" id="pdf"
                            class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('pdf') is-invalid @enderror"
                            accept=".pdf">
                        @error('pdf')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end mt-4 space-x-2">
                        <a href="{{ route('teachers.details', ['id' => $teacher->id]) }}" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</a>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
