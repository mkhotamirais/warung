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
        $products = Product::all();
        $productcats = Productcat::all();
        $search = $request->search;
        $sort = $request->sort ?? "cheapest";
        $category_slug = $request->category;

        if ($sort === 'cheapest') {
            $products = Product::orderBy('price');
        } elseif ($sort === 'most-expensive') {
            $products = Product::orderByDesc('price');
        } else {
            $products = Product::latest();
        }

        if ($search) {
            $products = $products->where('name', 'like', "%$search%");
        }

        if ($category_slug) {
            $products = $products->whereHas('productcat', function ($query) use ($category_slug) {
                $query->where('slug', $category_slug);  // Mencocokkan slug kategori
            });
        }

        $products = $products->paginate(16);
        return view("home", compact('total', 'products', 'productcats', 'search', 'sort', 'category_slug'));
    }
}
