@extends('Admin.layout')

@section('content')

    <div class="flex w-full">
        {{-- Sidebar --}}
        @include('Admin.sidebar')

        {{-- Main Content --}}
        <div class="flex-grow bg-gray-100 pl-64">
            {{-- Teacher Details --}}
            <div class="bg-white shadow-md rounded p-6">
                <h2 class="text-2xl font-bold mb-4">Teacher Details</h2>
                <div class="space-y-4">
                    <div class="form-group">
                        <strong for="name" class="form-label">Name</strong>
                        <p class="form-control">{{ $teacher->name }}</p>
                    </div>
                    <div class="form-group">
                        <strong for="email" class="form-label">Email</strong>
                        <p class="form-control">{{ $teacher->user->email }}</p>
                    </div>
                    <div class="form-group">
                        <strong for="qualification" class="form-label">Qualification</strong>
                        <p class="form-control">{{ $teacher->qualification }}</p>
                    </div>
                    <div class="form-group">
                        <strong for="experiences" class="form-label">Experiences</strong>
                        <p class="form-control">{{ $teacher->experiences }}</p>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end mt-6 space-x-4">
                    {{-- <a href="{{ route('lessons.create', ['id' => $teacher->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Lesson</a>
                    <a href="{{ route('assignments.create', ['id' => $teacher->id]) }}" class="bg-green-500 text-white px-4 py-2 rounded">
                        Add Assignment
                    </a> --}}
                    <a href="{{ route('teachers.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">Kembali</a>
                </div>
            </div>
        </div>
    </div>

@endsection
