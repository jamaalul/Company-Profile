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
            ->take(2)
            ->get();

        $allNews = collect([$featuredNews])
            ->filter()
            ->merge($latestNews)
            ->unique('id')
            ->take(3);

        return view('compro', compact('allNews'));
    }
}
