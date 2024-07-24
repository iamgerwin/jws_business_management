<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use \Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Business extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email',];

    public function tasks(): MorphMany
    {
        return $this->morphMany(Task::class, 'taskable');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'business_category', 'business_id', 'category_id');
    }

    public function owners(): HasMany
    {
        return $this->hasMany(Person::class, 'business_id');
    }
}
