<?php
namespace App\Http\Controllers;
use App\Models\Dukun;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function show(Dukun $dukun)
    {
        return view('catalog.show', compact('dukun'));
    }
}