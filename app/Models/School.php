<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingSeparator('-')
            ->slugsShouldBeNoLongerThan(50)
            ->doNotGenerateSlugsOnUpdate();
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function (School $school) {
            $school->slug = isset(explode(' ',$school->name)[1] ) ? explode(' ',$school->name)[0] . '-' . explode(' ',$school->name)[1] : explode(' ',$school->name)[0];
            $school->user_id = Auth::id();
        });
    }

    //Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
