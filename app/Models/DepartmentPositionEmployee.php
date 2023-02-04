<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DepartmentPositionEmployee extends Pivot
{
    use HasFactory;

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class)->withDefault();
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class)->withDefault();
    }
}
