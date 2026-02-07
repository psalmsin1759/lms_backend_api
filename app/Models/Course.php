<?php

namespace App\Models;

use App\Enums\CourseLevel;
use App\Enums\CourseStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    protected $fillable = [
        'instructor_id',
        'title',
        'description',
        'slug',
        'level',
        'duration',
        'price',
        'status',
    ];

    protected $casts = [
        'level' => CourseLevel::class,
        'status' => CourseStatus::class,
    ];

    // Relation to Instructor (User)
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
