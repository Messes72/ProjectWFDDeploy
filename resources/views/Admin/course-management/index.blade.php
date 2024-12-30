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
                    <h2 class="text-2xl font-bold text-gray-800">Course Management</h2>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="text-gray-700 font-bold mb-2">Total Courses</div>
                        <div class="text-3xl font-bold text-blue-600">{{ $totalCourses }}</div>
                    </div>
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="text-gray-700 font-bold mb-2">Active Periods</div>
                        <div class="text-3xl font-bold text-green-600">{{ $totalActivePeriods }}</div>
                    </div>
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="text-gray-700 font-bold mb-2">Total Lessons</div>
                        <div class="text-3xl font-bold text-yellow-600">{{ $totalLessons }}</div>
                    </div>
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="text-gray-700 font-bold mb-2">Total Assignments</div>
                        <div class="text-3xl font-bold text-purple-600">{{ $totalAssignments }}</div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                    <form action="{{ route('course-management.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Course Name Filter -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Course Name</label>
                            <input type="text" 
                                   name="search" 
                                   id="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Search course name..."
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <!-- Period Filter -->
                        <div>
                            <label for="period" class="block text-sm font-medium text-gray-700 mb-1">Period</label>
                            <select name="period" id="period" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Periods</option>
                                @foreach($periods as $period)
                                    <option value="{{ $period->id }}" {{ request('period') == $period->id ? 'selected' : '' }}>
                                        {{ $period->year }} - {{ $period->semester }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Teacher Filter -->
                        <div>
                            <label for="teacher" class="block text-sm font-medium text-gray-700 mb-1">Teacher</label>
                            <select name="teacher" id="teacher" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Teachers</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ request('teacher') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="flex items-end space-x-2">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <i class="fas fa-filter mr-1.5"></i>
                                Filter
                            </button>
                            <a href="{{ route('course-management.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                <i class="fas fa-undo mr-1.5"></i>
                                Reset
                            </a>
                        </div>
                    </form>
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

                <!-- Courses Table -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Course Name</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Period</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Teacher</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($courses as $course)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $course->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            @if($course->period)
                                                {{ $course->period->year }} - {{ $course->period->semester }}
                                            @else
                                                No Period Assigned
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            @if($course->teacher)
                                                {{ $course->teacher->name }}
                                            @else
                                                No Teacher Assigned
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('course-management.show', $course->id) }}" 
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
