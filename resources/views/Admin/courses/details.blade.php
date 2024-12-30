@extends('Admin.layout')

@section('content')

    <div class="flex w-full">
        {{-- Sidebar --}}
        @include('Admin.sidebar')

        {{-- Main Content --}}
        <div class="flex-grow bg-gray-100 pl-64">
            {{-- Course Details --}}
            <div class="bg-white shadow-md rounded p-6">
                <h2 class="text-2xl font-bold mb-4">Course Details</h2>
                <div class="space-y-4">
                    <div class="form-group">
                        <strong for="name" class="form-label">Course Name</strong>
                        <p class="form-control">{{ $course->name }}</p>
                    </div>
                    <div class="form-group">
                        <strong for="description" class="form-label">Description</strong>
                        <p class="form-control">{{ $course->description }}</p>
                    </div>
                    <div class="form-group">
                        <strong for="teacher" class="form-label">Teacher</strong>
                        <p class="form-control">{{ $course->teacher ? $course->teacher->name : 'No Teacher Assigned' }}</p>
                    </div>                                        
                    <div class="form-group">
                        <strong for="price" class="form-label">Price</strong>
                        <p class="form-control">{{ number_format($course->price, 2) }} IDR</p>
                    </div>
                    <div class="form-group">
                        <strong for="description" class="form-label">Period</strong>
                        <p class="form-control">{{ $course->period ? $course->period->year . ' - Semester ' . $course->period->semester : 'No Period Assigned' }}</p>
                    </div>
                    <div class="form-group">
                        <strong for="created_at" class="form-label">Created At</strong>
                        <p class="form-control">{{ $course->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="form-group">
                        <strong for="updated_at" class="form-label">Last Updated</strong>
                        <p class="form-control">{{ $course->updated_at->format('d M Y') }}</p>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end mt-6 space-x-4">
                        <a href="{{ route('lessons.create', ['id' => $course->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Lesson</a>
                        <a href="{{ route('assignments.create', ['id' => $course->id]) }}" class="bg-green-500 text-white px-4 py-2 rounded">Add Assignment</a>
                        <a href="{{ route('courses.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
