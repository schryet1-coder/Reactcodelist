<?php

namespace Tests\Feature;

use Tests\TestCase;

class StripeWebhookTest extends TestCase
{
    public function test_webhook_returns_400_without_secret()
    {
        $response = $this->post('/webhook/stripe', ['dummy' => 'data']);
        $response->assertStatus(400);
    }
}
