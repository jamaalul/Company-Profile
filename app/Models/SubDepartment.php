<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'sub_department_photo',
        'work_programs',
    ];

    protected $casts = [
        'work_programs' => 'array',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
