@extends('admin.layouts.app')

@section('title', 'Edit Sub-department')

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
    .page-title span {
        color: #2563eb; /* blue-600 */
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
        gap: 1.5rem;
    }
    .card-footer {
        padding: 1rem 1.5rem;
        background-color: #f9fafb;
        text-align: right;
        border-top: 1px solid #e5e7eb;
    }

    /* --- Form Elements --- */
    .form-group label {
        display: block;
        font-size: 0.875rem; /* 14px */
        font-weight: 500;
        color: #4a5568;
        margin-bottom: 0.25rem;
    }
    .form-input, .form-select {
        width: 100%;
        margin-top: 0.25rem;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d2d6dc;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: #4f46e5; /* Indigo */
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
    }
    .file-input {
        margin-top: 0.25rem;
        width: 100%;
        font-size: 0.875rem;
        color: #4a5568;
    }
    .file-input::file-selector-button {
        margin-right: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        border: none;
        font-size: 0.875rem;
        font-weight: 600;
        background-color: #eef2ff;
        color: #3730a3;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .file-input:hover::file-selector-button {
        background-color: #e0e7ff;
    }
    .helper-text {
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
    }
    .current-image {
        margin-top: 0.5rem;
        height: 5rem;
        width: 5rem;
        border-radius: 0.5rem;
        object-fit: cover;
    }
    
    /* --- Grid & Section Header --- */
    .input-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    @media (min-width: 768px) {
        .input-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e5e7eb;
        margin-top: 1.5rem;
    }
    .section-header h3 {
        font-size: 1.125rem;
        font-weight: 500;
        color: #111827;
    }

    /* --- Work Program Styling --- */
    #work-programs-container {
        margin-top: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    .work-program-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .work-program-item input {
        flex-grow: 1;
    }

    /* --- Buttons --- */
    .btn {
        display: inline-flex;
        align-items: center;
        padding: 0.6rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        border: 1px solid transparent;
        cursor: pointer;
    }
    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
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
        background-color: #4f46e5;
    }
    .btn-primary:hover {
        background-color: #4338ca;
    }
    .btn-add {
        background-color: #e0e7ff;
        color: #3730a3;
    }
    .btn-add:hover {
        background-color: #c7d2fe;
    }
    .btn-add svg {
        width: 1rem;
        height: 1rem;
        margin-right: 0.5rem;
    }
    .remove-btn {
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 9999px;
        color: #ef4444; /* red-500 */
        flex-shrink: 0;
    }
    .remove-btn:hover {
        background-color: #fee2e2; /* red-100 */
        color: #b91c1c; /* red-700 */
    }
</style>

<div class="form-container">
    <h1 class="page-title">Edit Sub-department in <span>{{ $subDepartment->department->name }}</span></h1>

    <div class="card">
        <form action="{{ route('admin.sub-departments.update', $subDepartment->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="department_id">Parent Department</label>
                    <select name="department_id" id="department_id" class="form-select" required>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" @selected(old('department_id', $subDepartment->department_id) == $department->id)>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-grid">
                    <div class="form-group">
                        <label for="name">Sub-department Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $subDepartment->name) }}" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="sub_department_photo">Change Photo</label>
                        <input type="file" name="sub_department_photo" id="sub_department_photo" class="file-input">
                        <p class="helper-text">Leave blank if you don't want to change the image.</p>
                        <img src="{{ asset($subDepartment->sub_department_photo) }}" alt="Current Photo" class="current-image">
                    </div>
                </div>

                <div>
                    <div class="section-header">
                        <h3>Work Programs</h3>
                        <button type="button" id="add-work-program" class="btn btn-add btn-sm">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Add Program
                        </button>
                    </div>
                    <div id="work-programs-container" data-program-index="{{ count(old('work_programs', $subDepartment->work_programs ?? [])) }}">
                        @if(old('work_programs', $subDepartment->work_programs))
                            @foreach(old('work_programs', $subDepartment->work_programs) as $index => $program)
                            <div class="work-program-item">
                                <input type="text" name="work_programs[{{ $index }}][title]" class="form-input" placeholder="Program Title" value="{{ $program['title'] }}" required>
                                <input type="text" name="work_programs[{{ $index }}][description]" class="form-input" placeholder="Description" value="{{ $program['description'] }}" required>
                                <button type="button" class="remove-work-program remove-btn" title="Remove Program">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.sub-departments.index', ['department_id' => $subDepartment->department_id]) }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Sub-department</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('work-programs-container');
    const addBtn = document.getElementById('add-work-program');
    
    let programIndex = parseInt(container.dataset.programIndex) || 0;

    addBtn.addEventListener('click', () => {
        const programHTML = `
            <div class="work-program-item">
                <input type="text" name="work_programs[${programIndex}][title]" class="form-input" placeholder="Program Title" required>
                <input type="text" name="work_programs[${programIndex}][description]" class="form-input" placeholder="Description" required>
                <button type="button" class="remove-work-program remove-btn" title="Remove Program">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', programHTML);
        programIndex++;
    });

    container.addEventListener('click', function(e) {
        const removeBtn = e.target.closest('.remove-work-program');
        if (removeBtn) {
            removeBtn.closest('.work-program-item').remove();
        }
    });
});
</script>
@endpush
@endsection