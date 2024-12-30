@extends('Admin.layout')

@section('content')
@include('Admin.sidebar')
<div class="max-w-4xl mx-auto mt-10 w-full">
    <div class="bg-white border border-gray-300 shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-6">Create Assignment for {{ $course->name }}</h2>
        <form method="POST" action="{{ route('assignments.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <!-- Assignment Title -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Assignment Title</label>
                <input type="text" name="title" id="title" placeholder="Enter Title"
                       class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('title') is-invalid @enderror" required>
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea name="description" id="description" rows="4" placeholder="Enter Description"
                          class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('description') is-invalid @enderror"></textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Deadline -->
            <div class="mb-4">
                <label for="due_date" class="block text-gray-700 font-medium mb-2">Due Date</label>
                <input type="datetime-local" name="due_date" id="due_date"
                       class="form-control border-2 border-gray-300 rounded-lg px-4 py-3 w-full @error('due_date') is-invalid @enderror" required>
                @error('due_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('teachers.details', ['id' => $teacher->id]) }}"
                   class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-gray-600 transition">Cancel</a>
                   <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
