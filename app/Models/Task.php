<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Query\Builder;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'status', 'taskable_id', 'taskable_type'];

    public function taskable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeOpen(Builder $query): void
    {
        $query->where('status', 'open');
    }

    public function scopeCompleted(Builder $query): void
    {
        $query->where('status', 'completed');
    }
}
