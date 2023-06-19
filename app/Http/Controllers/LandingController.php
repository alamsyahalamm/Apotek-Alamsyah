<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Apotek Sehati Jaya - Home'
        ];
        return view('landing', $data);
    }
}
