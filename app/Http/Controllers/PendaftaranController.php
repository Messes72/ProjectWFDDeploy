<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    // Menampilkan form pendaftaran
    public function index($id)
    {
        $course = Course::findOrFail($id);
        return view('User.pendaftaran', ['course' => $course]);
    }

    // Validasi pembayaran yang dilakukan oleh pengguna
    public function validatePayment(Request $request)
    {
        // Validasi input metode pembayaran dan nomor
        $validated = $request->validate([
            'payment_method' => 'required|string',
            'card_number' => 'nullable|string|max:20',
            'ovo_gopay_number' => 'nullable|string|max:20',
            'course_id' => 'required|integer',
        ]);

        // Log the student ID
        $studentId = Auth::id();
        \Log::info('Student ID:', ['id' => $studentId]);

        // Simpan ke database sebagai validasi pembayaran
        $pendaftaran = Pendaftaran::updateOrCreate(
            [
                'student_id' => Auth::id(),
                'course_id' => $request->input('course_id'),
            ],
            [
                'payment_method' => $request->input('payment_method'),
                'card_number' => $request->input('card_number'),
                'ovo_gopay_number' => $request->input('ovo_gopay_number'),
                'is_validated' => true,
                'status' => Pendaftaran::STATUS_PENDING,
            ]
        );

        \Log::info('Pembayaran divalidasi:', $pendaftaran->toArray());

        return redirect()->route('pendaftaran.index', $pendaftaran->course_id)
                         ->with('success', 'Pembayaran berhasil divalidasi.');
    }

    // Menyimpan data pendaftaran
    public function store(Request $request)
    {
        \Log::info('Data yang diterima untuk pendaftaran:', $request->all());

        // Validasi input untuk data lengkap
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'school' => 'required|string',
            'alasan' => 'required|string|min:20',
            'course_id' => 'required|integer', 
            'payment_method' => 'required|string',
            'card_number' => 'nullable|string|max:20',
            'ovo_gopay_number' => 'nullable|string|max:20',
        ]);

        // Simpan data pendaftaran langsung
        $pendaftaran = Pendaftaran::create([
            'student_id' => Auth::id(),
            'course_id' => $request->input('course_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'school' => $request->input('school'),
            'alasan' => $request->input('alasan'),
            'payment_method' => $request->input('payment_method'),
            'card_number'=> $request->input('card_number'),
            'ovo_gopay_number' => $request->input('ovo_gopay_number'),
            'status' => Pendaftaran::STATUS_PENDING,
        ]);

        \Log::info('Pendaftaran berhasil disimpan:', $pendaftaran->toArray());

        return redirect()->route('dashboard')->with('success', 'Pendaftaran berhasil! Status pendaftaran Anda dalam proses review.');
    }

    // Menampilkan halaman riwayat pendaftaran
    public function showRegistrationHistory()
    {
        $studentId = Auth::id();
        $pendaftaranHistory = Pendaftaran::where('student_id', $studentId)->get();

        return view('User.history', ['pendaftaran' => $pendaftaranHistory]);
    }

    // Menampilkan formulir pendaftaran kursus
    public function showRegistrationForm($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->route('dashboard')->with('error', 'Kursus tidak ditemukan');
        }
        return view('User.pendaftaran', compact('course'));
    }

    // Update status pendaftaran (untuk admin)
    public function updateStatus(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', [
                Pendaftaran::STATUS_PENDING,
                Pendaftaran::STATUS_FAILED,
                Pendaftaran::STATUS_ACCEPTED
            ])
        ]);

        $pendaftaran->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    // Menampilkan daftar pendaftaran untuk admin
    public function adminIndex()
    {
        // Cek apakah user adalah admin
        if (Auth::user()->role != 1) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        // Ambil semua pendaftaran dengan relasi course dan student
        $pendaftaran = Pendaftaran::with(['course', 'student'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Admin.pendaftaran.index', ['pendaftaran' => $pendaftaran]);
    }
}