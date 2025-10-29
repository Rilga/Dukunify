<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dukun;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Dukun::query()
                    ->with('categories');

        if ($search) {
            $query->where('nama_dukun', 'like', '%' . $search . '%');
        }

        $dukuns = $query->paginate(9);

        return view('user.dashboard', [
            'dukuns' => $dukuns,
            'search' => $search,
        ]);
    }
}