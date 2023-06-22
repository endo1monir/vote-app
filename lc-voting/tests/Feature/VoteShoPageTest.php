<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaShow;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class VoteShoPageTest extends TestCase
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
    public function test_vote_sho_page()
    {
        $user = User::factory()->create(
            ['name' => 'test', 'email' => 'test@test', 'password' => 'test']
        );
        $cat = Category::factory()->create();
        $status = Status::factory()->create(['name' => 'test', 'classes' => 'class']);
        $idea = Idea::factory()->create(
            ['user_id' => $user->id, 'category_id' => $cat->id, 'status_id' => $status->id, 'title' => 'test', 'description' => 'test']
        );
        $res = $this->get(route('idea.show', $idea));
        $res->assertSeeLivewire(IdeaShow::class);
    }

    /**
     * @test
     */
    public function test_receive_vote_sho_page()
    {
        $user = User::factory()->create(
            ['name' => 'test', 'email' => 'test@test', 'password' => 'test']
        );

        $userB = User::factory()->create(
            ['name' => 'testB', 'email' => 'testB@test', 'password' => 'test']
        );
        $cat = Category::factory()->create();
        $status = Status::factory()->create(['name' => 'test', 'classes' => 'class']);
        $idea = Idea::factory()->create(
            ['user_id' => $user->id, 'category_id' => $cat->id, 'status_id' => $status->id, 'title' => 'test', 'description' => 'test']
        );
        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id,
        ]);

        Vote::factory()->create([
            'user_id' => $userB->id,
            'idea_id' => $idea->id,
        ]);
        $res = $this->get(route('idea.show', $idea));
        $res->assertSeeLivewire(IdeaShow::class);
        $res->assertViewHas('votesCounts', 2);
    }

    /**
     * @test
     */
    public function test_user_voted_on_idea_show_page()
    {
        $user = User::factory()->create(
            ['name' => 'test', 'email' => 'test@test', 'password' => 'test']
        );

        $userB = User::factory()->create(
            ['name' => 'testB', 'email' => 'testB@test', 'password' => 'test']
        );
        $cat = Category::factory()->create();
        $status = Status::factory()->create(['name' => 'test', 'classes' => 'class']);
        $idea = Idea::factory()->create(
            ['user_id' => $user->id, 'category_id' => $cat->id, 'status_id' => $status->id, 'title' => 'test', 'description' => 'test']
        );
        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id,
        ]);

        Vote::factory()->create([
            'user_id' => $userB->id,
            'idea_id' => $idea->id,
        ]);
        $res = $this->get(route('idea.show', $idea));
        $res->assertSeeLivewire(IdeaShow::class);
        Livewire::actingAs($user)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votesCount' => 5,
            ])
            ->assertSet('hasVoted', true)
            ->assertSee('Voted');

    }

}
