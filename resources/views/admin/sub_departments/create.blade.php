@extends('admin.layouts.app')

@section('title', 'Add Sub-departments')

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
    }
    .card-footer {
        padding: 1rem 1.5rem;
        background-color: #f9fafb;
        text-align: right;
        border-top: 1px solid #e5e7eb;
    }

    /* --- Form Elements --- */
    .form-group {
        margin-bottom: 1.5rem;
    }
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
        border: 1px solid #d1d5db;
        border-radius: 9999px;
    }
    .file-input::file-selector-button {
        margin-right: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        border: none;
        font-size: 0.875rem;
        font-weight: 600;
        background-color: #ffffff;
        color: #4a5568;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .file-input:hover::file-selector-button {
        background-color: #f9fafb;
    }

    /* --- Section Header --- */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e5e7eb;
    }
    .section-header h3 {
        font-size: 1.125rem;
        font-weight: 500;
        color: #111827;
    }

    /* --- Dynamic Item Styling --- */
    #subdepartments-container {
        margin-top: 1rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    .subdepartment-item {
        padding: 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        background-color: rgba(249, 250, 251, 0.5); /* bg-gray-50/50 */
        position: relative;
    }
    .input-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    @media (min-width: 768px) {
        .input-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
    .work-program-section {
        margin-top: 1rem;
    }
    .work-program-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .work-program-header h4 {
        font-size: 1rem;
        font-weight: 500;
        color: #1f2937;
    }
    .work-programs-container {
        margin-top: 0.5rem;
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
        flex-grow: 1; /* Make inputs take available space */
    }

    /* --- Buttons --- */
    .btn {
        display: inline-flex;
        align-items: center;
        padding: 0.6rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        text-decoration: none;
        transition: background-color 0.2s, color 0.2s;
        border: 1px solid transparent;
        cursor: pointer;
    }
    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
    .btn-xs {
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        border-radius: 9999px;
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
        flex-shrink: 0; /* Prevent button from shrinking */
    }
    .remove-btn:hover {
        background-color: #fee2e2; /* red-100 */
        color: #b91c1c; /* red-700 */
    }
    .remove-btn.absolute {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
    }
</style>

<div class="form-container">
    <h1 class="page-title">Add New Sub-departments</h1>

    <div class="card">
        <form action="{{ route('admin.sub-departments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="department_id">Parent Department</label>
                    <select name="department_id" id="department_id" class="form-select" required>
                        <option value="">Choose a department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="section-header">
                    <h3>Sub-department Entries</h3>
                    <button type="button" id="add-subdepartment-row" class="btn btn-add btn-sm">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Add Sub-department
                    </button>
                </div>

                <div id="subdepartments-container">
                    </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('admin.sub-departments.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save All Sub-departments</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('subdepartments-container');
    const addBtn = document.getElementById('add-subdepartment-row');
    let subDeptIndex = 0;

    const addSubDepartmentRow = () => {
        const newRow = document.createElement('div');
        // Gunakan kelas CSS internal
        newRow.className = 'subdepartment-item'; 
        newRow.innerHTML = `
            <button type="button" class="remove-btn absolute" title="Remove Sub-department">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <div class="input-grid">
                <div class="form-group">
                    <label>Sub-department Name</label>
                    <input type="text" name="sub_departments[${subDeptIndex}][name]" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Photo</label>
                    <input type="file" name="sub_departments[${subDeptIndex}][photo]" class="file-input" required>
                </div>
            </div>
            <div class="work-program-section">
                <div class="work-program-header">
                    <h4>Work Programs</h4>
                    <button type="button" class="add-work-program btn btn-add btn-xs">+ Add Program</button>
                </div>
                <div class="work-programs-container">
                    </div>
            </div>
        `;
        container.appendChild(newRow);
        subDeptIndex++;
    };

    // Tambah satu baris saat halaman dimuat
    addSubDepartmentRow();

    addBtn.addEventListener('click', addSubDepartmentRow);

    container.addEventListener('click', function(e) {
        // Hapus Sub-department
        const removeSubDeptBtn = e.target.closest('.remove-btn.absolute');
        if (removeSubDeptBtn) {
            // Cegah penghapusan item terakhir
            if (container.children.length > 1) {
                removeSubDeptBtn.closest('.subdepartment-item').remove();
            }
        }

        // Tambah Work Program
        const addWorkProgramBtn = e.target.closest('.add-work-program');
        if (addWorkProgramBtn) {
            const workProgramsContainer = addWorkProgramBtn.parentElement.nextElementSibling;
            const parentSubDept = addWorkProgramBtn.closest('.subdepartment-item');
            const parentIndex = Array.from(container.children).indexOf(parentSubDept);
            const workProgramIndex = workProgramsContainer.children.length;

            const workProgramHTML = `
                <div class="work-program-item">
                    <input type="text" name="sub_departments[${parentIndex}][work_programs][${workProgramIndex}][title]" class="form-input" placeholder="Program Title" required>
                    <input type="text" name="sub_departments[${parentIndex}][work_programs][${workProgramIndex}][description]" class="form-input" placeholder="Description" required>
                    <button type="button" class="remove-work-program remove-btn" title="Remove Program">
                         <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            `;
            workProgramsContainer.insertAdjacentHTML('beforeend', workProgramHTML);
        }
        
        // Hapus Work Program
        const removeWorkProgramBtn = e.target.closest('.remove-work-program');
        if (removeWorkProgramBtn) {
            removeWorkProgramBtn.closest('.work-program-item').remove();
        }
    });
});
</script>
@endpush
@endsection