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

        // Ambil kategori produk dan hitung jumlah produk per kategori
        $productcats = Productcat::orderBy('name')->withCount('products')->get();

        $search = $request->search;
        $sort = $request->sort;
        $category_slug = $request->category;
        $filter_image = $request->filter_image;

        // sorting
        if ($sort === 'termurah') {
            $products = Product::orderBy('price');
        } elseif ($sort === 'termahal') {
            $products = Product::orderByDesc('price');
        } elseif ($sort === 'terbaru') {
            $products = Product::latest();
        } elseif ($sort === 'terlama') {
            $products = Product::oldest();
        } elseif ($sort === 'a-z') {
            $products = Product::orderBy('name');
        } elseif ($sort === 'z-a') {
            $products = Product::orderByDesc('name');
        } else {
            $products = Product::orderByRaw("CASE WHEN banner IS NOT NULL AND banner != '' THEN 1 ELSE 2 END")->orderBy('name');
            // $products = Product::orderBy('name');
        }

        // filtering
        if ($search) {
            $products = $products->where('name', 'like', "%$search%");
        }

        if ($category_slug) {
            $products = $products->whereHas('productcat', function ($query) use ($category_slug) {
                $query->where('slug', $category_slug);  // Mencocokkan slug kategori
            });
        }

        if ($filter_image === 'dengan-image') {
            $products = $products->whereNotNull('banner');
        } elseif ($filter_image === 'tanpa-image') {
            $products = $products->whereNull('banner');
        }

        $products = $products->paginate(32);
        return view("home", compact('total', 'totalCats', 'products', 'productcats', 'search', 'sort', 'category_slug', 'filter_image'));
    }
}
