@extends('User.layout')

@section('content')
    @include('User.navbar')

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Pendaftaran Kursus {{ $course->name }}</h1>

        <form action="{{ route('pendaftaran.store') }}" method="POST">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Formulir Pendaftaran -->
                <div class="md:col-span-1">
                    <div class="bg-white p-8 rounded-lg shadow-lg shadow-gray-500/70 transition-transform transform hover:scale-105">
                        <h2 class="text-2xl font-semibold mb-5">Formulir Pendaftaran</h2>
                        <hr class="border-t-2 border-gray-300 mb-5">

                        <!-- Input Fields -->
                        <div class="mb-5">
                            <label class="block text-gray-800">Nama Lengkap</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 block w-full border-gray-400 rounded-md shadow-sm focus:ring focus:ring-blue-300"
                                placeholder="Masukkan nama Anda" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-5">
                            <label class="block text-gray-800">Email</label>
                            <input type="email" name="email" id="email"
                                class="mt-1 block w-full border-gray-400 rounded-md shadow-sm focus:ring focus:ring-blue-300"
                                placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-5">
                            <label class="block text-gray-800">Nomor Telepon</label>
                            <input type="text" name="phone" id="phone"
                                class="mt-1 block w-full border-gray-400 rounded-md shadow-sm focus:ring focus:ring-blue-300"
                                placeholder="Masukkan nomor telepon Anda" value="{{ old('phone') }}" required>
                        </div>
                        <div class="mb-5">
                            <label class="block text-gray-800">Asal Sekolah</label>
                            <textarea name="school" id="school"
                                class="mt-1 block w-full border-gray-400 rounded-md shadow-sm focus:ring focus:ring-blue-300"
                                placeholder="Masukkan asal sekolah Anda" required>{{ old('school') }}</textarea>
                        </div>
                        <div class="mb-5">
                            <label class="block text-gray-800">Alasan Mengikuti Kursus</label>
                            <textarea name="alasan" id="alasan"
                                class="mt-1 block w-full border-gray-400 rounded-md shadow-sm focus:ring focus:ring-blue-300"
                                placeholder="Masukkan setidaknya 20 kata" required>{{ old('alasan') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi Kursus -->
                <div class="md:col-span-2 space-y-8">
                    <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                        <h2 class="text-2xl font-semibold mb-4">Deskripsi Kursus</h2>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $course->description }}
                        </p>
                    </div>

                    <!-- Card Metode Pembayaran -->
                    <div class="bg-white p-8 rounded-lg shadow-lg shadow-gray-500/70">
                        <h2 class="text-2xl font-semibold mb-5">Metode Pembayaran</h2>
                        <hr class="border-t-2 border-gray-300 mb-5">

                        <div class="mb-5">
                            <label class="block text-gray-800 mb-2">Pilih Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method"
                                class="w-full border-gray-400 rounded-md shadow-sm focus:ring focus:ring-blue-300" onchange="togglePaymentFields()">
                                <option value="">-- Pilih Metode Pembayaran --</option>
                                <option value="kartu_kredit">Kartu Kredit</option>
                                <option value="ovo">OVO</option>
                                <option value="gopay">GoPay</option>
                            </select>
                        </div>

                        <div id="card_fields" class="hidden">
                            <div class="mb-5">
                                <label class="block text-gray-800">Nomor Kartu</label>
                                <input type="text" name="card_number" id="card_number"
                                    class="w-full border-gray-400 rounded-md shadow-sm" placeholder="Masukkan nomor kartu" value="{{ old('card_number') }}">
                            </div>
                        </div>

                        <div id="ovo_fields" class="hidden">
                            <div class="mb-5">
                                <label class="block text-gray-800">Nomor OVO</label>
                                <input type="text" name="ovo_gopay_number" id="ovo_number"
                                    class="w-full border-gray-400 rounded-md shadow-sm" placeholder="Masukkan nomor OVO" value="{{ old('ovo_gopay_number') }}">
                            </div>
                        </div>

                        <div id="gopay_fields" class="hidden">
                            <div class="mb-5">
                                <label class="block text-gray-800">Nomor GoPay</label>
                                <input type="text" name="ovo_gopay_number" id="gopay_number"
                                    class="w-full border-gray-400 rounded-md shadow-sm" placeholder="Masukkan nomor GoPay" value="{{ old('ovo_gopay_number') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit di luar card -->
            <button type="submit" id="submit_pendaftaran"
                class="w-full bg-blue-600 text-white font-bold py-3 rounded hover:bg-blue-700 transition-colors mt-6">
                Daftar Sekarang
            </button>
        </form>
    </div>

    <script>
        function togglePaymentFields() {
            const paymentMethod = document.getElementById('payment_method').value;
            document.getElementById('card_fields').classList.add('hidden');
            document.getElementById('ovo_fields').classList.add('hidden');
            document.getElementById('gopay_fields').classList.add('hidden');

            if (paymentMethod === 'kartu_kredit') {
                document.getElementById('card_fields').classList.remove('hidden');
            } else if (paymentMethod === 'ovo') {
                document.getElementById('ovo_fields').classList.remove('hidden');
            } else if (paymentMethod === 'gopay') {
                document.getElementById('gopay_fields').classList.remove('hidden');
            }
        }
    </script>
@endsection
