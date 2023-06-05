<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $idea1 = Idea::factory()->create([
            'title' => 'title1',
            'user_id' => User::factory()->create()->id,
            'category_id' => Category::factory()->create()->id,
            'description' => 'description1',
        ]);
        $idea2 = Idea::factory()->create([
            'title' => 'title2',
            'user_id' => User::factory()->create()->id,
            'category_id' => Category::factory()->create()->id,
            'description' => 'description2',
        ]);
        $response = $this->get(route('idea.index'));

        $response->assertStatus(200);
        $response->assertSee('title1');
        $response->assertSee('title2');
        $response->assertSee('description1');
        $response->assertSee('description2');
    }

    /**
     * @test
     */
    public function test_show_idea_single()
    {
        $idea = Idea::factory()->create([
            'title' => 'title1',
            'user_id' => User::factory()->create()->id,
            'category_id' => Category::factory()->create()->id,
            'description' => 'description1',
        ]);
        $res = $this->get(route('idea.show', $idea));
        $res->assertSuccessful();
        $res->assertSee($idea->title);
    }

    /**
     * @test
     */
    public function test_pagination()
    {
        Category::factory()->count(4)->create();
        Idea::factory()->count(11)->create();
        $idea1 = Idea::query()->first();
        $idea1->title = 'title1';
        $idea1->save();
        $idea11 = Idea::query()->find(11);
        $idea11->title = 'title11';
        $idea11->save();
        $res = $this->get('/');
        $res->assertSee('title1');
        $res = $this->get('/?page=2');
        $res->assertSee('title11');
    }

    public function test_categories_in_index()
    {
        $cat1=Category::factory()->create([
            'name'=>'cat1',
        ]);
        $idea1 = Idea::factory()->create([
            'title' => 'title1',
            'description' => 'description1',
            'category_id' => $cat1->id,

        ]);
        $res=$this->get(route('idea.index'));
        $res->assertSuccessful();
        $res->assertSee('cat1');
    }
}
