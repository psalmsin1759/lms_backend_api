<?php

namespace App\Models;

use App\Enums\ContentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    protected $fillable = [
        'module_id',
        'title',
        'content_type',
        'content_url',
        'duration',
        'order',
    ];

    protected $casts = [
        'content_type' => ContentType::class,
    ];

    /**
     * A lesson belongs to a module
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
