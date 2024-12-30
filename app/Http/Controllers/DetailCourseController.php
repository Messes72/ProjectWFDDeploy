<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;    
use Illuminate\Http\Request;

class DetailCourseController extends Controller
{
    public function matematika()
    {
        return view('User.matematika');
    }

    public function fisika()
    {
        return view('User.fisika');
    }

    public function kimia()
    {
        return view('User.kimia');
    }

    public function biologi()
    {
        return view('User.biologi');
    }
}
