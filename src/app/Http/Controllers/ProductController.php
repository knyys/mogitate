<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Season;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sortOption = $request->input('sort', 'default');
        $query = Product::with('seasons');

        if ($sortOption === 'hight') {
            $query->orderBy('price', 'desc'); // 高い順
        } elseif ($sortOption === 'low') {
            $query->orderBy('price', 'asc'); // 低い順
        }
        $products = $query->get();

        $products = $query->paginate(6);
        
        return view('index', [
            'products' => $products,
            'sortOption' => $sortOption 
        ]);
    }

    public function search(Request $request)
    {
        $searchText = $request->input('text'); 
        $sortOption = $request->input('sort', 'default');
        $sortOption = $request->input('sort');

        $query = Product::query();

        if ($searchText) {
            $query->where('name', 'like', '%' . $searchText . '%');
        }

        if ($sortOption === 'hight') {
            $query->orderBy('price', 'desc');
        } elseif ($sortOption === 'low') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->get();

        return view('index', compact('products', 'sortOption'));
    }

    public function product($productId)
{
        $product = Product::with('seasons')->findOrFail($productId);
        $seasonIds = $product->seasons->pluck('id')->toArray();
        $seasons = [
        1 => '春', 
        2 => '夏',
        3 => '秋',
        4 => '冬',
        ];

        return view('product', compact('product', 'seasonIds', 'seasons'));
    }


    public function update(ProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        if ($product->name !== $validatedData['product_name']) {
            $product->name = $validatedData['product_name'];
        }
        if ($product->img !== $validatedData['img']) {
            $product->img = $validatedData['img'];
        }
        if ($product->price !== $validatedData['price']) {
            $product->price = $validatedData['price'];
        }
        if ($product->description !== $validatedData['description']) {
            $product->description = $validatedData['description'];
        }
        if ($product->isDirty()) {
            $product->save();
        }
        $selectedSeasons = Season::whereIn('name', $validatedData['season_names'] ?? [])
                                ->get();  
        $selectedSeasonIds = $selectedSeasons->pluck('id')->toArray();
        $product->seasons()->sync($selectedSeasonIds);

        return redirect()->route('product') ;
    }



    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->seasons()->delete();
        $product->delete();

        return redirect()->route('products');
    }


    public function registerform()
    {
        return view('register');
    }


    public function register(ProductRequest $request)
{

    dd($request->input('season_name'));

        $productData = $request->only(['product_name', 'price', 'description']);
        $productData['name'] = $request->only(['product_name'])['product_name']; 
        $imagePath = $request->file('image')->store('images', 'public');
        $imageUrl = Storage::url($imagePath);
        $productData['image'] = $imageUrl;

        $product = Product::create($productData);

    
        $seasonNames = $request->input('season_name', []); 
        $seasonIds = [];

        foreach ($seasonNames as $seasonName) {
            $season = Season::firstOrCreate(['name' => $seasonName]);
            $seasonIds[] = $season->id;
        }
        $product->seasons()->attach($seasonIds);

        /*return redirect()->route('products');*/
}

}
