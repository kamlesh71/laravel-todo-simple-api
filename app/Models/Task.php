<?php

namespace App\Models;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'description',
        'start_date',
        'end_date',
        'status',
        'priority'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => TaskStatus::class,
        'priority' => TaskPriority::class,
    ];

    public function scopeOrderByPriority(Builder $query, $order = 'asc'): void
    {
         $query->orderBy(DB::raw('FIELD(priority, "high", "medium", "low")'), $order);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}
