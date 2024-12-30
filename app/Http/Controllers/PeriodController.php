<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    // Menampilkan semua periode
    public function index()
    {
        $periods = Period::all();
        return view('admin.periods.index', compact('periods'));
    }

    // Menambahkan periode baru
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer',
            'semester' => 'required|string',
        ]);

        Period::create($request->all());
        return back()->with('success', 'Period created successfully');
    }

    // Menetapkan periode aktif
    public function setActive($id)
    {
        Period::where('active', true)->update(['active' => false]); // Reset semua aktif
        Period::find($id)->update(['active' => true]); // Set periode ini aktif

        return back()->with('success', 'Active period updated successfully');
    }

    // Menghapus periode
    public function destroy($id)
    {
        Period::destroy($id);
        return back()->with('success', 'Period deleted successfully');
    }
}

