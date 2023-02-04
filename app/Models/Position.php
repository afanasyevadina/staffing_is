<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Position extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function staffCategory(): BelongsTo
    {
        return $this->belongsTo(StaffCategory::class)->withDefault();
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Position::class)->using(DepartmentPositionEmployee::class);
    }

    public function activeEmployees(): BelongsToMany
    {
        return $this->employees()->wherePivotNull('fired_date');
    }
}
