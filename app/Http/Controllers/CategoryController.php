<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

use App\Models\{Category, Item};

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('items')->get();

        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => ['required', 'string', 'min:5', 'max:50'],
        ], [
            'nama_kategori.required' => 'Input Nama Kategori wajib diisi!',
            'nama_kategori.string' => 'Input khusus karakter',
            'nama_kategori.min' => 'Input minimal 5 karakter',
            'nama_kategori.max' => 'Input minimal 50 karakter',
        ]);

        // array data yang mau disimpan. key harus sesuai dengan yang ada di database.
        $simpan = [
            'uuid' => Str::uuid(),
            'category_name' => $request->nama_kategori,
        ];

        Category::create($simpan);

        // kembalik ke halaman index
        return back()->with('message', 'category has been created');
    }

    public function detail($param)
    {
        $category = Category::where('uuid', $param)->firstOrFail();
        $items = Item::where('category_id', $category->id)->get();

        return view('categories.detail', compact('category', 'items'));
    }

    public function update(Request $request, $param)
    {
        $data = Category::where('uuid', $param)->first();

        $request->validate([
            'nama_kategori' => ['required', 'string', 'min:5', 'max:50'],
        ], [
            'nama_kategori.required' => 'Input Nama Kategori wajib diisi!',
            'nama_kategori.string' => 'Input khusus karakter',
            'nama_kategori.min' => 'Input minimal 5 karakter',
            'nama_kategori.max' => 'Input minimal 50 karakter',
        ]);

        // array data yang mau disimpan. key harus sesuai dengan yang ada di database.
        $simpan = [
            'uuid' => Str::uuid(),
            'category_name' => $request->nama_kategori,
        ];

        $data->update($simpan);

        // kembalik ke halaman index
        return redirect()->route('category.detail', $data->uuid)
        ->with('message', 'category has been updated');
    }

    public function delete($param)
    {
        $category = Category::where('uuid', $param)->firstOrFail();
        $category->delete();
        return redirect()->route('category.index')
        ->with('message', 'Category Has been deleted');
    }
}
