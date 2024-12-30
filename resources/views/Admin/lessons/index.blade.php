@extends('Admin.layout')

@section('content')
@include('Admin.sidebar')

<div class="container mx-auto mt-10 pl-64 ml-4">
    <h1 class="text-2xl font-bold mb-6">Lesson List</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($lessons as $lesson)
            <div class="bg-white border border-gray-300 rounded-lg p-4 shadow">
                <h2 class="text-xl font-semibold">{{ $lesson->course->name }}</h2>
                <h2 class="text-xl font-semibold">{{ $lesson->title }}</h2>
                <p>{{ $lesson->content }}</p>
                <p class="text-gray-500">{{ $lesson->date }}</p>
                <div class="mt-2">
                    @if($lesson->image)
                        <img src="{{ asset('storage/' . $lesson->image) }}" alt="Lesson Image" class="w-full h-32 object-cover rounded">
                    @endif
                </div>
                <div class="mt-2">
                    @if($lesson->pdf)
                        <a href="{{ asset('storage/' . $lesson->pdf) }}" class="text-blue-500">Download PDF</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
