<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $featuredNews = News::published()
            ->publicNews()
            ->featured()
            ->latest('published_at')
            ->first();

        $news = News::published()
            ->publicNews()
            ->when($featuredNews, callback: function ($query) use ($featuredNews) {
                return $query->where('id', '!=', $featuredNews->id);
            })
            ->latest('published_at')
            ->paginate(12);

        return view('news.index', compact('featuredNews', 'news'));
    }

    public function show(News $news)
    {
        if (!$news->is_published || $news->type !== 'public') {
            abort(404);
        }

        $news->incrementViews();

        $relatedNews = News::published()
            ->publicNews()
            ->where('id', '!=', $news->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }
}
