<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('subDepartments')->latest()->paginate(10);
        return view('admin.departments.index', compact('departments'));
    }

    public function showDetail(Department $department)
    {
        // Eager load relasi agar query lebih efisien
        $department->load('detail', 'subDepartments');

        // Mengirim data ke view
        return view('departments.detail-department', compact('department'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
            'leadership_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'head_name' => 'required|string|max:255',
            'head_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'division_words' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Handle leadership photo
            $leadershipPhotoFile = $request->file('leadership_photo');
            $leadershipPhotoDest = 'uploads/departments/leadership';
            $leadershipPhotoName = uniqid() . '_' . $leadershipPhotoFile->getClientOriginalName();
            $leadershipPhotoFile->move(public_path($leadershipPhotoDest), $leadershipPhotoName);
            $leadershipPhotoPath = $leadershipPhotoDest . '/' . $leadershipPhotoName;

            // Handle head photo
            $headPhotoFile = $request->file('head_photo');
            $headPhotoDest = 'uploads/departments/head';
            $headPhotoName = uniqid() . '_' . $headPhotoFile->getClientOriginalName();
            $headPhotoFile->move(public_path($headPhotoDest), $headPhotoName);
            $headPhotoPath = $headPhotoDest . '/' . $headPhotoName;

            $department = Department::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'leadership_photo' => $leadershipPhotoPath,
            ]);

            $department->detail()->create([
                'head_name' => $request->head_name,
                'head_photo' => $headPhotoPath,
                'division_words' => $request->division_words,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('admin.departments.index')->with('success', 'Departemen berhasil ditambahkan.');
    }

    public function edit(Department $department)
    {
        $department->load('detail');
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
            'leadership_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'head_name' => 'required|string|max:255',
            'head_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'division_words' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $departmentData = ['name' => $request->name, 'slug' => Str::slug($request->name)];
            $detailData = ['head_name' => $request->head_name, 'division_words' => $request->division_words];

            if ($request->hasFile('leadership_photo')) {
                if (File::exists(public_path($department->leadership_photo))) {
                    File::delete(public_path($department->leadership_photo));
                }
                $file = $request->file('leadership_photo');
                $dest = 'uploads/departments/leadership';
                $name = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path($dest), $name);
                $departmentData['leadership_photo'] = $dest . '/' . $name;
            }

            if ($request->hasFile('head_photo')) {
                if ($department->detail && File::exists(public_path($department->detail->head_photo))) {
                    File::delete(public_path($department->detail->head_photo));
                }
                $file = $request->file('head_photo');
                $dest = 'uploads/departments/head';
                $name = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path($dest), $name);
                $detailData['head_photo'] = $dest . '/' . $name;
            }

            $department->update($departmentData);
            $department->detail()->update($detailData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('admin.departments.index')->with('success', 'Departemen berhasil diperbarui.');
    }

    public function destroy(Department $department)
    {
        DB::beginTransaction();
        try {
            if (File::exists(public_path($department->leadership_photo))) {
                File::delete(public_path($department->leadership_photo));
            }
            if ($department->detail && File::exists(public_path($department->detail->head_photo))) {
                File::delete(public_path($department->detail->head_photo));
            }
            foreach ($department->subDepartments as $subDept) {
                if (File::exists(public_path($subDept->sub_department_photo))) {
                    File::delete(public_path($subDept->sub_department_photo));
                }
            }
            $department->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
        
        return redirect()->route('admin.departments.index')->with('success', 'Departemen berhasil dihapus beserta seluruh datanya.');
    }
}
