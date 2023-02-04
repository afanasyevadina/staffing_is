<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Department extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class)->withPivot(['positions_count'])->withTimestamps();
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_position')->withPivot(['employed_date', 'fired_date', 'positions_count', 'position_id'])->withTimestamps()->using(DepartmentPositionEmployee::class);
    }

    public function activeEmployees(): BelongsToMany
    {
        return $this->employees()->wherePivotNull('fired_date');
    }
}
