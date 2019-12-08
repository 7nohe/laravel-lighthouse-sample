<?php
// tests/Feature/UserTest.php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test users query
     *
     * @return void
     */
    public function testQueriesUsers()
    {
        $user = factory(User::class)->create();

        $this->graphQL('
            query GetUsers {
                users {
                    data {
                        id
                        name
                        email
                    }
                }
            }
        ')->assertJson([
            'data' => [
                'users' => [
                        "data" => [
                            [
                                'id' => $user->id,
                                'name' => $user->name,
                                'email' => $user->email,
                            ]
                        ]
                ]
            ]
        ]);
    }
}
