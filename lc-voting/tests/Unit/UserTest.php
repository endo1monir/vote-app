<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use http\Client\Curl\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_can_generate_avatar()
    {
        $user=\App\Models\User::factory()->create([
            'name'=>'test',
            'email'=>'test@test.com',
        ]);
        $AvatarImage=$user->getAvatar();
        $this->assertEquals("https://gravatar.com/avatar/b642b4217b34b1e8d3bd915fc65c4452?d=https://i0.wp.com/s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-20.png&s=200",
            $AvatarImage);
        $response=Http::get($AvatarImage);
        $this->assertTrue($response->successful());
//        dd($AvatarImage);

//        $this->assertTrue(true);
    }
}
