@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-gradient text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Welcome to <span class="text-yellow-300">HIMTI</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-100 max-w-3xl mx-auto">
                Himpunan Mahasiswa Teknik Informatika - Membangun masa depan teknologi Indonesia melalui inovasi, kolaborasi, dan dedikasi.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('news.index') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Explore News
                </a>
                <a href="{{ route('marketplace.index') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                    Visit Marketplace
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured News Section -->
@if($featuredNews)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Featured News</h2>
            <p class="text-gray-600 text-lg">Stay updated with our latest achievements and activities</p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/2">
                    <img src="{{ $featuredNews->featured_image ? asset('storage/' . $featuredNews->featured_image) : '/placeholder.svg?height=400&width=600' }}" 
                         alt="{{ $featuredNews->title }}" 
                         class="w-full h-64 md:h-full object-cover">
                </div>
                <div class="md:w-1/2 p-8">
                    <div class="flex items-center mb-4">
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">Featured</span>
                        <span class="text-gray-500 text-sm ml-4">{{ $featuredNews->published_at->format('M d, Y') }}</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $featuredNews->title }}</h3>
                    <p class="text-gray-600 mb-6">{{ $featuredNews->excerpt }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="text-gray-600 font-semibold text-sm">{{ substr($featuredNews->author->name, 0, 1) }}</span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $featuredNews->author->name }}</p>
                                <p class="text-sm text-gray-500">{{ $featuredNews->views_count }} views</p>
                            </div>
                        </div>
                        <a href="{{ route('news.show', $featuredNews) }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Latest News Section -->
@if($latestNews->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Latest News</h2>
            <p class="text-gray-600 text-lg">Discover what's happening in our community</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($latestNews as $news)
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="{{ $news->featured_image ? asset('storage/' . $news->featured_image) : '/placeholder.svg?height=200&width=400' }}" 
                     alt="{{ $news->title }}" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <span class="text-blue-600 text-sm font-semibold">{{ $news->published_at->format('M d, Y') }}</span>
                        <span class="text-gray-400 mx-2">•</span>
                        <span class="text-gray-500 text-sm">{{ $news->views_count }} views</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $news->title }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $news->excerpt }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="text-gray-600 font-semibold text-xs">{{ substr($news->author->name, 0, 1) }}</span>
                            </div>
                            <span class="ml-2 text-sm text-gray-700">{{ $news->author->name }}</span>
                        </div>
                        <a href="{{ route('news.show', $news) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                            Read More →
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('news.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                View All News
            </a>
        </div>
    </div>
</section>
@endif

<!-- Features Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">What We Offer</h2>
            <p class="text-gray-600 text-lg">Explore our platforms and services</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-8 rounded-xl bg-gradient-to-br from-blue-50 to-indigo-100 card-hover">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Latest News</h3>
                <p class="text-gray-600 mb-6">Stay informed with the latest updates, achievements, and events from HIMTI community.</p>
                <a href="{{ route('news.index') }}" class="text-blue-600 font-semibold hover:text-blue-800">
                    Explore News →
                </a>
            </div>
            
            <div class="text-center p-8 rounded-xl bg-gradient-to-br from-purple-50 to-pink-100 card-hover">
                <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Portal HIMTI</h3>
                <p class="text-gray-600 mb-6">Access internal information, member resources, and exclusive content for HIMTI members.</p>
                <a href="{{ route('portal.index') }}" class="text-purple-600 font-semibold hover:text-purple-800">
                    Access Portal →
                </a>
            </div>
            
            <div class="text-center p-8 rounded-xl bg-gradient-to-br from-green-50 to-emerald-100 card-hover">
                <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Marketplace</h3>
                <p class="text-gray-600 mb-6">Shop for official HIMTI merchandise, apparel, and exclusive items from our store.</p>
                <a href="{{ route('marketplace.index') }}" class="text-green-600 font-semibold hover:text-green-800">
                    Shop Now →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Join Our Community</h2>
        <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
            Be part of the largest IT student organization and connect with like-minded individuals passionate about technology.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('portal.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                Learn More
            </a>
            <a href="mailto:info@himti.ac.id" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-gray-900 transition-colors">
                Contact Us
            </a>
        </div>
    </div>
</section>
@endsection
