@extends('Admin.layout')

@section('content')
<div class="flex h-screen w-full">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-900 text-white h-full">
        @include('Admin.sidebar')
    </div>

    <!-- Main Content -->
    <div class="flex-1 bg-gray-100 p-6 overflow-auto">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 border border-green-400 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Manage Periods</h1>
        </div>

        <!-- Form Create Period -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-lg font-bold mb-4">Create New Period</h2>
            <form action="{{ route('periods.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <input type="number" name="year" placeholder="Year" required
                           class="border-2 border-gray-300 rounded-lg px-4 py-2 w-full">
                    <input type="text" name="semester" placeholder="Semester" required
                           class="border-2 border-gray-300 rounded-lg px-4 py-2 w-full">
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Create Period
                    </button>
                </div>
            </form>
        </div>

        <!-- Periods Table -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold mb-4">Periods List</h2>
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Year</th>
                        <th class="border border-gray-300 px-4 py-2">Semester</th>
                        <th class="border border-gray-300 px-4 py-2">Active</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($periods as $period)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $period->id }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $period->year }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $period->semester }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                {{ $period->active ? 'Yes' : 'No' }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <!-- Set Active -->
                                <form action="{{ route('periods.setActive', $period->id) }}" method="POST" class="inline-block">
                                    @csrf @method('PUT')
                                    <button type="submit" 
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                        Set Active
                                    </button>
                                </form>

                                <!-- Delete -->
                                <form action="{{ route('periods.destroy', $period->id) }}" method="POST" class="inline-block ml-2">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
