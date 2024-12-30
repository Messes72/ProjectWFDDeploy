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
            <div class="bg-white shadow-md rounded p-6 mb-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Course List</h1>
                <a href="/courses/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition duration-200">
                    <i class="fas fa-plus"></i>
                    <span>Add Course</span>
                </a>
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

            <!-- Filter Dropdown -->
            <div class="flex justify-end mb-6">
                <form action="{{ route('courses.index') }}" method="GET" class="flex items-center space-x-2">
                    <label for="filter" class="text-gray-700 font-bold">Tampilkan:</label>
                    <select name="filter" id="filter" onchange="this.form.submit()" class="border-2 border-gray-300 rounded-lg px-4 py-2">
                        <option value="active" {{ $filter == 'active' ? 'selected' : '' }}>Course Aktif</option>
                        <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>Semua Course</option>
                    </select>
                </form>
            </div>

            <!-- Courses Grid -->
            @if ($courses->isEmpty())
                <p class="text-center text-gray-600">Tidak ada kursus yang tersedia untuk periode aktif.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($courses as $course)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200 overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $course->name }}</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center text-gray-700">
                                        <span class="font-semibold mr-2">Description:</span>
                                        <span>{{ $course->description }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-700">
                                        <span class="font-semibold mr-2">Teacher:</span>
                                        <span>{{ $course->teacher ? $course->teacher->name : 'No Teacher Assigned' }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-700">
                                        <span class="font-semibold mr-2">Harga:</span>
                                        <span>Rp {{ number_format($course->price, 0, ',', '.') }},00</span>
                                    </div>
                                    <div class="flex items-center text-gray-700">
                                        <span class="font-semibold mr-2">Period:</span>
                                        <span>{{ $course->period ? $course->period->year . ' - Semester ' . $course->period->semester : 'No Period Assigned' }}</span>
                                    </div>
                                </div>
                                <div class="mt-6 flex space-x-3">
                                    <a href="/courses/{{ $course->id }}/edit" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-1 transition duration-200">
                                        <i class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </a>
                                    <button type="button" onclick="confirmDelete({{ $course->id }})" class="flex-1 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-1 transition duration-200">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                    <a href="{{ route('courses.details', ['id' => $course->id]) }}" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-1 transition duration-200">
                                        <i class="fas fa-info-circle"></i>
                                        <span>Details</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Delete Confirmation
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Are you sure you want to delete this course? This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Delete
                    </button>
                </form>
                <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/courses/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
@endsection
