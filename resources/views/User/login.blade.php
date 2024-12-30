@extends('User.layoutregistlogin')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-blue-400 to-purple-400 w-full">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
            <!-- Header -->
            <div class="flex justify-center mb-6">
                <img src="https://img.icons8.com/clouds/100/000000/login-rounded-right.png" alt="Login Icon" class="w-20 h-20">
            </div>
            <h2 class="text-3xl font-extrabold text-center mb-4 text-gray-800">Selamat Datang di Pendaftaran Kursus!</h2>
            <p class="text-center text-gray-600 mb-6">Log in to your account</p>

            <!-- Pesan Sukses -->
            @if(session('success'))
                <div id="alert-success" class="mb-4 text-green-500 text-center font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Pesan Error -->
            @if(session('error'))
                <div id="alert-error" class="mb-4 text-red-500 text-center font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form Login -->
            <form action="{{ route('user.login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-medium">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300 shadow-md">
                    Login
                </button>
            </form>

            <!-- Link to Register -->
            <p class="text-center text-sm text-gray-600 mt-6">
                Don't have an account? 
                <a href="{{ route('user.register') }}" class="text-blue-500 hover:underline font-medium">Register here</a>
            </p>
        </div>
    </div>

    <!-- Alert Auto-Hide Script -->
    <script>
        window.onload = function() {
            const successAlert = document.getElementById('alert-success');
            const errorAlert = document.getElementById('alert-error');
            if (successAlert) {
                setTimeout(() => successAlert.style.display = 'none', 5000); 
            }
            if (errorAlert) {
                setTimeout(() => errorAlert.style.display = 'none', 5000); 
            }
        };
    </script>
@endsection
