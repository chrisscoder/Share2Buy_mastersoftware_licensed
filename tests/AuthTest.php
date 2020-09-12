<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function can_log_in()
    {
        $data = ['email' => 'email@example.com', 'password' => 'password'];
        $this->createUser($data);

        $this->visit('login')
            ->type($data['email'], 'email')
            ->type($data['password'], 'password')
            ->press('Log in')
            ->seePageIs('admin/dashboard');
    }
    /**
     * @test
     */
    public function can_not_log_in_with_wrong_credentials()
    {
        $data = ['email' => 'email@example.com', 'password' => 'password'];
        $this->createUser($data);

        $this->visit('login')
            ->type($data['email'], 'email')
            ->type('wrong password', 'password')
            ->press('Log in')
            ->seePageIs('login')
            ->see('These credentials do not match our records.');
    }

    /**
     * @test
     */
    public function can_log_out()
    {
        $user = $this->createUser();

        $this->actingAs($user)
            ->visit('logout')
            ->seePageIs('/');
    }
}
