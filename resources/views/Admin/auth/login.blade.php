@extends('User.layoutregistlogin')

@section('content')
<div class="min-h-screen flex justify-center items-center bg-gray-100">
    <div class="bg-white p-8 rounded shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>

        @if (session('error'))
            <div class="text-red-500 text-center mb-4">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block">Email</label>
                <input type="email" name="email" class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="password" class="block">Password</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Login</button>
        </form>
        <div class="text-center mt-4">
            <p>Belum punya akun? 
                <a href="{{ route('admin.register') }}" class="text-blue-500 hover:underline">Registrasi di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection
