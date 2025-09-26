<?php

namespace App\Http\Controllers;

use App\Models\SubDepartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SubDepartmentController extends Controller
{
       public function index(Request $request)
    {
        $query = SubDepartment::with('department')->latest();
        $departmentFilter = null;
        
        // Ambil semua departemen untuk dropdown filter
        $departments = Department::orderBy('name')->get();

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
            $departmentFilter = Department::find($request->department_id);
        }

        $subDepartments = $query->paginate(10);
        
        // Kirim semua variabel yang dibutuhkan ke view
        return view('admin.sub_departments.index', compact('subDepartments', 'departmentFilter', 'departments'));
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get();
        return view('admin.sub_departments.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'sub_departments' => 'required|array|min:1',
            'sub_departments.*.name' => 'required|string|max:255',
            'sub_departments.*.photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sub_departments.*.work_programs' => 'nullable|array',
            'sub_departments.*.work_programs.*.title' => 'required_with:sub_departments.*.work_programs|string',
            'sub_departments.*.work_programs.*.description' => 'required_with:sub_departments.*.work_programs|string',
        ]);

        foreach ($request->sub_departments as $subDeptData) {
            if (isset($subDeptData['photo'])) {
                $file = $subDeptData['photo'];
                $dest = 'uploads/departments/sub';
                $name = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path($dest), $name);
                $photoPath = $dest . '/' . $name;

                SubDepartment::create([
                    'department_id' => $request->department_id,
                    'name' => $subDeptData['name'],
                    'sub_department_photo' => $photoPath,
                    'work_programs' => $subDeptData['work_programs'] ?? [],
                ]);
            }
        }

        return redirect()->route('admin.sub-departments.index', ['department_id' => $request->department_id])
                         ->with('success', count($request->sub_departments) . ' sub-departments berhasil ditambahkan.');
    }

    public function edit(SubDepartment $subDepartment)
    {
        $departments = Department::orderBy('name')->get();
        return view('admin.sub_departments.edit', compact('subDepartment', 'departments'));
    }

    public function update(Request $request, SubDepartment $subDepartment)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'sub_department_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'work_programs' => 'nullable|array',
            'work_programs.*.title' => 'required_with:work_programs|string',
            'work_programs.*.description' => 'required_with:work_programs|string',
        ]);

        $data = $request->only('department_id', 'name');
        $data['work_programs'] = $request->work_programs ?? [];

        if ($request->hasFile('sub_department_photo')) {
            if (File::exists(public_path($subDepartment->sub_department_photo))) {
                File::delete(public_path($subDepartment->sub_department_photo));
            }
            $file = $request->file('sub_department_photo');
            $dest = 'uploads/departments/sub';
            $name = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path($dest), $name);
            $data['sub_department_photo'] = $dest . '/' . $name;
        }

        $subDepartment->update($data);

        return redirect()->route('admin.sub-departments.index')->with('success', 'Sub-department berhasil diperbarui.');
    }

    public function destroy(SubDepartment $subDepartment)
    {
        if (File::exists(public_path($subDepartment->sub_department_photo))) {
            File::delete(public_path($subDepartment->sub_department_photo));
        }
        $subDepartment->delete();
        return redirect()->route('admin.sub-departments.index')->with('success', 'Sub-department berhasil dihapus.');
    }
}
