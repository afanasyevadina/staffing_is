<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class)->withPivot(['employed_date', 'fired_date', 'positions_count', 'department_id'])->withTimestamps()->using(DepartmentPositionEmployee::class);
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class)->withPivot(['employed_date', 'fired_date', 'positions_count', 'position_id'])->withTimestamps()->using(DepartmentPositionEmployee::class);
    }

    public function activePositions(): BelongsToMany
    {
        return $this->positions()->wherePivotNull('fired_date');
    }

    public function activeDepartments(): BelongsToMany
    {
        return $this->departments()->wherePivotNull('fired_date');
    }

    public function maternityLeaves(): HasMany
    {
        return $this->hasMany(MaternityLeave::class);
    }

    public function activeMaternityLeave(): HasOne
    {
        return $this->hasOne(MaternityLeave::class)->whereDate('end_date', '>', now());
    }

    public function getFullNameAttribute(): string
    {
        return collect([$this->last_name, $this->first_name, $this->middle_name])->filter()->implode(' ');
    }

    public function getEmployedDateAttribute()
    {
        return $this->positions()->orderBy('employed_date')->first()?->pivot?->employed_date;
    }

    public function getFiredDateAttribute()
    {
        return $this->positions()->orderByDesc('fired_date')->first()?->pivot?->fired_date;
    }

    public function getExperienceAttribute(): ?Carbon
    {
        if (!$this->employedDate) return null;
        return Carbon::createFromTimestamp(($this->firedDate ? Carbon::create($this->firedDate) : now())->getTimestamp() - Carbon::create($this->employedDate)->getTimestamp())->subYears(1970);
    }

    public function scopeActive(Builder $query)
    {
        $query->whereHas('activePositions');
    }
}
