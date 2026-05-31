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
    public function showDetail(Department $department)
    {
        // Eager load relasi agar query lebih efisien
        $department->load('detail', 'subDepartments');

        // Mengirim data ke view
        return view('departments.detail-department', compact('department'));
    }


}
