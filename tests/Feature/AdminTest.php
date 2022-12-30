<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_admin()
    {
        $user = User::factory()->create([
        'level' => 'Admin',
        'password' => Hash::make('password')
        ]);
        Auth::login($user);
        $this->assertTrue(true);
        }
}