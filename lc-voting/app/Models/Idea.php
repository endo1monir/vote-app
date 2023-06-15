<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);

    }

    public function votes()
    {
        return $this->belongsToMany(User::class,'votes');
    }

    public function getClassesName()
    {
        $allClasses = [
            "Open" => 'bg-gray-200',
            "Considering" => 'bg-purple text-white',
            "In Progress" => 'bg-yellow text-white',
            "implemented" => 'bg-green text-white',
            "Closed" => 'bg-red text-white',
        ];
        return $allClasses[$this->status->name];
    }

    public function sluggable(): array
    {
        // TODO: Implement sluggable() method.
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
