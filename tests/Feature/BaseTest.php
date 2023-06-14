<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BaseTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    protected array $credentials = [
        'name' => 'Test',
        'email' => 'test@example.com',
        'password' => 'test1234',
        'password_confirmation' => 'test1234'
    ];

    public function homePageTest(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function findTestUser(): User|null
    {
        if(empty($this->user)) {
            $this->user = User::where('email', $this->credentials['email'])->first();
        }
        return $this->user;
    }
}
