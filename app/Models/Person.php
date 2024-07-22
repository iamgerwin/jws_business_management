<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\MorphMany;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone'];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class, 'business_id', 'id');
    }

    public function tasks(): MorphMany
    {
        return $this->morphMany(Task::class, 'taskable');
    }
}
