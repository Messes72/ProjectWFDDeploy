@extends('User.layout')

@section('content')
@include('User.navbar')
<div class="container mx-auto p-6" style="margin-top: 80px;">
    <h2 class="text-center mb-6">Submit Assignment: {{ $assignment->title }}</h2>
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <form action="{{ route('assignments.submit.store', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <input type="hidden" name="student_id" value="{{ auth()->id() }}">
            <input type="hidden" name="course_id" value="{{ $assignment->course_id }}">
            <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
            <div class="mb-4">
                <label for="pdf" class="block text-gray-700 text-sm font-bold mb-2">Upload PDF</label>
                <input type="file" class="form-control border rounded w-full py-2 px-3 text-gray-700" id="pdf" name="pdf" required>
            </div>
            <button type="submit" class="btn btn-primary w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
        </form>
    </div>
</div>
@endsection