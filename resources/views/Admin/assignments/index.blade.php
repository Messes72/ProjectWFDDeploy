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
        <h2 class="text-2xl font-bold text-gray-800">Assignments List</h2>
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

      <!-- Assignments Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($assignments as $assignment)
          <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200 overflow-hidden">
            <div class="p-6">
              <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $assignment->title }}</h3>
              <div class="space-y-3">
                <div class="flex items-center text-gray-700">
                  <span class="font-semibold mr-2">Course:</span>
                  <span>{{ $assignment->course->name ?? 'N/A' }}</span>
                </div>
                <div class="flex items-center text-gray-700">
                  <span class="font-semibold mr-2">Description:</span>
                  <span>{{ $assignment->description }}</span>
                </div>
                <div class="flex items-center text-gray-700">
                  <span class="font-semibold mr-2">Due Date:</span>
                  <span>{{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y H:i') }}</span>
                </div>
              </div>
              <div class="mt-6 flex space-x-3">
                <a href="{{ route('assignments.edit', $assignment->id) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-1 transition duration-200">
                  <i class="fas fa-edit"></i>
                  <span>Edit</span>
                </a>
                <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" class="inline w-full">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="flex-1 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-1 transition duration-200">
                    <i class="fas fa-trash"></i>
                    <span>Delete</span>
                  </button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
