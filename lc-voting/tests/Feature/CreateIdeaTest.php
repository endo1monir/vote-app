<?php

namespace Tests\Feature;

use App\Http\Livewire\CreateIdea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateIdeaTest extends TestCase
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

    /** @test */
    public function create_idea_form_not_showing_test()
    {
        $res = $this->get(route('idea.index'));
        $res->assertSuccessful();
        $res->assertSee('Login first');
        $res->assertDontSee("Let us know what you would like and we'll take a look over!");
    }

    /**
     * @test
     */
    public function create_idea_form_showing_test()
    {
        $res = $this->actingAs(User::factory()->create())->get(route('idea.index'));
        $res->assertSuccessful();
        $res->assertSee("Add an idea", false);
        $res->assertDontSee('Login first');
    }

    /**
     * @test
     */
    public function create_idea_from_shows_test()
    {
        $res = $this->actingAs(User::factory()->create())->get(route('idea.index'));
        $res->assertSuccessful();
        $res->assertSeeLivewire('create-idea');
    }

    /**@test */
    public function create_idea_from_validation_works_test()
    {
        Livewire::actingAs(User::factory()->create())
            ->test(CreateIdea::class)
            ->set('title', '')
            ->set('description', '')
            ->set('category', '')
            ->call('createIdea')
            ->assertHasErrors(['title', 'description', 'category'])
            ->assertSee(' The title field is required.');
    }
}
