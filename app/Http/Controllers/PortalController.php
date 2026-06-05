<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index()
    {
        $firstNews = News::published()
            ->internalNews()
            ->featured()
            ->latest('published_at')
            ->first();

        $news = News::published()
            ->internalNews()
            ->when($firstNews, function ($query) use ($firstNews) {
                return $query->where('id', '!=', $firstNews->id);
            })
            ->latest('published_at')
            ->paginate(12);

        return view('portal.index', compact('firstNews', 'news'));
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
