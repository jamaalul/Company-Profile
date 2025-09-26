@extends('admin.layouts.app')

@section('title', 'View News')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">View News Article</h1>
            <p class="text-gray-600">Article details and preview</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.news.edit', $news) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Article
            </a>
            <a href="{{ route('admin.news.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to News
            </a>
        </div>
    </div>

    <!-- Article Info -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <h2 class="text-xl font-bold text-gray-900 mb-4">{{ $news->title }}</h2>
                
                <div class="flex flex-wrap items-center gap-4 mb-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $news->type === 'public' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                        {{ ucfirst($news->type) }} News
                    </span>
                    
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $news->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $news->is_published ? 'Published' : 'Draft' }}
                    </span>
                    
                    @if($news->is_featured)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        Featured
                    </span>
                    @endif
                </div>
                
                <div class="text-gray-600 space-y-2">
                    <p><strong>Author:</strong> {{ $news->author->name }}</p>
                    <p><strong>Created:</strong> {{ $news->created_at->format('F d, Y \a\t g:i A') }}</p>
                    <p><strong>Last Updated:</strong> {{ $news->updated_at->format('F d, Y \a\t g:i A') }}</p>
                    @if($news->published_at)
                    <p><strong>Published:</strong> {{ $news->published_at->format('F d, Y \a\t g:i A') }}</p>
                    @endif
                    <p><strong>Views:</strong> {{ number_format($news->views_count) }}</p>
                    <p><strong>Slug:</strong> <code class="bg-gray-100 px-2 py-1 rounded">{{ $news->slug }}</code></p>
                </div>
            </div>
            
            <div>
                @if($news->featured_image)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                    <img src="{{ asset('storage/' . $news->featured_image) }}" 
                         alt="{{ $news->title }}" 
                         class="w-full h-48 object-cover rounded-lg shadow">
                </div>
                @endif
                
                <!-- Quick Actions -->
                <div class="space-y-3">
                    @if($news->is_published)
                    <a href="{{ $news->type === 'public' ? route('news.show', $news) : route('portal.show', $news) }}" 
                       target="_blank"
                       class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors text-center block">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        View Live Article
                    </a>
                    @endif
                    
                    <form action="{{ route('admin.news.destroy', $news) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this article? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Article
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Content -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Article Content</h3>
        
        <!-- Excerpt -->
        <div class="mb-6">
            <h4 class="text-md font-medium text-gray-700 mb-2">Excerpt</h4>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-700 italic">{{ $news->excerpt }}</p>
            </div>
        </div>
        
        <!-- Content -->
        <div class="mb-6">
            <h4 class="text-md font-medium text-gray-700 mb-2">Full Content</h4>
            <div class="prose max-w-none bg-gray-50 rounded-lg p-6">
                <div class="text-gray-800 leading-relaxed whitespace-pre-line">{{ $news->content }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
