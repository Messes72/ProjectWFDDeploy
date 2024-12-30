@extends('User.layoutregistlogin')

@section('content')
<div class="min-h-screen flex justify-center items-center bg-gray-100">
    <div class="bg-white p-8 rounded shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Admin Register</h2>

        @if (session('success'))
            <div class="text-green-500 text-center mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.register.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block">Email</label>
                <input type="email" name="email" class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="password" class="block">Password</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full px-3 py-2 border rounded">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Register</button>
        </form>
    </div>
</div>
@endsection
