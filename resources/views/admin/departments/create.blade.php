@extends('admin.layouts.app')

@section('title', 'Add New Department')

@section('content')

<style>
    /* --- General Styling --- */
    .form-container {
        font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        color: #333;
    }
    .page-title {
        font-size: 1.5rem; /* 24px */
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 1.5rem;
    }

    /* --- Card & Form Layout --- */
    .card {
        background-color: #ffffff;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }
    .card-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem; /* Jarak antar seksi */
    }
    .card-footer {
        padding: 1rem 1.5rem;
        background-color: #f9fafb;
        text-align: right;
        border-top: 1px solid #e5e7eb;
    }

    /* --- Form Sections --- */
    .form-section h3 {
        font-size: 1.125rem; /* 18px */
        font-weight: 500;
        color: #111827;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e5e7eb;
    }
    .input-grid {
        margin-top: 1rem;
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    /* Responsive grid for larger screens */
    @media (min-width: 768px) {
        .input-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
    .full-width {
        grid-column: 1 / -1;
    }

    /* --- Form Elements --- */
    .form-group label {
        display: block;
        font-size: 0.875rem; /* 14px */
        font-weight: 500;
        color: #4a5568;
        margin-bottom: 0.25rem;
    }
    .form-input, .form-textarea {
        width: 100%;
        margin-top: 0.25rem;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d2d6dc;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: #4f46e5; /* Indigo */
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
    }
    .form-textarea {
        resize: vertical;
    }

    /* --- Custom File Input --- */
    .file-input {
        margin-top: 0.25rem;
        width: 100%;
        font-size: 0.875rem;
        color: #4a5568;
    }
    .file-input::file-selector-button {
        margin-right: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 9999px; /* pill shape */
        border: none;
        font-size: 0.875rem;
        font-weight: 600;
        background-color: #eef2ff; /* blue-50 */
        color: #3730a3; /* blue-700 */
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .file-input::file-selector-button:hover {
        background-color: #e0e7ff; /* blue-100 */
    }

    /* --- Buttons --- */
    .btn {
        display: inline-block;
        padding: 0.6rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        text-decoration: none;
        transition: background-color 0.2s, color 0.2s;
        border: 1px solid transparent;
        cursor: pointer;
    }
    .btn-secondary {
        color: #4a5568;
        background-color: transparent;
        margin-right: 0.5rem;
    }
    .btn-secondary:hover {
        color: #1a202c;
        background-color: #e2e8f0;
    }
    .btn-primary {
        color: #ffffff;
        background-color: #4f46e5; /* blue-600 */
    }
    .btn-primary:hover {
        background-color: #4338ca; /* blue-700 */
    }
</style>

<div class="form-container">
    <h1 class="page-title">Add New Department</h1>

    <div class="card">
        <form action="{{ route('admin.departments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                
                <div class="form-section">
                    <h3>Main Department Info</h3>
                    <div class="input-grid">
                        <div class="form-group">
                            <label for="name">Department Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="leadership_photo">Main Leadership Photo</label>
                            <input type="file" name="leadership_photo" id="leadership_photo" class="file-input" required>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Department Details</h3>
                    <div class="input-grid">
                        <div class="form-group">
                            <label for="head_name">Department Head Name</label>
                            <input type="text" name="head_name" id="head_name" value="{{ old('head_name') }}" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="head_photo">Department Head Photo</label>
                            <input type="file" name="head_photo" id="head_photo" class="file-input" required>
                        </div>
                        <div class="form-group full-width">
                            <label for="division_words">Welcome Message</label>
                            <textarea name="division_words" id="division_words" rows="4" class="form-textarea">{{ old('division_words') }}</textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Department</button>
            </div>
        </form>
    </div>
</div>
@endsection