<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class UserTest extends BaseTest
{
    protected null|User $user = null;

    public function testDelete(): void
    {
        $this->assertTrue(
            $this->findTestUser()->delete()
        );
    }

    public function testRegister(): void
    {
        $this->post(route('register'), $this->credentials);

        $this->assertNotNull(
            $this->findTestUser()
        );
    }

    public function testLogin(): void
    {
        $this->actingAs(
            $this->findTestUser(),
            'web'
        );

        $this->assertAuthenticatedAs(
            $this->findTestUser(),
            'web'
        );
    }
}
