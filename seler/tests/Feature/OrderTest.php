<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

class OrderTest extends TestCase
{
    use DatabaseMigrations;
    
    public function test_user_not_login_cannot_see_order_list_page()
    {
        // $this->withoutExceptionHandling();
        $this->get('/orders')->assertRedirect('/login');
    }

    public function test_user_login_can_see_order_list_page()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory('App\Models\User')->create());

        $order = \App\Models\Order::create([
            'user_id' => auth()->user()->id,
            'seler_id' => auth()->user()->id,
            'code' => 'code123',
            'status' => 'created',
            'order_date' => now(),
            'payment_due' => now(),
            'payment_status' => 'pendding',
            'customer_first_name' => 'buyer',
            'customer_last_name' => 'one',
        ]);
        
        $this->get('/orders')->assertStatus(200);
    }
}
