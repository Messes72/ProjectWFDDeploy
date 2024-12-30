@extends('Admin.layout')

@section('content')
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white min-h-screen fixed">
            @include('Admin.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <div class="p-6">
                <!-- Header -->
                <div class="bg-white shadow-md rounded p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">User Management</h2>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="text-gray-700 font-bold mb-2">Total Users</div>
                        <div class="text-3xl font-bold text-blue-600">{{ $totalUsers }}</div>
                    </div>
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="text-gray-700 font-bold mb-2">Total Admins</div>
                        <div class="text-3xl font-bold text-green-600">{{ $totalAdmins }}</div>
                    </div>
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="text-gray-700 font-bold mb-2">Total Teachers</div>
                        <div class="text-3xl font-bold text-yellow-600">{{ $totalTeachers }}</div>
                    </div>
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="text-gray-700 font-bold mb-2">Total Students</div>
                        <div class="text-3xl font-bold text-purple-600">{{ $totalStudents }}</div>
                    </div>
                </div>

                <!-- Notifications -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Users Table -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Created At</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
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
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->created_at->format('d M Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('user-management.show', $user->id) }}" 
                                               class="text-blue-600 hover:text-blue-900">View</a>
                                            <button class="text-red-600 hover:text-red-900">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection