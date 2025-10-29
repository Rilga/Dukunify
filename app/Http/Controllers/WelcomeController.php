<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dukun; 

class WelcomeController extends Controller
{
    public function index()
    {
        $dukuns = Dukun::with('categories')
                       ->latest() 
                       ->take(6)   
                       ->get(); 


        return view('welcome', compact('dukuns'));
    }
}