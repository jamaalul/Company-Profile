<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailDepartment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department_id',
        'division_words',
        'head_name',
        'head_photo',
        'sub_departments',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'sub_departments' => 'array', // Casting kolom JSON ke array
    ];

    /**
     * Mendapatkan departemen induk dari detail ini.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}