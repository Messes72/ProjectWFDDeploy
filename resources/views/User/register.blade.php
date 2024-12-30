@extends('User.layoutregistlogin')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-blue-400 to-purple-400 w-full">
        <div class="w-full max-w-xl bg-white p-8 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
            <h2 class="text-2xl font-bold text-center mb-6">Register</h2>

            <!-- Pesan Error -->
            @if (session('error'))
                <div id="alert-error" class="mb-4 text-red-500 text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('user.register') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2">
                    <div class="mb-4 mr-4">
                        <label for="name" class="block text-gray-700">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            placeholder="Enter your name" required
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4 ml-3">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Enter your email" required
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2">
                    <div class="mb-4 mr-4">
                        <label for="age" class="block text-gray-700">Age</label>
                        <input type="number" id="age" name="age" value="{{ old('age') }}"
                            placeholder="Enter your age" required
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('age')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4 ml-3">
                        <label for="phone" class="block text-gray-700">Phone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                            placeholder="Enter your phone number" required
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('phone')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-gray-700">Address</label>
                    <textarea id="address" name="address" placeholder="Enter your address" required
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('address') }}</textarea>
                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="school" class="block text-gray-700">School</label>
                    <input type="text" id="school" name="school" value="{{ old('school') }}"
                        placeholder="Enter your school" required
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('school')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="grid grid-cols-2">
                    <div class="mb-6 relative mr-4">
                        <label for="password" class="block text-gray-700">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Enter your password" required
                                class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-6 ml-3">
                        <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Confirm your password" required
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">Register</button>
            </form>
            <p class="text-center text-sm text-gray-600 mt-4">
                Already have an account? <a href="{{ route('user.login') }}" class="text-blue-500 hover:underline">Login
                    here</a>
            </p>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm-password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                confirmPasswordInput.type = 'text';
                // Change icon to eye open
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825a8.962 8.962 0 01-1.875.175c-4.478 0-8.268-2.943-9.542-7 .826-2.07 2.142-3.834 3.854-5.028m5.647-2.747c.305.057.61.128.912.21M12 9c.65 0 1.287.121 1.875.338m3.108 3.108c.49.49.895 1.058 1.217 1.672m-.425 5.66A9.963 9.963 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.962 9.962 0 013.854-5.028m5.648-2.747C11.528 3.508 10.792 3 10 3m-1.215.838A9.96 9.96 0 0112 5c4.477 0 8.268 2.943 9.542 7-.864 2.143-2.274 3.902-4.038 5.007M9.25 14.75c.544.544 1.179.983 1.875 1.245m1.625-.995c.28-.137.54-.298.775-.482" />
                `;
            } else {
                passwordInput.type = 'password';
                confirmPasswordInput.type = 'password';
                // Change icon back to eye closed
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.864 2.143-2.274 3.902-4.038 5.007m-4.265 1.69A9.956 9.956 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.953 9.953 0 013.598-4.296" />
                `;
            }
        }
    </script>
@endsection
