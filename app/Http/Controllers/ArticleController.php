<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    // Show newsletter grid (for now you can still use your blade content or adapt it)
    public function index()
    {
        $articles = Article::latest()->get();

        return view('newsletter', compact('articles'));
    }

    // Show the admin add-article form
    public function create()
    {
        return view('add-article');
    }

    // Store a new article
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'image' => 'nullable|image|max:4096',
            'content' => 'required|array|min:1',
            'content.*.header' => 'nullable|string|max:255',
            'content.*.paragraph' => 'nullable|string',
        ]);

        // handle image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        $article = Article::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']).'-'.Str::random(6),
            'short_description' => $validated['short_description'] ?? null,
            'image' => $imagePath,
            'content' => $validated['content'],
        ]);

        return redirect()->route('articles.show', $article->slug)
            ->with('success', 'Article added successfully!');
    }

    // Render an article by slug
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        return view('article-show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('article-edit', compact('article'));
    }

    public function saveEdit(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'content' => 'required|array|min:1',
            'content.*.header' => 'nullable|string|max:255',
            'content.*.paragraph' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
        ]);

        // change image is optional
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $article->image = $imagePath;
        }

        $article->title = $validated['title'];
        $article->short_description = $validated['short_description'] ?? null;
        $article->content = $validated['content'];

        $article->save();

        return redirect()->route('articles.show', $article->slug)
            ->with('success', 'Article updated successfully!');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('newsletter.index')
            ->with('success', 'Article deleted successfully!');
    }
}
