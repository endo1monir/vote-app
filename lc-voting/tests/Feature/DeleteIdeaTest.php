<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use http\Client\Curl\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteIdeaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function show_delete_idea_component_when_user_authorized()
    {
        $user=\App\Models\User::factory()->create();
        $cat=Category::factory()->create();
        $status=Status::factory()->create([
            "name" => "Open", 'classes' => 'bg-gray-200'
        ]);
        $idea=Idea::factory()->create([ 'user_id' => $user->id, 'category_id' => $cat->id, 'status_id' => $status->id ]);
        $this->actingAs($user)
            ->get(route('idea.show',$idea))
            ->assertSeeLivewire('delete-idea');
    }
}
