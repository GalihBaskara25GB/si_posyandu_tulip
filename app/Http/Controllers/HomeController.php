<?php
  
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kader;
use App\Models\Kriteria;
  
class HomeController extends Controller
{
    public function index()
    {
        if(Auth::user()->isAdmin()) {
            $user = User::all()->count();
            $kader = Kader::all()->count();
            $kriteria = Kriteria::all()->count();
            return view('dashboard.admin', compact('user', 'kader', 'kriteria'));
        }
        return view('dashboard.user');
    }

    public function rangkingUser() {
        return view('rangking.user-rangking');
    }
}