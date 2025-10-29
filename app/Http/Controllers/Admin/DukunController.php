<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dukun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class DukunController extends Controller
{
    public function index()
    {
        $dukuns = Dukun::with('categories')->paginate(10);
        return view('admin.dukuns.index', compact('dukuns'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.dukuns.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_dukun' => 'required|string|max:255|unique:dukuns,kode_dukun',
            'nama_dukun' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
        ]);

        $data = $request->except(['categories', 'image']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('dukuns', 'public');
            $data['image'] = $path;
        }
        
        $dukun = Dukun::create($data);
        $dukun->categories()->attach($request->categories);

        return redirect()->route('admin.dukuns.index')
                         ->with('success', 'Dukun baru berhasil ditambahkan.');
    }

    public function edit(Dukun $dukun)
    {
        $categories = Category::all();
        $dukunCategoryIds = $dukun->categories->pluck('id')->toArray();
        return view('admin.dukuns.edit', compact('dukun', 'categories', 'dukunCategoryIds'));
    }

    public function update(Request $request, Dukun $dukun)
    {
        $request->validate([
            'kode_dukun' => 'required|string|max:255|unique:dukuns,kode_dukun,' . $dukun->id,
            'nama_dukun' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validasi gambar
        ]);

        $data = $request->except(['categories', 'image']);

        // Logika Update Gambar
        if ($request->hasFile('image')) {
            // 1. Hapus gambar lama jika ada
            if ($dukun->image) {
                Storage::disk('public')->delete($dukun->image);
            }
            
            // 2. Simpan gambar baru
            $path = $request->file('image')->store('dukuns', 'public');
            $data['image'] = $path;
        }

        $dukun->update($data);
        $dukun->categories()->sync($request->categories);

        return redirect()->route('admin.dukuns.index')
                         ->with('success', 'Data Dukun berhasil diperbarui.');
    }

    public function destroy(Dukun $dukun)
    {
        // Hapus gambar saat Dukun dihapus
        if ($dukun->image) {
            Storage::disk('public')->delete($dukun->image);
        }
        
        $dukun->delete();
        return redirect()->route('admin.dukuns.index')
                         ->with('success', 'Data Dukun berhasil dihapus.');
    }
}