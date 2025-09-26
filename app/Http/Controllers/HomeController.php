<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredNews = News::published()
            ->publicNews()
            ->featured()
            ->latest('published_at')
            ->first();

        $latestNews = News::published()
            ->publicNews()
            ->when($featuredNews, function ($query) use ($featuredNews) {
                return $query->where('id', '!=', $featuredNews->id);
            })
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('compro', compact('featuredNews', 'latestNews'));
    }
}
