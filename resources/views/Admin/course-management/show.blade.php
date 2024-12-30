@extends('Admin.layout')

@section('content')
<div class="flex w-full">
    {{-- Sidebar --}}
    @include('Admin.sidebar')

    {{-- Main Content --}}
    <div class="flex-grow bg-gray-100 p-6">
        {{-- Course Details --}}
        <div class="bg-white shadow-md rounded p-6">
            <h2 class="text-2xl font-bold mb-4">Course Details</h2>
            <div class="space-y-4">
                <div class="form-group">
                    <strong class="form-label">Course Name</strong>
                    <p class="form-control">{{ $course->name }}</p>
                </div>
                <div class="form-group">
                    <strong class="form-label">Description</strong>
                    <p class="form-control">{{ $course->description }}</p>
                </div>
                <div class="form-group">
                    <strong class="form-label">Period</strong>
                    <p class="form-control">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $course->period->year }} - {{ $course->period->semester }}
                            @if($course->period->active)
                                (Active)
                            @endif
                        </span>
                    </p>
                </div>
                <div class="form-group">
                    <strong class="form-label">Teacher</strong>
                    <p class="form-control">{{ $course->teacher->name }}</p>
                </div>

                {{-- Lessons Section --}}
                <div class="mt-6">
                    <h3 class="text-xl font-bold mb-2">Lessons</h3>
                    <div class="space-y-2">
                        @foreach($course->lessons as $lesson)
                            <div class="bg-gray-50 p-3 rounded">
                                <p class="font-semibold">{{ $lesson->title }}</p>
                                <p class="text-sm text-gray-600">{{ $lesson->date }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Assignments Section --}}
                <div class="mt-6">
                    <h3 class="text-xl font-bold mb-2">Assignments</h3>
                    <div class="space-y-2">
                        @foreach($course->assignments as $assignment)
                            <div class="bg-gray-50 p-3 rounded">
                                <p class="font-semibold">{{ $assignment->title }}</p>
                                <p class="text-sm text-gray-600">Due: {{ $assignment->due_date }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <strong class="form-label">Created At</strong>
                    <p class="form-control">{{ $course->created_at->format('F j, Y') }}</p>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end mt-6 space-x-4">
                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete Course</button>
                <a href="{{ route('course-management.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
