<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class PerawatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        return view('home', compact('user'));
    }

    public function input(){
        $user   = Auth::user();
        $users  = User::all(); // menarik semua (all) data dari models 
        return view('perawat.input_pasien', compact('user','users'));
    }

}
