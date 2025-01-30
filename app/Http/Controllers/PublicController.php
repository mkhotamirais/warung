<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Productcat;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $total = Product::count();
        $totalCats = Productcat::count();

        // $productcats = Productcat::orderBy('name')->get();
        // Ambil kategori produk dan hitung jumlah produk per kategori
        $productcats = Productcat::orderBy('name')->withCount('products')->get();

        $search = $request->search;
        $sort = $request->sort;
        $category_slug = $request->category;

        if ($sort === 'cheapest') {
            $products = Product::orderBy('price');
        } elseif ($sort === 'most-expensive') {
            $products = Product::orderByDesc('price');
        } elseif ($sort === 'latest') {
            $products = Product::latest();
        } elseif ($sort === 'oldest') {
            $products = Product::oldest();
        } elseif ($sort === 'a-z') {
            $products = Product::orderBy('name');
        } elseif ($sort === 'z-a') {
            $products = Product::orderByDesc('name');
        } else {
            $products = Product::orderBy('name');
        }

        if ($search) {
            $products = $products->where('name', 'like', "%$search%");
        }

        if ($category_slug) {
            $products = $products->whereHas('productcat', function ($query) use ($category_slug) {
                $query->where('slug', $category_slug);  // Mencocokkan slug kategori
            });
        }

        $products = $products->paginate(4);
        return view("home", compact('total', 'totalCats', 'products', 'productcats', 'search', 'sort', 'category_slug'));
    }
}
