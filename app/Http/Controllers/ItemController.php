<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\{Category, Item};

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        $category = Category::all();
        return view('items.index',compact('items', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => ['string', 'required', 'min:5', 'max:20'],
            'merk' => ['string', 'required', 'min:5', 'max:20'],
            'kategori_barang' => ['integer', 'required', Rule::exists('categories', 'id')],
            'status' => ['required', 'in:good,broke,maintenance'],
            'gambar_barang' => ['required', 'image', 'mimes:png,jpg,jpeg,svg', 'max:2048'],
            'deskripsi' => ['required', 'max:1000']
        ]);

        dd($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
