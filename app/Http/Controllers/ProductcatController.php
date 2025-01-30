<?php

namespace App\Http\Controllers;

use App\Models\Productcat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductcatController extends Controller
{
    public function index()
    {
        $productCats = Productcat::latest()->get();

        return view("dashboard.product.productcat", compact("productCats"));
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255|unique:productcats',
        ]);

        $slug = Str::slug($request->name);

        Productcat::create([...$fields, 'slug' => $slug]);

        return back()->with('success', 'Product category created successfully');
    }

    public function update(Request $request, Productcat $productcat)
    {
        $fields = $request->validate([
            'name' => 'required|max:255|unique:productcats',
        ]);

        $slug = Str::slug($request->name);

        $productcat->update([...$fields, 'slug' => $slug]);

        return back()->with('success', 'Product category updated successfully');
    }

    public function destroy(Productcat $productcat)
    {
        if ($productcat->id === 1) {
            return back()->with('error', 'Default category cannot be deleted.');
        }
        $productcat->delete();
        return back()->with('success', 'Product category deleted successfully');
    }
}
