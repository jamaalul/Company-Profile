@extends('admin.layouts.app')

@section('title', 'Edit News')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit News Article</h1>
            <p class="text-gray-600">Update article information and content</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.news.show', $news) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                View Article
            </a>
            <a href="{{ route('admin.news.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to News
            </a>
        </div>
    </div>

    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">Article Information</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="lg:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('title') ? 'border-red-300' : '' }}">
                    @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                    <select name="type" id="type" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('type') ? 'border-red-300' : '' }}">
                        <option value="">Select Type</option>
                        <option value="public" {{ old('type', $news->type) === 'public' ? 'selected' : '' }}>Public News</option>
                        <option value="internal" {{ old('type', $news->type) === 'internal' ? 'selected' : '' }}>Internal News</option>
                    </select>
                    @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Featured Image -->
                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                    @if($news->featured_image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $news->featured_image) }}" 
                             alt="Current featured image" 
                             class="w-32 h-20 object-cover rounded-lg">
                        <p class="text-sm text-gray-500 mt-1">Current image</p>
                    </div>
                    @endif
                    <input type="file" name="featured_image" id="featured_image" accept="image/*"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('featured_image') ? 'border-red-300' : '' }}">
                    <p class="mt-1 text-sm text-gray-500">Max size: 2MB. Leave empty to keep current image.</p>
                    @error('featured_image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Excerpt -->
                <div class="lg:col-span-2">
                    <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt *</label>
                    <textarea name="excerpt" id="excerpt" rows="3" required maxlength="500"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('excerpt') ? 'border-red-300' : '' }}"
                              placeholder="Brief summary of the article (max 500 characters)">{{ old('excerpt', $news->excerpt) }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Character count: <span id="excerpt-count">0</span>/500</p>
                    @error('excerpt')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div class="lg:col-span-2">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
                    <textarea name="content" id="content" rows="12" required
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('content') ? 'border-red-300' : '' }}"
                              placeholder="Write your article content here...">{{ old('content', $news->content) }}</textarea>
                    @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Settings -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">Publication Settings</h2>
            
            <div class="space-y-4">
                <!-- Is Featured -->
                <div class="flex items-center">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                        Featured Article
                        <span class="text-gray-500">(Will be displayed prominently on the homepage)</span>
                    </label>
                </div>

                <!-- Is Published -->
                <div class="flex items-center">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $news->is_published) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_published" class="ml-2 block text-sm text-gray-700">
                        Published
                        <span class="text-gray-500">(Article will be visible to users)</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.news.show', $news) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg font-medium transition-colors">
                Cancel
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Update Article
            </button>
        </div>
    </form>
</div>

<script>
// Character counter for excerpt
document.getElementById('excerpt').addEventListener('input', function() {
    const count = this.value.length;
    document.getElementById('excerpt-count').textContent = count;
    
    if (count > 500) {
        this.classList.add('border-red-300');
        document.getElementById('excerpt-count').classList.add('text-red-600');
    } else {
        this.classList.remove('border-red-300');
        document.getElementById('excerpt-count').classList.remove('text-red-600');
    }
});

// Initialize character count
document.addEventListener('DOMContentLoaded', function() {
    const excerpt = document.getElementById('excerpt');
    document.getElementById('excerpt-count').textContent = excerpt.value.length;
});
</script>
@endsection
