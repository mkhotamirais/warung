<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['show']),
        ];
    }

    public function index()
    {
        Gate::allowIf(fn(User $user) => $user->role === 'admin' || $user->role === 'editor');

        $myBlogs = Blog::where('user_id', Auth::id())->latest()->paginate(8);
        return view('dashboard.blog.index', compact('myBlogs'));
    }

    public function create()
    {
        Gate::allowIf(fn(User $user) => $user->role === 'admin' || $user->role === 'editor');
        return view('dashboard.blog.create');
    }

    public function store(Request $request)
    {
        Gate::allowIf(fn(User $user) => $user->role === 'admin' || $user->role === 'editor');

        $fields = $request->validate([
            'title' => 'required|max:255|unique:blogs',
            'content' => 'required',
            'blogcat_id' => 'nullable|integer|exists:blogcats,id',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $slug = Str::slug($fields['title']);

        // Upload image if file exist
        $path = null;
        if ($request->hasFile('banner')) {
            $path = Storage::disk('public')->put('blogs-images', $request->banner);
        }

        $blog = Auth::user()->blogs()->create([...$fields, 'slug' => $slug, 'banner' => $path]);

        Mail::to(Auth::user())->send(new WelcomeMail(Auth::user(), $blog));

        return redirect('/blogs')->with('success', 'Blog berhasil dibuat');
    }

    public function show(Blog $blog)
    {
        $latestBlogs = Blog::latest()->where('id', '!=', $blog->id)->take(8)->get();
        return view('public.blog.show', compact('blog', 'latestBlogs'));
    }

    public function edit(Blog $blog)
    {
        // authorize
        Gate::authorize('modify', $blog);
        return view('dashboard.blog.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        Gate::authorize('modify', $blog);

        // Validate
        $fields = $request->validate([
            'title' => "required|max:255|unique:blogs,title,$blog->id",
            'content' => 'required',
            'blogcat_id' => 'nullable|integer|exists:blogcats,id',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'delete_banner' => 'nullable|boolean'
        ]);


        $slug = Str::slug($fields['title']);

        // Handle image deletion
        if ($request->has('delete_banner') && $request->delete_banner) {
            if ($blog->banner) {
                Storage::disk('public')->delete($blog->banner);
            }
            $fields['banner'] = null;
        }

        // Upload new image if provided
        if ($request->hasFile('banner')) {
            if ($blog->banner) {
                Storage::disk('public')->delete($blog->banner);
            }
            $fields['banner'] = Storage::disk('public')->put('blogs-images', $request->banner);
        }

        // Update the blog
        $blog->update([...$fields, 'slug' => $slug]);

        return redirect('/blogs')->with('success', "$blog->title berhasil di-update");
    }

    public function destroy(Blog $blog)
    {
        Gate::authorize('modify', $blog);

        if ($blog->banner) {
            Storage::disk('public')->delete($blog->banner);
        }

        $blog->delete();

        return back()->with('success', "$blog->title berhasil dihapus");
    }
}
