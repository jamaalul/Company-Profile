<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index()
    {
        $featuredNews = News::published()
            ->internalNews()
            ->featured()
            ->latest('published_at')
            ->first();

        $news = News::published()
            ->internalNews()
            ->when($featuredNews, function ($query) use ($featuredNews) {
                return $query->where('id', '!=', $featuredNews->id);
            })
            ->latest('published_at')
            ->paginate(12);

        return view('portal.index', compact('featuredNews', 'news'));
    }

    public function show(News $news)
    {
        if (!$news->is_published || $news->type !== 'internal') {
            abort(404);
        }

        $news->incrementViews();

        $relatedNews = News::published()
            ->internalNews()
            ->where('id', '!=', $news->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('portal.show', compact('news', 'relatedNews'));
    }
}
