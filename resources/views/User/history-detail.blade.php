@extends('User.layout')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <div class="fixed inset-y-0 left-0 w-64 z-30">
        @include('User.navbar')
    </div>
    <div class="flex-1">
        <main class="p-6 pt-24">
            <div class="max-w-4xl mx-auto mt-35">
                <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                    <h2 class="text-2xl font-semibold text-black-600 mb-2">{{ $pendaftaran->course->name }}</h2>
                    <p class="text-gray-700 mb-4">{{ $pendaftaran->course->description }}</p>
                </div>

                <!-- Grid untuk Menampilkan Semua Lesson -->
                <h3 class="text-lg font-semibold text-gray-900 mt-6 mb-4">Lessons</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($lessons as $lesson)
                        <div class="bg-white border border-gray-300 rounded-lg shadow-lg p-4 hover:shadow-xl transition-shadow duration-200">
                            <h4 class="text-lg font-bold mb-2">{{ $lesson->title }}</h4>
                            <p class="text-gray-600 mb-2">
                                <strong>Content:</strong>
                                <span class="font-normal">{{ $lesson->content }}</span>
                            </p>
                            <p class="text-gray-600 mb-2">
                                <strong>Date:</strong>
                                <span class="font-normal">{{ \Carbon\Carbon::parse($lesson->date)->format('d M Y') }}</span>
                            </p>
                            @if($lesson->image)
                                <img src="{{ Storage::url($lesson->image) }}" alt="Lesson Image" class="w-full h-32 object-cover rounded mb-2">
                            @endif
                            @if($lesson->pdf)
                                <a href="{{ Storage::url($lesson->pdf) }}" class="text-blue-500">Download PDF</a>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-600">Belum ada lesson yang tersedia.</p>
                    @endforelse
                </div>

                <!-- Grid untuk Menampilkan Semua Assignment -->
                <h3 class="text-lg font-semibold text-gray-900 mt-6 mb-4">Assignments</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($assignments as $assignment)
                        <div class="bg-white border border-gray-300 rounded-lg shadow-lg p-4 hover:shadow-xl transition-shadow duration-200">
                            <h4 class="text-lg font-bold mb-2">{{ $assignment->title }}</h4>
                            <p class="text-gray-600 mb-2">
                                <strong>Course:</strong>
                                <span class="font-normal">{{ $assignment->course->name ?? 'N/A' }}</span>
                            </p>
                            <p class="text-gray-600 mb-2">
                                <strong>Description:</strong>
                                <span class="font-normal">{{ $assignment->description }}</span>
                            </p>
                            <p class="text-gray-600 mb-2">
                                <strong>Due Date:</strong>
                                <span class="font-normal">{{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y H:i') }}</span>
                            </p>
                            <div class="mt-4">
                                <a href="{{ route('assignments.submit', $assignment->id) }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
                                    Submit
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">Belum ada tugas yang tersedia.</p>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
