<?php

namespace App\Http\Controllers;

use App\Models\Obat;
class HomeController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isMember');
    }

    public function index()
    {
        $data =
            [
                'title' => 'Home',
            ];

        $obats = Obat::paginate(6);
        
        return view('home', compact('obats'), $data);
    }
}
