<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Productcat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // new Middleware('auth', only: ['store']),
            // new Middleware('auth', except: ['show']),
            new Middleware('auth'),
        ];
    }
    public function index(Request $request)
    {
        $products = Product::latest()->paginate(8);
        $myProducts = Product::where('user_id', Auth::id())->latest();
        $search = $request->search;

        if ($search) {
            $myProducts = $myProducts->where('name', 'like', "%$search%");
        }

        $myProducts = $myProducts->paginate(4);

        return view('dashboard.product.index', compact('products', 'myProducts', 'search'));
    }
    public function create()
    {
        $productCategories = Productcat::all();
        return view('dashboard.product.create', compact('productCategories'));
    }

    public function store(Request $request)
    {
        // authorize
        // Gate::authorize('modify', $product);

        // Validate
        $fields = $request->validate([
            'name' => 'required|max:255|unique:products',
            'price' => 'required|integer',
            'price_details' => 'nullable',
            'description' => 'nullable',
            'productcat_id' => 'nullable|integer|exists:productcats,id',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:1024',
        ]);

        $slug = Str::slug($fields['name']);

        // Upload image if file exist
        $path = null;
        if ($request->hasFile('banner')) {
            $path = Storage::disk('public')->put('products-images', $request->banner);
        }

        Auth::user()->products()->create([...$fields, 'slug' => $slug, 'banner' => $path]);

        return redirect('/products')->with('success', 'Product created successfully');
    }

    public function destroy(Product $product)
    {
        // authorize
        Gate::authorize('modify', $product);

        if ($product->banner) {
            Storage::disk('public')->delete($product->banner);
        }

        $product->delete();

        return back()->with('delete', 'Product deleted successfully');
    }

    public function edit(Product $product)
    {
        // authorize
        Gate::authorize('modify', $product);
        $productCategories = Productcat::all();
        return view('dashboard.product.edit', compact('product', 'productCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        // authorize
        Gate::authorize('modify', $product);

        // Validate
        $fields = $request->validate([
            // 'name' => ['required', 'max:255', Rule::unique('products')->ignore($product->id)],
            'name' => "required|max:255|unique:products,name,$product->id",
            'price' => 'required|integer',
            'price_details' => 'nullable',
            'description' => 'nullable',
            'productcat_id' => 'nullable|integer|exists:productcats,id',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:1024',
            'delete_banner' => 'nullable|boolean'
        ]);

        $slug = Str::slug($fields['name']);

        // // Upload image if file exist
        // $path = $product->banner ?? null;
        // if ($request->hasFile('banner')) {
        //     if ($product->banner) {
        //         Storage::disk('public')->delete($product->banner);
        //     }
        //     $path = Storage::disk('public')->put('products-images', $request->banner);
        // }

        // Handle image deletion
        if ($request->has('delete_banner') && $request->delete_banner) {
            if ($product->banner) {
                Storage::disk('public')->delete($product->banner);
            }
            $fields['banner'] = null;
        }

        // Upload new image if provided
        if ($request->hasFile('banner')) {
            if ($product->banner) {
                Storage::disk('public')->delete($product->banner);
            }
            $fields['banner'] = Storage::disk('public')->put('products-images', $request->banner);
        }


        // Update the product
        // $product->update([...$fields, 'slug' => $slug, 'banner' => $path]);
        $product->update([...$fields, 'slug' => $slug]);

        return redirect('/products')->with('success', 'Product updated successfully');
    }
}
