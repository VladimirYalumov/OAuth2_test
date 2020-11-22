<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SignUpTest extends TestCase
{
    public function testRequiredFields()
    {
        $this->json('PUT', 'api/auth/signup', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "success" => false,
                "errors" => [
                    "The phone field is required.",
                    "The password field is required.",
                ]
            ]);
    }

    public function testInvalidBody()
    {
        $userData = [
            "name" => "test",
            "phone" => 79872121485,
            "password" => "demo12345",
            "client_id" => 99999,
            "client_secret" => "sftB7xHXPOfRHSW2NR1UeMiWiacCvngZQpp8ZSiX"
        ];

        $this->json('PUT', 'api/auth/signup', $userData, ['Accept' => 'application/json'])
            ->assertStatus(401)
            ->assertJson([
                "success" => false,
                "message" => "Invalid client"
            ]);
    }

    public function testSuccessfulSignUp()
    {
        $userData = [
            "name" => "test",
            "phone" => 79872121480,
            "password" => "demo12345",
            "client_id" => 2,
            "client_secret" => "sftB7xHXPOfRHSW2NR1UeMiWiacCvngZQpp8ZSiX"
        ];

        $this->json('PUT', 'api/auth/signup', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "success" => true
            ]);

        DB::table('users')
        ->where('phone',79872121480)
        ->delete();
    }

}