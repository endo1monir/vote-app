<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Category::factory(4)->create();
        User::factory(20)->create();
        Status::factory()->create(["name" => "Open" ]);
        Status::factory()->create(["name" => "Considering"]);
        Status::factory()->create(["name" => "In Progress"]);
        Status::factory()->create(["name" => "implemented", ]);
        Status::factory()->create(["name" => "Closed"]);
        Idea::factory(100)->create();
        foreach (range(1, 20) as $user_id) {
            foreach (range(1, 100) as $idea_id) {
                if ($idea_id % 2 == 0) {
                    Vote::factory()->create([
                        'user_id' => $user_id,
                        'idea_id' => $idea_id,
                    ]);
                }
            }
        }
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        foreach (Idea::all() as $idea)
        {
            Comment::factory(5)->existing()->create([
                'idea_id'=>$idea->id
            ]);
        }
    }
}
