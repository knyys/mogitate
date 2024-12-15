<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;


class ProductController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function product()
    {
        return view('product');
    }

    public function update(ProductRequest $request)
    {
        $productData = $request->only(['product_name', 'price', 'description', 'season_name']);
        $productData['image'] = $request->file('image')->store('images', 'public');

        $product->seasons()->attach($seasonIds); 
        
        return redirect('/product');

    }

    public function registerform()
    {
        return view('register');
    }

    public function register(ProductRequest $request)
    {
        $productData = $request->only(['product_name', 'price', 'description']);
        $productData['image'] = $productRequest->file('image')->store('images', 'public');
        $product = Product::create($productData);

        $seasonName = $seasonRequest->input('season_name', []);
        $seasonIds = [];

        foreach ($seasonNames as $seasonName) {
            $season = Season::firstOrCreate(['name' => $seasonName]);
            $seasonIds[] = $season->id;
        }

        $product->seasons()->attach($seasonIds); 
        
        return redirect('/product');
    }

}
