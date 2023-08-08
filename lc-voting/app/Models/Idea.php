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
        return $this->belongsToMany(User::class, 'votes');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isVotedByUser(?User $user)
    {
        if (!$user):
            return false;
        endif;
        return $this->votes()->where('user_id', $user->id)
            ->where('idea_id', $this->id)->
            exists();
    }

    public function vote(User $user)
    {
        Vote::create([
            'user_id' => $user->id,
            'idea_id' => $this->id,
        ]);
    }

    public function removeVote(User $user)
    {
        Vote::where('user_id', $user->id)
            ->where('idea_id', $this->id)->first()->delete();
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
