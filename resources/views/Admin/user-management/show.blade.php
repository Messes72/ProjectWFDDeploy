@extends('Admin.layout')

@section('content')
<div class="flex w-full">
    {{-- Sidebar --}}
    @include('Admin.sidebar')

    {{-- Main Content --}}
    <div class="flex-grow bg-gray-100 p-6">
        {{-- User Details --}}
        <div class="bg-white shadow-md rounded p-6">
            <h2 class="text-2xl font-bold mb-4">User Details</h2>
            <div class="space-y-4">
                <div class="form-group">
                    <strong class="form-label">Email</strong>
                    <p class="form-control">{{ $user->email }}</p>
                </div>
                <div class="form-group">
                    <strong class="form-label">Role</strong>
                    <p class="form-control">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($user->role == 1) bg-green-100 text-green-800
                                @elseif($user->role == 2) bg-yellow-100 text-yellow-800
                                    @else bg-purple-100 text-purple-800
                                @endif">
                            @if($user->role == 1) Admin
                            @elseif($user->role == 2) Teacher
                                @else Student
                            @endif
                        </span>
                    </p>
                </div>
                @if($user->role == 2 && $user->teacher)
                    <div class="form-group">
                        <strong class="form-label">Name</strong>
                        <p class="form-control">{{ $user->teacher->name }}</p>
                    </div>
                    <div class="form-group">
                        <strong class="form-label">Qualification</strong>
                        <p class="form-control">{{ $user->teacher->qualification }}</p>
                    </div>
                    <div class="form-group">
                        <strong class="form-label">Experiences</strong>
                           <p class="form-control">{{ $user->teacher->experiences }}</p>
                    </div>
                @endif
                @if($user->role == 3 && $user->student)
                    <div class="form-group">
                        <strong class="form-label">Name</strong>
                        <p class="form-control">{{ $user->student->name }}</p>
                    </div>
                    <div class="form-group">
                        <strong class="form-label">Age</strong>
                        <p class="form-control">{{ $user->student->age }}</p>
                    </div>
                    <div class="form-group">
                        <strong class="form-label">Phone</strong>
                        <p class="form-control">{{ $user->student->phone }}</p>
                    </div>
                    <div class="form-group">
                        <strong class="form-label">Address</strong>
                        <p class="form-control">{{ $user->student->address }}</p>
                    </div>
                    <div class="form-group">
                        <strong class="form-label">School</strong>
                        <p class="form-control">{{ $user->student->school }}</p>
                    </div>
                @endif
                <div class="form-group">
                    <strong class="form-label">Member Since</strong>
                    <p class="form-control">{{ $user->created_at->format('F j, Y') }}</p>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end mt-6 space-x-4">
                @if($user->id !== auth()->id())
                    <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete User</button>
                @endif
                <a href="{{ route('user-management.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection