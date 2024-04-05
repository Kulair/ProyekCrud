<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $products = Product::all();
        return response(view('welcome', ['products' =>

        $products]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response(view('products.create'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // Validate the incoming request using StoreProductRequest

        // If validation passes, create a new Product instance and save it to the database
        $product = Product::create([
            'kode' => $request->kode,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // Check if product is successfully created
        if ($product) {
            return view('products.index');
        } else {
            return back()->with('error', 'Failed to create product.');
        }
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
    public function edit(string $id): Response
    {
        $product = Product::findOrFail($id);
        return response(view('products.edit', ['product' =>

        $product]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        if ($product->update($request->validated())) {
            $product->save(); // Simpan perubahan
            return redirect(route('index'))->with('success', 'Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product->delete()) {
            return

                view ('products.delete');
        }
        return $product;
    }
}
