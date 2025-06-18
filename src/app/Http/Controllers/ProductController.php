<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

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

    $query = Product::query();

    // 商品名で部分一致検索
    if ($searchText) {
        $query->where('name', 'like', '%' . $searchText . '%');
    }

    // 並び替え
    if ($sortOption === 'hight') {
        $query->orderBy('price', 'desc');
    } elseif ($sortOption === 'low') {
        $query->orderBy('price', 'asc');
    }

    $products = $query->paginate(6)->appends($request->all()); // ← ページネーションでクエリ保持

    return view('index', compact('products', 'sortOption', 'searchText'));
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

        if ($product->price !== $validatedData['price']) {
            $product->price = $validatedData['price'];
        }

        if ($product->description !== $validatedData['description']) {
            $product->description = $validatedData['description'];
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = Storage::url($imagePath);
        }

        if ($product->isDirty()) {
            $product->save();
        }

        $seasonNames = $validatedData['season_name'] ?? [];
        $seasonIds = Season::whereIn('name', $seasonNames)->pluck('id')->toArray();
        $product->seasons()->sync($seasonIds);

        return redirect()->route('product', ['productId' => $product->id])->with('success', '商品情報が更新されました。');

    }



    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->seasons()->detach();
        $product->delete();

        return redirect()->route('products_list');
    }


    public function registerform()
    {
        return view('register');
    }


    public function register(ProductRequest $request)
    {

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

            return redirect()->route('products_list');
    }

}
