<?php

namespace Tests\Feature;

use App\Http\Livewire\EditIdea;
use App\Http\Livewire\IdeaShow;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;


class EditIdeaTest extends TestCase
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
    public function test_show_edit_livewire_component_when_user_authorized()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $status = Status::factory()->create(["name" => "Open", 'classes' => 'bg-gray-200']);
        $idea = Idea::factory()->create(['user_id' => $user->id, 'category_id' => $category->id, 'status_id' => $status->id]); //create a idea with the user_id of the user who is logged in
        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire('edit-idea'); //check if the livewire component is displayed
    }

    /**@test * */
    public function test_not_show_edit_livewire_component_when_user_not_authorized()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $status = Status::factory()->create(["name" => "Open", 'classes' => 'bg-gray-200']);
        $idea = Idea::factory()->create(['category_id' => $category->id, 'status_id' => $status->id]); //create a idea with the user_id of the user who is logged in
        $this->ActingAs($user)
            ->get(route('idea.show', $idea))
            ->assertDontSeeLivewire('edit-idea');
    }

    /**
     * @test
     */
    public function edit_idea_form_validation()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $status = Status::factory()->create(["name" => "Open", 'classes' => 'bg-gray-200']);
        $idea = Idea::factory()->create(['user_id' => $user->id, 'category_id' => $category->id, 'status_id' => $status->id]); //create a idea with the user_id of the user who is logged in
        Livewire::actingAs($user)
            ->test(EditIdea::class, ['idea' => $idea])
            ->set('title', '')
            ->set('description', '')
            ->set('category', '')
            ->call('updateIdea')
            ->assertHasErrors(['title', 'description', 'category']);

    }

    /**
     * @test
     */
    public function editing_an_idea_works_when_user_has_authorization()
    {
        $user = User::factory()->create();
        $cat1 = Category::factory()->create();
        $cat2 = Category::factory()->create();
        $status = Status::factory()->create(["name" => "Open", 'classes' => 'bg-gray-200']);
        $idea = Idea::factory()->create(['user_id' => $user->id, 'category_id' => $cat1->id, 'status_id' => $status->id]); //create a idea with the user_id of the user who is logged in
        Livewire::actingAs($user)
            ->test(EditIdea::class, ['idea' => $idea])
            ->set('title', 'new title')
            ->set('description', 'new description')
            ->set('category', $cat2->id)
            ->call('updateIdea')
            ->assertEmitted('ideaWasUpdated');
        $this->assertDatabaseHas('ideas', ['title' => 'new title', 'description' => 'new description', 'category_id' => $cat2->id]);
    }

    /**
     * @test
     */
    public function editing_idea_show_on_menu_when_user_authorized_to_edit()
    {
        $user=User::factory()->create();
        $category = Category::factory()->create();
        $status = Status::factory()->create(["name" => "Open", 'classes' => 'bg-gray-200']);
        $idea=Idea::factory()->create(['user_id' => $user->id,'category_id' => $category->id, 'status_id' => $status->id]); //create a idea with the user_id of the user who is logged in
        Livewire::actingAs($user)
            ->test(IdeaShow::class, ['idea' => $idea,'votesCounts'=>3])
        ->assertSee('Edit Idea'); //check if the livewire component is displayed
    }

    /**
     * @test
     */
    public function editing_idea_dosent_show_on_menu_when_user_not_authorized_to_edit()
    {
        $user=User::factory()->create();
        $category = Category::factory()->create();
        $status = Status::factory()->create(["name" => "Open", 'classes' => 'bg-gray-200']);
        $idea=Idea::factory()->create(['category_id' => $category->id, 'status_id' => $status->id]); //create a idea with the user_id of the user who is logged in
        Livewire::actingAs($user)
            ->test(IdeaShow::class, ['idea' => $idea,'votesCounts'=>3])
            ->assertDontSee('Edit Idea'); //check if the livewire component is displayed
    }
}
