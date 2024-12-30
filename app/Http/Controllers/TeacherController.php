<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    // Tampilkan daftar semua teacher
    public function index()
    {
        $teachers = Teacher::all();
        return view('Admin.teachers.index', compact('teachers'));
    }

    // Tampilkan form untuk membuat teacher baru
    public function create()
    {
        return view('Admin.teachers.create');
    }

    // Simpan data teacher baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'qualification' => 'required',
            'experiences' => 'required|max:65535',
        ]);

        try {
            // Buat User baru
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 2, // Role 2 untuk teacher
            ]);

            // Buat Teacher baru
            Teacher::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'qualification' => $request->qualification,
                'experiences' => $request->experiences,
            ]);

            return redirect()->route('teachers.index')->with('success', 'Teacher berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('teachers.index')->with('error', 'Gagal menambahkan teacher. Silakan coba lagi.');
        }
    }

    // Tampilkan form untuk mengedit teacher
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id); // Validasi jika ID tidak ditemukan
        return view('Admin.teachers.edit', compact('teacher'));
    }

    // Update data teacher yang sudah ada
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id); // Validasi jika ID tidak ditemukan

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $teacher->user_id, // Validasi email unik kecuali milik sendiri
            'qualification' => 'required',
            'experiences' => 'required|string|max:10000',
        ]);

        // Update data User
        $teacher->user->update([
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $teacher->user->password, // Jika password kosong, tetap gunakan yang lama
        ]);

        // Update data Teacher
        $teacher->update([
            'name' => $request->name,
            'qualification' => $request->qualification,
            'experiences' => $request->experiences,
        ]);

        return redirect('/teachers')->with('success', 'Teacher berhasil diperbarui!');
    }

    // Hapus data teacher dan user terkait
    public function delete($id) {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return redirect()->back()->with('error', 'Guru tidak ditemukan.');
        }

        try {
            $teacher->delete();
            return redirect()->route('teachers.index')->with('success', 'Guru berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus guru: ' . $e->getMessage());
        }
    }

    public function details($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('Admin.teachers.details', compact('teacher'));  // Ensure the path is 'teachers.details'
    }

    public function lessons($id) {
        $teacher = Teacher::findOrFail($id);
        $lessons = $teacher->lessons; // Mengambil semua lessons yang terkait dengan teacher ini

        return view('Admin.teachers.lessons.index', compact('teacher', 'lessons'));
    }

}
